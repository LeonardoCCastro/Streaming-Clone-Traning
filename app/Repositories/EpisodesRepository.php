<?php

namespace App\Repositories;

interface EpisodesRepository
{
    public function markEpisodesAsWatched(array $episodeIds);

    public function markEpisodesAsUnwatched(array $episodeIds);
}