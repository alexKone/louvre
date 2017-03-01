<?php

namespace Louvre\TicketBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Bill
 *
 * @ORM\Table(name="bill")
 * @ORM\Entity(repositoryClass="Louvre\TicketBundle\Repository\BillRepository")
 */
class Bill
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
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="logo", type="string", length=255)
     */
    private $logo;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255)
     */
    private $email;

    /**
     * @var int
     *
     * @ORM\Column(name="total_price", type="integer")
     */
    private $totalPrice = 0;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="billing_date", type="datetime")
     */
    private $billingDate;

    /**
     * @var string
     *
     * @ORM\Column(name="billing_code", type="string", length=255)
     */
    private $billingCode;

    /**
     * @var
     *
     * @ORM\OneToOne(targetEntity="Louvre\TicketBundle\Entity\Ticket", cascade={"persist"})
     */
    private $ticket;

    /**
     * @var
     *
     * @ORM\OneToMany(targetEntity="Louvre\TicketBundle\Entity\Visitor", mappedBy="bill")
     */
    private $visitors;


    public function __construct()
    {
        $this->visitors = new ArrayCollection();
        $this->billingDate = new \DateTime();
        $this->name = "Musée du Louvre";
        $this->billingCode = "SecretCode";
        $this->logo = "http://www.louvre.fr/sites/all/themes/louvre/img/data/logo-louvre.jpg";
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Bill
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set logo
     *
     * @param string $logo
     *
     * @return Bill
     */
    public function setLogo($logo)
    {
        $this->logo = $logo;

        return $this;
    }

    /**
     * Get logo
     *
     * @return string
     */
    public function getLogo()
    {
        return $this->logo;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Bill
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set totalPrice
     *
     * @param integer $totalPrice
     *
     * @return Bill
     */
    public function setTotalPrice($totalPrice)
    {
        $this->totalPrice = $totalPrice;

        return $this;
    }

    /**
     * Get totalPrice
     *
     * @return integer
     */
    public function getTotalPrice()
    {
        return $this->totalPrice;
    }

    /**
     * Set billingDate
     *
     * @param \DateTime $billingDate
     *
     * @return Bill
     */
    public function setBillingDate($billingDate)
    {
        $this->billingDate = $billingDate;

        return $this;
    }

    /**
     * Get billingDate
     *
     * @return \DateTime
     */
    public function getBillingDate()
    {
        return $this->billingDate;
    }

    /**
     * Set billingCode
     *
     * @param string $billingCode
     *
     * @return Bill
     */
    public function setBillingCode($billingCode)
    {
        $this->billingCode = $billingCode;

        return $this;
    }

    /**
     * Get billingCode
     *
     * @return string
     */
    public function getBillingCode()
    {
        return $this->billingCode;
    }

    /**
     * Set ticket
     *
     * @param \Louvre\TicketBundle\Entity\Ticket $ticket
     *
     * @return Bill
     */
    public function setTicket(\Louvre\TicketBundle\Entity\Ticket $ticket = null)
    {
        $this->ticket = $ticket;

        return $this;
    }

    /**
     * Get ticket
     *
     * @return \Louvre\TicketBundle\Entity\Ticket
     */
    public function getTicket()
    {
        return $this->ticket;
    }

    /**
     * Add visitor
     *
     * @param \Louvre\TicketBundle\Entity\Visitor $visitor
     *
     * @return Bill
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
