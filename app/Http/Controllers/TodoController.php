<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TodoController extends Controller
{
    // Add or Update a Todo
    public function add(Request $request)
    {
        $todos = session()->get('todos', []);

        // Check if it's an update
        if ($request->todo_id !== null) {
            $todos[$request->todo_id] = $request->todo;
        } else {
            $todos[] = $request->todo;
        }

        session()->put('todos', $todos);
        return redirect()->route('dashboard');
    }

    // Delete a Todo
    public function delete($id)
    {
        $todos = session()->get('todos', []);

        if (isset($todos[$id])) {
            unset($todos[$id]);
        }

        session()->put('todos', $todos);
        return redirect()->route('dashboard');
    }
}
