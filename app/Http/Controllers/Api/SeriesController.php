<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SeriesFormRequest;
use App\Models\Series;
use App\Repositories\SeriesRepository;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Return_;

class SeriesController extends Controller
{
    public function __construct(private SeriesRepository $seriesRepository)
    {
        
    }
    public function index(Request $request)
    {
        $query = Series::query();
        if($request->has('nome'))
        {
            $query->where('nome',$request->nome);
        }
        
        return $query->paginate(4);
    }

    public function store(SeriesFormRequest $request)
    {
        return response()->json($this->seriesRepository->add($request),201);
    }

    public function show(Series $series)
    {
        $seriesModel = Series::with('seasons.episodes')->find($series);
        if($seriesModel === null)
        {
            return response()->json(['message' => 'Series not found'], 404);
        }

        return $seriesModel;
    }

    //Update com apenas uma query, mas não retorna serie, testar depois
    // public function update(int $series, SeriesFormRequest $request)
    // {
    //     Series::where(‘id’, $series)->update($request->all());
    //     // retorno de uma resposta que não contenha a série, já que não fizemos um `SELECT` 
    // }

    public function update(Series $series, SeriesFormRequest $request)
    {
        $series->fill($request->all());
        $series->save();
        return $series;
    }

    public function destroy(Series $series)
    {
        Series::destroy($series);
        return response()->noContent();
    }
}