<?php

namespace Louvre\TicketBundle\Controller;

use Louvre\TicketBundle\Entity\Bill;
use Louvre\TicketBundle\Form\BillType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

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
                $visitor->setBill($billForm->getData());
            }
            $billForm->getData()->setTicket($request->getSession()->get('session_ticket_form'));

            $request->getSession()->set('session_bill_form', $billForm->getData());
            return $this->redirectToRoute('louvre_ticket_valid');
        }

        return $this->render('@LouvreTicket/Louvre/billing.html.twig', array(
            'billForm' => $billForm->createView(),
        ));
    }
}
