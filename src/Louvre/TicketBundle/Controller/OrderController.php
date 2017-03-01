<?php

namespace Louvre\TicketBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class OrderController extends Controller
{
    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function checkoutAction(Request $request)
    {
        if (!$request->getSession()->get('session_ticket_form') || $request->getSession()->get('session_bill_form')) {
            $this->redirectToRoute('louvre_ticket_homepage');
        }

        $ageCalculator = $this->container->get('louvre_ticket.agecalculator');
        $ageCalculator->calculPrice($request->getSession()->get('session_bill_form')->getVisitors());

        $visitors = $request->getSession()->get('session_bill_form')->getVisitors();
        $prixTotal = 0;
        foreach ($visitors as $item) {
            $prixTotal += $item->getPrice();
        }

        $request->getSession()->get('session_bill_form')->setTotalPrice($prixTotal);

        if ($request->isMethod('POST')) {
            $token = $request->request->get('stripeToken');

            \Stripe\Stripe::setApiKey($this->getParameter('stripe_secret_key'));
            \Stripe\Charge::create(array(
                "amount" => $prixTotal * 100,
                "currency" => "usd",
                "source" =>$token,
                "description" => "First test charge"
            ));

            $em = $this->getDoctrine()->getManager();
            $em->persist($request->getSession()->get('session_ticket_form'));
            $em->persist($request->getSession()->get('session_bill_form'));
            foreach ($request->getSession()->get('session_bill_form')->getVisitors() as $visitor) {
                $em->persist($visitor);
            }
            $em->flush();

            $this->addFlash('success', 'Order Complete! Yay!');

            return $this->redirectToRoute('louvre_ticket_homepage');
        }

        return $this->render('@LouvreTicket/Louvre/order/checkout.html.twig', array(
            'sBillForm' =>  $request->getSession()->get('session_bill_form'),
            'stripe_public_key' => $this->getParameter('stripe_public_key')
        ));
    }
}
