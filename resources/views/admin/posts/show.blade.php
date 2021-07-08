@extends('admin/layouts/app')

@section('title', 'Posts')

@section('content')
    <h1>Detalhes</h1>
    <p>{{ $post->title }}</p>
    <p>
        <img src="{{ url("storage/{$post->image}") }}" alt="{{ $post->image }}" style="max-width: 200px">
    </p>
    <p>{{ $post->content }}</p>
@endsection
