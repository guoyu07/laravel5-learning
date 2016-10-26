<?php

namespace BytePirateLaravel\Tips;


use App\Http\Requests;
use App\Http\Controllers\Controller;

class TipController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('BytePirateLaravel::tips', ['tips' => Tip::$tips]);
    }


}
