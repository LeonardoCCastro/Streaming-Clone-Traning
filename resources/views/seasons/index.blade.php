<x-layout title="Temporadas de {{ $series->nome }}">
    <a href="{{ route('series.create') }}" class="btn btn-dark mb-2">adicionar</a>
    <ul class="list-group">
        @foreach ($seasons as $season)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <a href="{{route('episodes.index',[$series->id, $season->id])}}">
                    Temporada {{$season->number}}
                </a>
                <span class="badge bg-secondary">
                    {{$season->numberOfWatchedEpisodes()}}/{{$season->episodes->count()}}
                </span>
            </li>
        @endforeach
    </ul>
</x-layout>
