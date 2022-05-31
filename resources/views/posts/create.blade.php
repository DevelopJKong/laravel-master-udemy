@extends('layouts.app')

@section('title','Create the post')

@section('content')
    <form action="{{ route('posts.store') }}" method="POST">
        @csrf
        @include('posts.partials.form')
        <div class="d-flex">
            <input  type="submit" value="Creat" class="btn btn-primary btn-block w-100 my-3" />
        </div>
    </form>

@endsection
