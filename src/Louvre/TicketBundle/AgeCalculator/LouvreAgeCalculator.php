<?php

namespace Louvre\TicketBundle\AgeCalculator;

class LouvreAgeCalculator
{
    const GRATUIT = 0;
    const ENFANT = 8;
    const NORMAL = 16;
    const SENIOR = 12;
    const REDUIT = 10;

    public function ageCalcul($date)
    {
        $today = new \Datetime();
        $age = $date->diff($today)->y;
        return $age;
    }

    public function calculPrice($listVisitors)
    {
        foreach ($listVisitors as $visitor) {
            $birthDate = $visitor->getBirthDate();
            if ($visitor->getReduc() === true) {
                $visitor->setPrice(self::REDUIT);
            } elseif ($this->ageCalcul($birthDate) < 4 ) {
                $visitor->setPrice(self::GRATUIT);
            } elseif ($this->ageCalcul($birthDate) >= 4 && $this->ageCalcul($birthDate) < 12 ) {
                $visitor->setPrice(self::ENFANT);
            } elseif ($this->ageCalcul($birthDate) >= 12 && $this->ageCalcul($birthDate) < 60 ) {
                $visitor->setPrice(self::NORMAL);
            } elseif ($this->ageCalcul($birthDate) >= 60 ) {
                $visitor->setPrice(self::SENIOR);
            } else {
                return;
            }
        }
    }
}