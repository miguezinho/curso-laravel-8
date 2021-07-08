@extends('admin/layouts/app')

@section('title', 'Posts')

@section('content')
    <h1>Cadastrar</h1>

    <form action="{{ route('posts.store') }}" method="post" enctype="multipart/form-data">
        @include('admin/posts/_partials/form')
    </form>
@endsection
