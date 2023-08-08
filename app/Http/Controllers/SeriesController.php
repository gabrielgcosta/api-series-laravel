<?php

namespace App\Http\Controllers;

use App\Http\Middleware\Autenticador;
use App\Http\Requests\SeriesFormRequest;
use App\Models\Season;
use App\Models\Serie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Repositories\SeriesRepository;
use Illuminate\Config\Repository;

class SeriesController extends Controller
{
    //O contrutor gera um objeto do tipo SeriesRepository como uma propriedade da classe, dessa forma
    //se torna possível utilizar o objeto em toda a classe
    public function __construct(private SeriesRepository $repository) {
        $this->middleware(Autenticador::class)->except('index');
    }

    public function index(Request $request)
    {
        $series = Serie::all();

        $mensagemSucesso = $request->session()->get('mensagem.sucesso');
        $request->session()->forget('mensagem.sucesso');


        return view('series.index')->with('series', $series)->with('mensagemSucesso', $mensagemSucesso);
    }

    public function create()
    {
        return view('series.create');
    }

    public function store(SeriesFormRequest $request)
    {
        $series = $this->repository->add($request);

        //coloca uma informação na sessão, no caso uma mensagem de sucesso
        $request->session()->put('mensagem.sucesso', "Série '{$series->nome}' adicionada com sucesso!");


        //to_route permite redicionar diretamente para outra rota
        return to_route('series.index');
    }

    //O fato do parâmetro ser do tipo model Serie, faz com que o laravel pegue o id que foi enviado
    //e faça um select no banco para localizar essa série
    public function destroy(Serie $series, Request $request){
        //O formato comentado a baixo seria recebendo o id da série através da request
        //Serie::destroy($request->series);

        //Uma vez que a serie já foi localizada, e está armazenada na variável $series
        //é possível deletar dessa forma
        $series->delete();

        $request->session()->put('mensagem.sucesso', "Série '{$series->nome}' removida com sucesso!");

        return to_route('series.index');
    }

    public function edit(Serie $series){
        return view('series.edit')->with('serie', $series);

    }

    public function update(Serie $series, SeriesFormRequest $request){


        $series->nome = $request->nome;
        $series->save();

        

        return to_route('series.index')->with('mensagem.sucesso', "Série '{$series->nome}' alterada com sucesso!");
    }
}
