<?php

namespace Louvre\TicketBundle\Controller;

use Louvre\TicketBundle\Entity\Bill;
use Louvre\TicketBundle\Entity\Ticket;
use Louvre\TicketBundle\Entity\Visitor;
use Louvre\TicketBundle\Form\BillType;
use Louvre\TicketBundle\Form\VisitorType;
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

//        dump($request->getSession()->get('session_ticket_form'));

        $bill = new Bill();
        $billForm = $this->createForm(BillType::class, $bill);

        $visit = new Visitor();
        $visitForm = $this->createForm(VisitorType::class, $visit);

        $billForm->handleRequest($request);

        if ($request->isMethod('POST') && $billForm->isValid())
        {
            $visit->setTicket($request->getSession()->get('session_ticket_form'));
            $visit->setBill($billForm->getData());


            $visitors = $billForm->getData()->getVisitors();

            foreach ($visitors as $visitor)
            {
                $visitor->setTicket($request->getSession()->get('session_ticket_form'));
                $visitor->setBill($billForm->getData());
            }

            dump($visitors);
            die();


            $request->getSession()->set('session_bill_form', $billForm->getData());


            return new Response('ok');
        }

        return $this->render('@LouvreTicket/Louvre/billing.html.twig', array(
            'billForm' => $billForm->createView(),
        ));
    }
}
