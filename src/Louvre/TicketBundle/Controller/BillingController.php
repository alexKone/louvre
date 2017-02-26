<?php

namespace Louvre\TicketBundle\Controller;

use Louvre\TicketBundle\Entity\Bill;
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
            $request->getSession()->set('session_bill_form', $billForm->getData());

            return new Response('ok');
        }

        return $this->render('@LouvreTicket/Louvre/billing.html.twig', array(
            'billForm' => $billForm->createView(),
        ));
    }
}
