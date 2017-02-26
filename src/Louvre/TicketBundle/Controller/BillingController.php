<?php

namespace Louvre\TicketBundle\Controller;

use Louvre\TicketBundle\Entity\Bill;
use Louvre\TicketBundle\Entity\Visitor;
use Louvre\TicketBundle\Form\BillType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class BillingController extends Controller
{
    public function indexAction(Request $request)
    {
        if (!$request->getSession()->get('session_ticket_form'))
        {
            return $this->redirectToRoute('louvre_ticket_homepage');
        }

        $bill = new Bill();
        $billForm = $this->createForm(BillType::class, $bill);
        $billForm->handleRequest($request);

        if ($request->isMethod('POST') && $billForm->isValid())
        {
            $visitors = $billForm->getData()->getVisitors();

            foreach ($visitors as $visitor)
            {
                $visitor->setTicket($request->getSession()->get('session_ticket_form'));
                $visitor->setBill($billForm->getData());
            }

            $request->getSession()->set('session_bill_form', $billForm->getData());

            dump($billForm->getData());
            die();

            return new Response('ok');
        }

        return $this->render('@LouvreTicket/Louvre/billing.html.twig', array(
            'billForm' => $billForm->createView(),
        ));
    }
}
