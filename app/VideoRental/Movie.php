<?php
/**
 * Created by PhpStorm.
 * User: charles
 * Date: 10/19/16
 * Time: 11:05
 */

namespace VideoRental;


class Movie
{
    protected $type;

    /**
     * Movie constructor.
     * @param $type
     */
    public function __construct($type)
    {
        $this->setType($type);
    }

    /**
     * @param $days
     * @return int
     */
    public function calculatePrice($days)
    {
        $price = 0;
        switch ($this->getType()) {
            case 'Regular':
                $price += 100;
                $price += ($days - 7) * 10;
                return $price;
            case 'NewRelease':
                $price += 150;
                $price += ($days - 3) * 30;
                return $price;
            case 'Children':
                $price += 40;
                $price += ($days - 7) * 10;
                return $price;
        }
        return $price;
    }

    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

}