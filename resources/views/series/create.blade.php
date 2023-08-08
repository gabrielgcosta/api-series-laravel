<x-layout title="Nova Série">
    
    <form action={{ route('series.store') }} method="post">
        @csrf
    
        {{-- caso o nome esteja preenchido, então se trata de uma atualização, utilziando metodo PUT --}}
    
        <div class="row mb-3">

            <div class="col-8">
                <label for="nome" class="form-label">Nome:</label>
                <input type="text" 
                autofocus
                id="nome" 
                name="nome" 
                class="form-control"
                @isset($nome) value={{old('nome')}} @endisset>
            </div>
            <div class="col-2">
                <label for="seasonsQty" class="form-label">Nº de temporadas:</label>
                <input type="text" 
                id="seasonsQty" 
                name="seasonsQty" 
                class="form-control"/>
            </div>
            <div class="col-2">
                <label for="episodesPerSeason" class="form-label">Eps/ Temporadas:</label>
                <input type="text" 
                id="episodesPerSeason" 
                name="episodesPerSeason" 
                class="form-control"/>
            </div>
        </div>
    
        <button type="submit" class="btn btn-primary">Adicionar</button>
    </form>    
    
    {{-- os dois pontos antes de action indicam que o que está contido como string na variavel
         deve ser lido como código 
    <x-series.form :action="route('series.store')" :nome="old('nome')" :update="false"/>--}}
</x-layout>
