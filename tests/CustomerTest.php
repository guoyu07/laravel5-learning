<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use VideoRental\Customer;
use VideoRental\Movie;
use VideoRental\Order;

class CustomerTest extends TestCase
{

    /**
     * A basic test example.
     *
     * @return void
     * @group yemg
     * @group CustomerTest
     */
    public function test_order_1_regular_movie_with_10_days()
    {
        /** arrange */
        $movie = new Movie('Regular');
        $order = new Order($movie, 10);
        $target = new Customer();
        $target->addOrder($order);
        $expect = 130;

        /** act */
        $actual = $target->calculateTotalPrice();
        /** assert */
        $this->assertEquals($expect, $actual);
    }

    /**
     * A basic test example.
     *
     * @return void
     * @group yemg
     * @group CustomerTest
     */
    public function test_order_1_regular_movie_with_12_days()
    {
        /** arrange */
        $movie = new Movie('Regular');
        $order = new Order($movie, 12);
        $target = new Customer();
        $target->addOrder($order);
        $expect = 150;

        /** act */
        $actual = $target->calculateTotalPrice();
        /** assert */
        $this->assertEquals($expect, $actual);
    }

    /**
     * A basic test example.
     *
     * @return void
     * @group yemg
     * @group CustomerTest
     */
    public function test_order_1_new_release_movie_with_10_days()
    {
        /** arrange */
        $movie = new Movie('NewRelease');
        $order = new Order($movie, 10);
        $target = new Customer();
        $target->addOrder($order);
        $expect = 360;

        /** act */
        $actual = $target->calculateTotalPrice();

        /** assert */
        $this->assertEquals($expect, $actual);
    }

    /**
     * A basic test example.
     *
     * @return void
     * @group yemg
     * @group CustomerTest
     */
    public function test_order_3_new_release_movie_with_10_days()
    {
        /** arrange */
        $movie = new Movie('NewRelease');
        $order1 = new Order($movie, 10);
        $target = new Customer();
        $target->addOrder($order1);
        $order2 = new Order($movie, 10);
        $target->addOrder($order2);
        $order3 = new Order($movie, 10);
        $target->addOrder($order3);
        $expect = 1080;

        /** act */
        $actual = $target->calculateTotalPrice();

        /** assert */
        $this->assertEquals($expect, $actual);
    }

    /**
     * A basic test example.
     *
     * @return void
     * @group yemg
     * @group CustomerTest
     */
    public function test_order_1_children_movie_with_12_days()
    {
        /** arrange */
        $movie = new Movie('Children');
        $order = new Order($movie, 12);
        $target = new Customer();
        $target->addOrder($order);
        $expect = 90;

        /** act */
        $actual = $target->calculateTotalPrice();

        /** assert */
        $this->assertEquals($expect, $actual);
    }

}
