<?php

namespace App\Http\Controllers;


use App\Http\Requests;
use BytePirateLaravel\Tips\Tip;
use BytePirateLaravel\Tips;


class TestController extends Controller
{

    public function index(Tip $tips)
    {
        return $tips->list();
        // dd($tips);
    }

}
