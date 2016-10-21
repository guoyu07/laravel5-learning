<?php
/**
 * Created by PhpStorm.
 * User: charles
 * Date: 10/19/16
 * Time: 11:07
 */

namespace VideoRental;


class Order
{

    /**
     * @var int
     */
    private $days;
    /**
     * @var Movie
     */
    private $movie;

    /**
     * Order constructor.
     * @param Movie $movie
     * @param int   $days
     */
    public function __construct($movie, $days)
    {
        $this->days = $days;
        $this->movie = $movie;
    }

    /**
     * @return Movie
     */
    public function getMovie()
    {
        return $this->movie;
    }

    /**
     * @return int
     */
    public function getDays()
    {
        return $this->days;
    }

}