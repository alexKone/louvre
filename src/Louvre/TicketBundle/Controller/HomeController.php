<?php

namespace Louvre\TicketBundle\Controller;

use Louvre\TicketBundle\Entity\Ticket;
use Louvre\TicketBundle\Form\TicketType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class HomeController extends Controller
{
    public function indexAction(Request $request)
    {
        $ticket = new Ticket();
        $ticketForm = $this->createForm(TicketType::class, $ticket);
        $ticketForm->handleRequest($request);

        if ($request->isMethod('POST') && $ticketForm->isValid())
        {
            $request->getSession()->set('session_ticket_form', $ticketForm->getData());

            return $this->redirectToRoute('louvre_ticket_billing');
        }

        return $this->render('@LouvreTicket/Louvre/home.html.twig', array(
            'ticketForm' => $ticketForm->createView(),
        ));
    }
}
