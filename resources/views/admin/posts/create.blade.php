<h1>Cadastrar</h1>

@if ($errors->any())
    <ul>
        @foreach ($errors->all() as $error)
            <li style="color: red">{{ $error }}</li>
        @endforeach
    </ul>
@endif

<form action="{{ route('posts.store') }}" method="post">
    @csrf
    <input type="text" name="title" id="title" placeholder="Título" value="{{ old('title') }}"><br>
    <textarea name="content" id="content" cols="30" rows="4" placeholder="Conteúdo">{{ old('content') }}</textarea><br>
    <button type="reset">Limpar</button>
    <button type="submit">Salvar</button>
</form>
