<?php

namespace App\Http\Controllers;

use App\Models\Episode;
use App\Models\Season;
use Illuminate\Http\Request;

class EpisodesController extends Controller
{
    public function index(Season $season){
        return view('episodes.index', ['episodes' => $season->episodes,
                    'mensagemSucesso' => session('mensagem.sucesso')])->with('season', $season);
    }

    //Recebe a request que vai conter o array com os códigos dos episódios assistidos
    //recebe também a season, que vem pela url, onde é informada a id da season
    public function update(Request $request, Season $season){
        $watchedEpisode = $request->episodes;
        //Executa uma função para cada elemento no array
        $season->episodes->each(function(Episode $episode) use ($watchedEpisode){
            //o campo watched do episódio será verdadeiro ou falso dependendo de o id do episódio
            //estar ou não no array de episódios marcados
            $episode->watched = in_array($episode->id, $watchedEpisode);
        });
        //salva toda a model e seus relacionamentos, porém, essa não é a melhor forma de realizar esse
        //procedimento, uma vez que irá gerar muitas querys.
        $season->push();
        return to_route('episodes.index', $season->id)->with('mensagem.sucesso', 'Episódios assistidos com sucesso!');
    }
}
