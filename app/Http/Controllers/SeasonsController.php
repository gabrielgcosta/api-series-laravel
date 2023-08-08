<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Serie;

class SeasonsController extends Controller
{
    public function index(Serie $series){
        //Da forma indicada abaixo, é feito a busca das séries, já com seus episódios
        $seasons = $series->seasons()->with('episodes')->get();
        return view('seasons.index')->with('seasons', $seasons)->with('series', $series);
    }
}
