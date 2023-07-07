<?php

namespace App\Http\Controllers;

use App\Models\Episode;
use App\Models\Season;
use App\Models\Series;
use Illuminate\Http\Request;

class EpisodesController extends Controller
{
    public function index(Series $series, Season $season)
    {
        return view('episodes.index')->with('series',$series)->with('season',$season)->with('episodes',$season->episodes);
    }

    public function update(Request $request, Series $series, Season $season)
    {
        $watchedEpisodes = $request->episodes;
        $season->episodes->each(function (Episode $episode) use ($watchedEpisodes){
            $episode->watched = in_array($episode->id, $watchedEpisodes);
        });

        $season->push();

        return to_route('episodes.index',[$series->id,$season->id]);
    }
}