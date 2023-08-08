<x-layout title="Episódios da Temporada {{$season->number}}" :mensagem-sucesso="$mensagemSucesso">
    <form action="{{route('episodes.update', $season->id)}}" method="POST">
        @csrf
        <ul class="list-group">
            @foreach ($episodes as $episode)
            <li class="list-group-item d-flex justify-content-between align-itens-center">
                Episódio {{ $episode->number }}
                <input type="checkbox"
                        name="episodes[]"
                        value="{{$episode->id}}"
                        @if ($episode->watched)
                            checked                            
                        @endif>
            </li>
            @endforeach
        </ul>
        <button type="submit" class="btn btn-primary mt-2 mb-2">Salvar</button>
    </form>
</x-layout>
