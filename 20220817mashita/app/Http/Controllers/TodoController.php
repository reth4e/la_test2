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
        $todos = Todo::where('content', 'LIKE BINARY', "%{$request -> content}%")->where('tag_id',  'LIKE BINARY',"%{$request -> tag_id}%")->get(); //これでcontentとtag_idのand検索
        $user = Auth::user();
        $tags = Tag::all();
        $task = $request -> content;
        $tag_id = $request -> tag_id;
        //これらの$task、$tag_idはクエリパラメータの値
        $param = ['todos' => $todos, 
            'user' => $user, 
            'tags' => $tags, 
            'task' => $task,
            'tag_id' => $tag_id];
        return view('search', $param);
    }

    public function create(TodoRequest $request)
    {
        // $form = $request->all(); //error user_idが設定されていない 0815
        // $form->user_id = Auth::user()->id;とするとエラー　配列に値を入れようとしている
        // unset($form['_token']);
        // Todo::create($form);
        $form = new Todo;
        $form->user_id = $request->user()->id;
        $form->tag_id = $request->tag_id; //この記述でuser_id,tag_idがセットされる
        $form->content = $request->content;
        unset($form['_token']);
        $form->save();
        // return redirect('/');
        return back();
    }

    public function update(TodoRequest $request)
    {
        $form = $request->all();
        unset($form['_token']);
        Todo::where('id', $request->id)->update($form);
        // return redirect('/');
        return back();
    }
    
    public function delete(Request $request)
    {
        Todo::find($request->id)->delete();
        return back();
        // return redirect('/');
    }
}
