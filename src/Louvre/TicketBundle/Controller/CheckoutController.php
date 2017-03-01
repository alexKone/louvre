<?php

namespace Louvre\TicketBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class CheckoutController extends Controller
{
    public function indexAction(Request $request)
    {
        $ageCalculator = $this->container->get('louvre_ticket.agecalculator');
        $ageCalculator->calculPrice($request->getSession()->get('session_bill_form')->getVisitors());

        $visitors = $request->getSession()->get('session_bill_form')->getVisitors();
        $prixTotal = 0;
        foreach ($visitors as $item) {
            dump($prixTotal += $item->getPrice());
        }

        dump($request->getSession()->get('session_bill_form')->setTotalPrice($prixTotal));
        die();

        return $this->render('@LouvreTicket/Louvre/checkout.html.twig');
    }
}
