<form action="{{$action}}" method="post">
    @csrf

    {{-- caso o nome esteja preenchido, então se trata de uma atualização, utilziando metodo PUT --}}
    @if($update)
    @method('PUT')
    @endif

    <div class="mb-3">
        <label for="nome" class="form-label">Nome:</label>
        <input type="text" 
        id="nome" 
        name="nome" 
        class="form-control"
        @isset($nome) value="{{$nome}}" @endisset>
    </div>

    <button type="submit" class="btn btn-primary">Adicionar</button>
</form>