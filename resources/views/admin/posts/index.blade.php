@extends('admin/layouts/app')

@section('title', 'Posts')

@section('content')
    <a href="{{ route('posts.create') }}">Cadastrar</a>

    <hr>

    <form action="{{ route('posts.search') }}" method="post">
        @csrf
        <input type="text" name="search" placeholder="Pesquisar:" value="{{ old('search') }}">
        <button type="submit">Pesquisar</button>
    </form>

    <h1>Listagem</h1>

    @if (session('message'))
        <div style="color: green">
            {{ session('message') }}
        </div>
    @endif

    <hr>
    @foreach ($posts as $post)
        <p>{{ $post->title }} -
            [
            <a href="{{ route('posts.show', $post->id) }}">Mostrar</a> -
            <a href="{{ route('posts.edit', $post->id) }}">Alterar</a> -
            <a href="{{ route('posts.destroy', $post->id) }}"
                onclick="return confirm('Tem certeza que deseja excluir este post?')">Excluir</a>
            ]
        </p>
        <hr>
    @endforeach
    <hr>

    {{ $posts->appends(isset($filters) ? $filters : null)->links() }}
@endsection
