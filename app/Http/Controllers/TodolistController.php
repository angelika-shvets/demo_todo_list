<?php

namespace App\Http\Controllers;

use App\Todos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class TodolistController extends Controller
{
    public function getIndex()
    {
        return View::make('test');
    }
    
    public function create(Request $request) 
    {
        $content = $request->input('content');
        $todos = new Todos;
        $todos->content = $content;
        $todos->save();
    }
    
    public function getAll() 
    {
        return Todos::all();
    }

    public function updateStatus(Request $request,$id) {
        //     Todos::find($id)->update($request->all());
        
        $todos = Todos::find($id);
        if($request->input('completed') != null){
            $completed = $request->input('completed');
            $todos->completed = $completed;
        }
        if($request->input('content') ){
            $content = $request->input('content');
            $todos->content = $content;
        }
   
        $todos->save();
    }
    public function delete(Request $request) {
        $id = $request->input('id');
        $todos = Todos::find($id);
        $todos->delete();
    }
}
