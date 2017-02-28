<?php

namespace Louvre\TicketBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ValidController extends Controller
{
    public function indexAction()
    {
        return $this->render('@LouvreTicket/Louvre/valid.html.twig');
    }
}
