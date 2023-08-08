<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SeriesFormRequest;
use App\Models\Serie;
use App\Repositories\SeriesRepository;

class SeriesController extends Controller{

    public function __construct(private SeriesRepository $seriesRepository) {
        
    }

    public function index(){
        return Serie::all();
    }

    //Está sendo utilizada uma classe de requisição que apresenta validações
    //para as informações enviadas
    public function store(SeriesFormRequest $request){
        //O ideal aqui no add seria não passar o request em si, mas sim um objeto mais
        //bem estruturado
        return response()->json($this->seriesRepository->add($request),201);
    }

    public function show(Serie $series){
        return $series;
    }

}