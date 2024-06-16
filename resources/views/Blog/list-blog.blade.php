@extends('home.app')

@section('title', 'Home Page')

@section('content')
<style>
    .blog-post {
        margin-bottom: 30px;
        padding: 15px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }
    .blog-post h2 {
        margin-top: 0;
    }
    .blog-post p {
        margin-bottom: 0;
    }
</style>

<div class="blog-posts">
    @foreach($blogs as $post)
        <div class="blog-post">
            <h2>{{ $post->title }}</h2>
            <p>{{ $post->content }}</p>
        </div>
    @endforeach
</div>
@endsection
