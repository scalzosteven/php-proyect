<?php

namespace Refactoring;

class Customer
{
    private $_name;
    private $_rentals = array();

    public function __construct($name)
    {
        $this->_name = $name;
    }

    public function addRental(Rental $arg)
    {
        $this->_rentals[] = $arg;
    }

    public function getName()
    {
        return $this->_name;
    }

    public function statement()
    {
        $totalAmount = 0;
        $frequentRenterPoints = 0;
        $rentals = $this->_rentals;

        $result = "Rental Record for " . $this->getName() . "\n";

        foreach ($rentals as $rental) {
            $thisAmount = $rental->obtainChange();

            $totalAmount += $thisAmount;
            $frequentRenterPoints = $this->calculateFrecuentRenterPoints($frequentRenterPoints, $rental);


            //show figures for this rental
            $result .= "\t" . $rental->getMovie()->getTitle() . "\t" . $thisAmount . "\n";
        }
        //add footer lines
        $result .= "Amount owed is " . $totalAmount . "\n";
        $result .= "You earned " . $frequentRenterPoints . " frequent renter points";


        return $result;
    }

    /**
     * @param int $frequentRenterPoints
     * @param $rental
     * @return int
     */
    public function calculateFrecuentRenterPoints(int $frequentRenterPoints, $rental): int
    {
// add frequent renter points
        $frequentRenterPoints++;

        // add bonus for a two day new release rental
        if (($rental->getMovie()->getPriceCode() == Movie::NEW_RELEASE)
            &&
            $rental->getDaysRented() > 1) {
            $frequentRenterPoints++;
        }
        return $frequentRenterPoints;
    }

}
