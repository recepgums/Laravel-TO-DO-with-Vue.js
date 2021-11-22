<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\TodoResource;
use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    public function index()
    {
        $todos = Todo::with('user');
        if (request()->search) {
            $todos->where(function ($query) {
                $query->where('content', 'like', '%' . request()->search . '%')
                    ->orWhereHas('user', function ($user) {
                        $user->where('name', 'like', '%' . request()->search . '%');
                    });
            });
        }
        $todos = $todos->paginate(5);
        return view('admin.home', [
            'todos' => $todos
        ]);
    }
}
