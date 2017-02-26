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
     * @ORM\Column(name="price", type="integer")
     */
    private $price;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="billing_date", type="datetimetz")
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
     * @ORM\OneToMany(targetEntity="Louvre\TicketBundle\Entity\Visitor", mappedBy="bill")
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
     * Set price
     *
     * @param integer $price
     *
     * @return Bill
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return int
     */
    public function getPrice()
    {
        return $this->price;
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
