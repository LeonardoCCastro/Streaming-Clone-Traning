<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use App\Models\Series;
use App\Models\Episode;
use App\Models\Season;
use App\Repositories\EpisodesRepository;

class EloquentEpisodesRepository implements EpisodesRepository
{
    public function markEpisodesAsWatched(array $episodeIds)
    {
        Episode::whereIn('id', $episodeIds)->update(['watched' => true]);
    }

    public function markEpisodesAsUnwatched(array $episodeIds)
    {
        Episode::whereIn('id', $episodeIds)->update(['watched' => false]);
    }
}