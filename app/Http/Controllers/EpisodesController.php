<?php

namespace App\Http\Controllers;

use App\Repositories\EpisodesRepository;
use App\Models\Episode;
use App\Models\Season;
use App\Models\Series;
use Illuminate\Http\Request;

class EpisodesController extends Controller
{
    public function __construct(private EpisodesRepository $episodesRepository)
    {
        
    }

    public function index(Series $series, Season $season)
    {
        $successMessage = session('mensagem.sucesso');
        return view('episodes.index')->with('series',$series)->with('season',$season)->with('episodes',$season->episodes)->with('successMessage',$successMessage);
    }

    public function update(Request $request, Series $series, Season $season)
    {
        $watchedEpisodes = $request->episodes;

        if ($watchedEpisodes === null) 
        {
            $watchedEpisodes = [];
        }

        $this->episodesRepository->markEpisodesAsWatched($watchedEpisodes);
        $this->episodesRepository->markEpisodesAsUnwatched(array_diff($season->episodes->pluck('id')->toArray(), $watchedEpisodes));

        return to_route('episodes.index',[$series->id,$season->id])->with('mensagem.sucesso','Assistidos marcados com sucesso');
    }
}