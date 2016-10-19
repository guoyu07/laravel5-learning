<?php
/**
 * Created by PhpStorm.
 * User: charles
 * Date: 10/19/16
 * Time: 11:07
 */

namespace VideoRental;

class Customer
{
    /**
     * @var Order[]
     */
    protected $orders = [];

    /**
     * Customer constructor.
     */
    public function __construct()
    {

    }

    /**
     * @return int
     */
    public function calculateTotalPrice()
    {
        $totalPrice = 0;
        foreach ($this->orders as $order) {
            $totalPrice += $order->getMovie()->calculatePrice($order->getDays());
        }
        return $totalPrice;
    }

    /**
     * @param $order
     */
    public function addOrder(Order $order)
    {
        $this->orders[] = $order;
    }


}