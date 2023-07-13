@extends ('layout')

@section('title', 'Update Post '. $post->title)
    
@section('content')
    <h1>Update Post {{$post->title}}</h1>

    <form method="POST" action="{{route('posts.update', ['post' => $post->id])}}">
       @csrf 
       @method('PUT')
        <label>Title</label>
        <input value="{{$post->title}}" type="text" name="title" class="@error('title') error-border @enderror">
       @error('title')
       <div class="error">
        {{$message}}
       </div> 
       @enderror
        <label>Description</label>
        <textarea  name="description" class="@error('description') error-border @enderror">{{$post->description}}</textarea>
        @error('description')
        <div class="error">
         {{$message}}
        </div>
        @enderror
        <button type="submit">Update</button>
    </form>
@endsection