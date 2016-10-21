<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Collection;

class TodoController extends Controller
{

    public function ddd()
    {
        $todos = Todo::orderBy('id', 'desc')->paginate(10);

        $names = Collection::make($todos->items())->map(function($item){
            return $item->name;
        });

        p($names->toArray(), $todos);
        $employees = [
            [
                'name'       => 'John',
                'department' => 'Sales',
                'email'      => 'john@example.com'
            ],
            [
                'name'       => 'Jane',
                'department' => 'Marketing',
                'email'      => 'jane@example.com'
            ],
            [
                'name'       => 'Dave',
                'department' => 'Marketing',
                'email'      => 'dave@example.com'
            ],
        ];

        $emailLookup = Collection::make($employees)->reduce(function($lookup, $item) {
            $lookup[$item['email']] = $item['name'];
            return $lookup;
        }, []);
        p($emailLookup, $employees);

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $todos = Todo::orderBy('id', 'desc')->paginate(10);
        // dd($todos);
        return view('todos.index', compact('todos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('todos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $todo = new Todo();
        $todo->name = $request->input("title");
        $todo->description = $request->input("description");
        $todo->created_at = date('Y-m-d', strtotime('now'));
        $todo->save();
        return redirect()->route('todos.index')->with('message', 'Item created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
