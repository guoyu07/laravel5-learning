<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Models\Task;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class TaskController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return RedirectResponse
	 * @throws \InvalidArgumentException
	 */
	public function index()
	{
		$tasks = Task::orderBy('id', 'desc')->paginate(10);

		return view('tasks.index', compact('tasks'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return RedirectResponse
	 */
	public function create()
	{
		return view('tasks.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param Request $request
	 * @return RedirectResponse
	 */
	public function store(Request $request)
	{
		$task = new Task();

		$task->title = $request->input('title');
        $task->created_at = $request->input('created_at');
        $task->description = $request->input('description');

		$task->save();

		return redirect()->route('tasks.index')->with('message', 'Item created successfully.');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int $id
	 * @return RedirectResponse
	 * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
	 */
	public function show($id)
	{
		$task = Task::findOrFail($id);

		return view('tasks.show', compact('task'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int $id
	 * @return RedirectResponse
	 * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
	 */
	public function edit($id)
	{
		$task = Task::findOrFail($id);

		return view('tasks.edit', compact('task'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int    $id
	 * @param Request $request
	 * @return RedirectResponse
	 * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
	 */
	public function update(Request $request, $id)
	{
		/** @var \App\Models\Task $task */
		$task = Task::findOrFail($id);

		$task->title = $request->input('title');
        $task->created_at = $request->input('created_at');
        $task->description = $request->input('description');

		$task->save();

		return redirect()->route('tasks.index')->with('message', 'Item updated successfully.');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int $id
	 * @return RedirectResponse
	 * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
	 * @throws \Exception
	 */
	public function destroy($id)
	{
		$task = Task::findOrFail($id);
		$task->delete();

		return redirect()->route('tasks.index')->with('message', 'Item deleted successfully.');
	}

}
