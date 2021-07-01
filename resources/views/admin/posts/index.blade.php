<a href="{{ route('posts.create') }}">Cadastrar</a>

<hr>

<h1>Listagem</h1>

<hr>
@foreach ($posts as $post)
    <p>{{ $post->title }}</p>
    <p>{{ $post->content }}</p>
    <hr>
@endforeach
