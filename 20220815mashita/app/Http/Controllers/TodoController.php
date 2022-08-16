<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use App\Models\Tag;
use Illuminate\Http\Request;
use App\Http\Requests\TodoRequest;
use Illuminate\Support\Facades\Auth;


class TodoController extends Controller
{
    public function index()
    {
        $todos = Todo::all();
        $user = Auth::user();
        $tags = Tag::all();
        $param = ['todos' => $todos, 'user' =>$user, 'tags' => $tags];
        return view('index', $param);
    }

    public function find(Request $request)
    {
        $user = Auth::user();
        $tags = Tag::all();
        $task = $request -> content; //追加
        $tag_id = $request -> tag_id; //追加
        $param = ['user' =>$user, 'tags' => $tags, 'task' => $task,'tag_id' => $tag_id];
        return view('find', $param);
    }

    public function search(Request $request)
    {
        $todos = Todo::where('content', 'LIKE BINARY', "%{$request -> content}%")->get();
        $user = Auth::user();
        $tags = Tag::all();
        $task = $request -> content;
        //この$taskはクエリパラメータの値
        $tag_id = $request -> tag_id;
        //この$tag_idによりviewファイル　search.blade.php内で検索の絞り込みを行う
        $param = ['todos' => $todos, 
            'user' =>$user, 
            'tags' => $tags, 
            'task' => $task,
            'tag_id' => $tag_id];
        return view('search', $param);
    }

    public function create(TodoRequest $request)
    {
        $form = $request->all(); //error user_id
        unset($form['_token']);
        Todo::create($form);
        return redirect('/');
    }

    public function update(TodoRequest $request)
    {
        $form = $request->all();
        unset($form['_token']);
        Todo::where('id', $request->id)->update($form);
        return redirect('/');
    }
    
    public function delete(Request $request)
    {
        Todo::find($request->id)->delete();
        return redirect('/');
    }
}
