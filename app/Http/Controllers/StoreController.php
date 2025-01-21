<?php

namespace App\Http\Controllers;
use App\Models\Persons;


use Illuminate\Http\Request;

class StoreController extends Controller
{

    public function deleteStatus(Request $requests)
{
    $deleted = Persons::where('id', $requests->id)
    ->delete(['id' => $requests->id]);  
if ($deleted) {
    return response()->json(['success' => true, 'message' => 'Task status deleted']);
} else {
    return response()->json(['error' => 'Task not found or status was not changed'], 404);
}

}


public function updateData(Request $request)
{
    $validated = $request->validate([
        'id' => 'required|exists:persons,id',
        'date' => 'required|date',
        'title' => 'required|string|max:255',
        'name' => 'required|string|max:255',
    ]);

    $update = Persons::where('id', $request->id)
                     ->update([
                         'due_date' => $request->date,
                         'title' => $request->title,
                         'description' => $request->description, 
                         'name' => $request->name,
                     ]);

    if ($update) {
        return response()->json(['success' => true, 'message' => 'Task status updated']);
    } else {
        return response()->json(['error' => 'Task not found or status was not changed'], 404);
    }
}



    public function updateStatus(Request $requests)
{
    $updated = Persons::where('id', $requests->id)
    ->update(['status' => $requests->status ? 1 : 0]);  
if ($updated) {
    return response()->json(['success' => true, 'message' => 'Task status updated']);
} else {
    return response()->json(['error' => 'Task not found or status was not changed'], 404);
}

}
    
    public function home() {
        return view("home");
    }

    public function edit($id) {
        $editdata = Persons::find($id);  
        return view('edit', compact('editdata'));
    }
    

    public function index(Request $request)
    {
        $status = $request->input('data_sel', 'ALL');
        if ($status == 'Completed') {
            $tasks = Persons::where('status', 1)->orderBy('id', 'desc')->paginate(10);
        } elseif ($status == 'not_completed') {
            $tasks = Persons::where('status', 0)->orderBy('id', 'desc')->paginate(10);
        } else {
            $tasks = Persons::orderBy('id', 'desc')->paginate(10);
        }
        return view('view', compact('tasks'));
    }
    

    public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'title' => 'required|string|max:255',
        'due_date' => 'required|date',
        'description' => 'required|string',
    ]);

    $person = new Persons();
    $person->name = $request->input('name');
    $person->title = $request->input('title');
    $person->due_date = $request->input('due_date');
    $person->description = $request->input('description');  
    $person->save();
    dd("Task created successfully");
}

}
