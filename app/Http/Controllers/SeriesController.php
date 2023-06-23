<?php

namespace App\Http\Controllers;

use App\Models\Serie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SeriesController extends Controller
{
    public function index(Request $request)
    {
        $series = Serie::query()->orderBy('nome')->get();
        $successMessage = $request->session()->get('success.message');
        $request->session()->forget('success.message');
        return view('series.index')->with('series',$series)->with('successMessage',$successMessage);
    }

    public function create()
    {
        return view('series.create');
    }

    public function store(Request $request)
    {
        // $nomeSerie = $request->input('nome');
        // $serie = new Serie();
        // $serie->nome = $nomeSerie;
        // $serie->save();
        $serie = Serie::create($request->all());
        $request->session()->put('success.message',"Série {$serie->nome} criada com sucesso");
        return to_route('series.index'); 
    }

    public function destroy(Serie $id, Request $request)
    {
        $id->delete(); 
        $request->session()->put('success.message',"Série {$id->nome} removida com sucesso");
        return to_route('series.index'); 
    }

}
