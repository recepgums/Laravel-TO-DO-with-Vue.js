<?php

namespace App\Http\Controllers;

use App\Http\Resources\TodoResource;
use App\Models\Todo;
use App\Http\Requests\StoreTodoRequest;
use App\Http\Requests\UpdateTodoRequest;

class TodoController extends Controller
{

    public function index()
    {
        $todos = Todo::query()->where('user_id',auth()->id());
        if (request()->search){
        $todos->where('content','like', '%' . request()->search . '%');
    }
        $todos= $todos->get();
        return  TodoResource::collection($todos);
    }


    public function create()
    {
        return view('create_todo');
    }


    public function store(StoreTodoRequest $request)
    {
        try{
            Todo::create([
                'content'=>$request->get('content'),
                'user_id'=>auth()->id(),
            ]);
            return response()->json(['message'=>'Added successfuly'],200);
        }catch(\Exception $e){
            return response()->json(['message'=>$e->getMessage()],500);
        }
    }

    public function show(Todo $todo)
    {
        abort_if($todo->id != auth()->id(),403);
        return response()->json(new TodoResource($todo));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Todo $todo)
    {
        abort_if($todo->id != auth()->id(),403);
        return view('edit',['todo'=>$todo]);
    }

    public function update(UpdateTodoRequest $request, Todo $todo)
    {
        abort_if($todo->id != auth()->id(),403);
        try{
            $todo->update($request->all());
            return response()->json(['message'=>'Updated successfuly'],200);
        }catch(\Exception $e){
            return response()->json(['message'=>$e->getMessage()],500);
        }

    }

    public function destroy(Todo $todo)
    {
        abort_if($todo->id != auth()->id(),403);
        $todo->delete();

        return response()->json(['message'=>'Removed successfuly'],200);
    }
}
