@extends('layouts.layout')

@section('title', 'タスク検索')

@section('upper-form')
  <form action="/todo/search?content={{$task}}&tag_id={{$tag_id}}" method="get" class="flex between mb-30">
    @csrf    
    <input type="text" class="input-add" name="content">
    <select name="tag_id" class="select-tag">
      <option disabled="" selected="" value=""></option>
      @foreach ($tags as $tag)
        <option value="{{$tag->id}}">{{$tag->content}}</option>
      @endforeach
    </select>
    <input class="btn btn-add" type="submit" value="検索">
  </form>
@endsection

@section('todo-contents')
  @foreach ($todos as $todo)
    @if ($user->id === $todo->user_id)
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
    @endif
  @endforeach
@endsection

@section('btn-back')
  <a class="btn btn-back" href="/">戻る</a>
@endsection