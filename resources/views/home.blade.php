@extends('layout')

@section('title', 'Home')
    


@section('content')
    <h1>Home page</h1>
   @forelse ($posts as $item)
       <div class="post-item">
        <div class="post-content">
        <h2><a href="{{route('posts.show', ['post' => $item->id])}}">{{$item->title}}</a></h2>
        <div id="app"></div>
        <p>{{$item->description}}</p>
       </div>
       </div>
       @empty
       <h2>There are no post</h2> 
   @endforelse
@endsection