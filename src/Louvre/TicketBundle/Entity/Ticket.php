<?php

namespace Louvre\TicketBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Ticket
 *
 * @ORM\Table(name="ticket")
 * @ORM\Entity(repositoryClass="Louvre\TicketBundle\Repository\TicketRepository")
 */
class Ticket
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="visit_date", type="datetime")
     */
    private $visitDate;

    /**
     * @var bool
     *
     * @ORM\Column(name="half_day", type="boolean")
     */
    private $halfDay;

    /**
     * @var
     *
     * @ORM\OneToMany(targetEntity="Louvre\TicketBundle\Entity\Visitor", mappedBy="ticket")
     */
    private $visitors;


    public function __construct()
    {
        $this->visitors = new ArrayCollection();
    }

    
    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set visitDate
     *
     * @param \DateTime $visitDate
     *
     * @return Ticket
     */
    public function setVisitDate($visitDate)
    {
        $this->visitDate = $visitDate;

        return $this;
    }

    /**
     * Get visitDate
     *
     * @return \DateTime
     */
    public function getVisitDate()
    {
        return $this->visitDate;
    }

    /**
     * Set halfDay
     *
     * @param boolean $halfDay
     *
     * @return Ticket
     */
    public function setHalfDay($halfDay)
    {
        $this->halfDay = $halfDay;

        return $this;
    }

    /**
     * Get halfDay
     *
     * @return bool
     */
    public function getHalfDay()
    {
        return $this->halfDay;
    }

    /**
     * Add visitor
     *
     * @param \Louvre\TicketBundle\Entity\Visitor $visitor
     *
     * @return Ticket
     */
    public function addVisitor(\Louvre\TicketBundle\Entity\Visitor $visitor)
    {
        $this->visitors[] = $visitor;

        return $this;
    }

    /**
     * Remove visitor
     *
     * @param \Louvre\TicketBundle\Entity\Visitor $visitor
     */
    public function removeVisitor(\Louvre\TicketBundle\Entity\Visitor $visitor)
    {
        $this->visitors->removeElement($visitor);
    }

    /**
     * Get visitors
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getVisitors()
    {
        return $this->visitors;
    }
}
