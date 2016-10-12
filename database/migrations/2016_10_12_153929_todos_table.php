<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Todos extends Migration
{
    /**
     * Run the migrations.
     * @author yemg 10/12/16
     * @return void
     */
    public function up()
    {
        Schema::create('todos', function (Blueprint $table) {
            $table->increments('id');
            $table->text('name');
            $table->text('tag')->nullable();
            $table->text('description');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('done_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('todos');
    }
}
