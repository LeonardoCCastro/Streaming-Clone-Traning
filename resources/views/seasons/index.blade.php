<x-layout title="Temporadas de {{ $series->nome }}">
    <a href="{{ route('series.create') }}" class="btn btn-dark mb-2">adicionar</a>
    <div class="d-flex justify-content-center">
        <img src="{{ asset('storage/'.$series->cover) }}" style="height: 400px" alt="Capa da série" class="img-fluid">
    </div>
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
