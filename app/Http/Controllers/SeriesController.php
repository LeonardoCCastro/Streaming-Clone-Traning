<?php

namespace App\Http\Controllers;

use App\Http\Requests\SeriesFormRequest;
use App\Models\Episode;
use App\Models\Season;
use App\Models\Series;
use Illuminate\Http\Request;

class SeriesController extends Controller
{
    public function index(Request $request)
    {
        $series = Series::all();
        $successMessage = $request->session()->get('success.message');
        $request->session()->forget('success.message');
        return view('series.index')->with('series', $series)->with('successMessage', $successMessage);
    }

    public function create()
    {
        return view('series.create');
    }

    public function store(SeriesFormRequest $request)
    {
        // $nomeSerie = $request->input('nome');
        // $serie = new Serie();
        // $serie->nome = $nomeSerie;
        // $serie->save();
        $serie = Series::create($request->all());
        
        $seasons = [];
        for ($i = 1; $i <= $request->seasonsQty; $i++) {
            $seasons[] = [
                'series_id' => $serie->id,
                'number' => $i,
            ];
        }
        Season::insert($seasons);

        $episodes = [];
        foreach($serie->seasons as $season)
        {
            for($j = 1; $j <= $request->seasonsQty; $j++)
            {
                $episodes[] = [
                    'season_id' => $season->id,
                    'number' => $j,
                ];
            }
        }
        Episode::insert($episodes);
        

        $request->session()->put('success.message', "Série {$serie->nome} criada com sucesso");
        return to_route('series.index');
    }

    public function destroy(Series $serie, Request $request)
    {
        $serie->delete();
        $request->session()->put('success.message', "Série {$serie->nome} removida com sucesso");
        return to_route('series.index');
    }

    public function edit(Series $serie)
    {
        return view('series.edit')->with('serie', $serie);
    }

    public function update(Series $serie, SeriesFormRequest $request)
    {
        $serie->fill($request->all());
        $serie->save();
        $request->session()->put('success.message', "Série {$serie->nome} atualizada com sucesso");
        return to_route('series.index');
    }

}
