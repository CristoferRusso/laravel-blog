@extends ('layout')

@section('title', 'Create new post')
    
@section('content')
    <h1>Create a New Blog Post</h1>

    <form method="post" action="{{route('posts.store')}}">
       @csrf 
        <label>Title</label>
        <input value="{{old('title')}}" type="text" name="title" class="@error('title') error-border @enderror">
       @error('title')
       <div class="error">
        {{$message}}
       </div>          
       @enderror
        <label>Description</label>
        <textarea  name="description" class="@error('description') error-border @enderror">{{old('description')}}</textarea>
        @error('description')
        <div class="error">
         {{$message}}
        </div>
        @enderror
        <button type="submit">Submit</button>
    </form>
@endsection