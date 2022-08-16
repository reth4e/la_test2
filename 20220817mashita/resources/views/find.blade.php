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

@section('btn-back')
  <a class="btn btn-back" href="/">戻る</a>
@endsection