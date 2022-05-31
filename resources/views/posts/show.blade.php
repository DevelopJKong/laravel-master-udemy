@extends('layouts.app')

@section('title',$post['title'])

@section('content')

    @if($post['is_new'])
        <div>A new blog post! Using if</div>
    @elseif(!$post['is_new'])
        <div>Blog post is old! using elseif</div>
    @endif
        <h1>{{ $post['title'] }}</h1>
        <p>{{ $post['content'] }}</p>

    @unless($post['is_new'])
        <div>It is an old post.. using unless</div>
    @endunless

    @isset($post['title'])
        <div>The post has some comments... using isset</div>
    @endisset

@endsection
