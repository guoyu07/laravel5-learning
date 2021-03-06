<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class TodoTest extends TestCase
{

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        /** arrange */

        /** act */

        /** assert */
        $this->visit('/todos')->see('DESCRIPTION')
            ->see('老师的交流时间')
            ->dontSee('Laudantium');

        $this->visit('todos?page=2')->see('Laudantium');
    }

}
