<?php

namespace App\Http\Controllers;


use App\Http\Requests;
use BytePirateLaravel\Tips\Tip;
use BytePirateLaravel\Tips;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;


class TestController extends Controller
{

    public function index(Tip $tip)
    {
        // get $tip instance by param hint
        return view('BytePirateLaravel::tips', ['tips' => $tip::$tips]);

        // or by global method app('tips') which registered at TipsServiceProvider.
        // $app = app('tips');
        // return view('BytePirateLaravel::tips', ['tips' => $app::$tips]);

    }

    public function tables()
    {
        // Using #Laravel && MySQL, and need a list of your tables? Use Collections to make it shine
        // pic.twitter.com/komBeBBEH8
        $tables = Collection::make(json_decode(json_encode(DB::select('SHOW TABLES')), true))->map(function($item){
            return array_values($item)[0];
        });
        dd($tables);
    }

}
