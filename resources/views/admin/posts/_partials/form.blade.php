@if ($errors->any())
    <ul>
        @foreach ($errors->all() as $error)
            <li style="color: red">{{ $error }}</li>
        @endforeach
    </ul>
@endif

@csrf
<input type="text" name="title" id="title" placeholder="Título" value="{{ $post->title ?? old('title') }}"><br>
<input type="file" name="image" id="image"><br>
<textarea name="content" id="content" cols="30" rows="4" placeholder="Conteúdo">{{ $post->content ?? old('content') }}</textarea><br>
<button type="reset">Limpar</button>
<button type="submit">Salvar</button>
