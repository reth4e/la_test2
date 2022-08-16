@extends('layouts.layout')

@section('title', 'Todo List')

@section('btn-search')
  <a class="btn btn-search" href='/todo/find'>タスク検索</a>
@endsection

@section('upper-form')
  <form action="/create" method="post" class="flex between mb-30">
    @csrf    
    <input type="text" class="input-add" name="content">
      <select name="tag_id" class="select-tag">
        @foreach ($tags as $tag)
          <option value="{{$tag->id}}">{{$tag->content}}</option>
        @endforeach
      </select>
    <input class="btn btn-add" type="submit" value="追加">
  </form>
@endsection

@section('todo-contents')
  @foreach ($todos as $todo)
    <tr>
      <td>{{$todo->created_at}}</td>
      <form action="/update?id={{$todo->id}}" method="post">
        @csrf
        <td>
          <input type="text" value="{{$todo->content}}" name="content" class="input-update">
        </td>
        <td>
          <select name="tag_id" class="select-tag">
            @foreach ($tags as $tag)
              @if ($tag -> id === $todo -> tag_id)
                <option value="{{$tag->id}}"  selected>{{$tag->content}}</option>
              @else
                <option value="{{$tag->id}}">{{$tag->content}}</option>
              @endif
            @endforeach
          </select>
        </td>
        <td>
          <button class="btn btn-update">更新</button>
        </td>
      </form>
      <td>
        <form action="/delete?id={{$todo->id}}" method="post">
          @csrf
          <button class="btn btn-delete">削除</button>
        </form>
      </td>
    </tr>
  @endforeach
@endsection