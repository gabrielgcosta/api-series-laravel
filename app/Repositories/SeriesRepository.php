<?php

namespace App\Repositories;

use App\Http\Requests\SeriesFormRequest;
use App\Models\Season;
use App\Models\Serie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SeriesRepository {

    public function add(SeriesFormRequest $request) : Serie {
        //permite que sejam criadas regras de validação para a request
        //caso as regras não sejam cumpridas, o usuário é redirecionado para a url anterior
        /*$request->validate([
            'nome' => ['required','min:3']
        ]);*/

        /*
        Esse método DB::transaction é utilizado para que todo o código contido nele seja uma
        transação no banco. Dessa forma, primeiro é executado todo o código contido, e então
        é feito o commit no banco. Então, caso haja algum problema durante o código, será feito
        o rollback do banco automaticamente
        */
        return DB::transaction(function() use ($request){

            //permite a criação de linhas nas tabelas do banco, nesse caso, na tabela serie
            //pegando tudo que veio na request
            $series = Serie::create($request->all());
            
            //rodando um for para criar as temporadas das series
            for($i=1; $i<=$request->seasonsQty; $i++){
                //é possível chamar o metodo seasons da model que faz a relação entre as tabelas
                //e utilizar o create para que seja criada uma season na serie
                $season = $series->seasons()->create([
                    'number' => $i
                ]);
                //Da mesma forma é necessário rodar um for para criar os episódios em cada temporada
                for($j=1; $j<=$request->episodesPerSeason; $j++){
                    //Essa forma de gerar a criação do episódio, onde é chamado o método create, e então
                    //informado quais os campos a serem preenchidos, é chamado de mass assignment, e por isso
                    //é necessário que, na model, esse campo seja definido como fillable
                    $season->episodes()->create([
                        'number' => $j
                    ]);
                }
                
                /*
                A  forma realizada anteriormente não é a mais otimizada para realizara  inserção no banco,
                pois gera muitas queries para que todas as informações sejam inseridas no banco.
                Uma forma melhor seria gerar um array com todas as informações, sendo um array de 
                temporadas e um array de episódios e então usar a função Episode::insert(*array com os elementos*),
                pois dessa forma iria diminuir a quantidade de queries foi deixado dessa forma pouco ótimizada
                apenas por questões de estudo, para que eu possa saber que existe essa forma
                */
                
            }
            return $series;
        });

    }
}