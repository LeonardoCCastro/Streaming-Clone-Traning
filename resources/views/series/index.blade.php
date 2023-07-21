<x-layout title="Séries">
@auth
    <a href="{{route('series.create')}}" class="btn btn-dark mb-2">adicionar</a>
@endauth
<ul class="list-group">
    @isset($successMessage)
        <div class="alert alert-success">
            {{$successMessage}}
        </div>
    @endisset
    @foreach ($series as $serie)
    <li class="list-group-item d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center">
            <img class="me-3" src="{{ asset('storage/'.$serie->cover) }}" width="100" alt="Capa da série" class="img-thumbnail">
            @auth<a href="{{ route('seasons.index',$serie->id) }}">@endauth
                {{ $serie->nome }}
            @auth</a>@endauth
        </div>
        @auth
            <span class="d-flex">
                <a class="btn btn-primary btn-sm me-2" href="{{route('series.edit', $serie->id)}}">
                    Editar
                </a>
                <form action="{{route('series.destroy',$serie->id)}}" method="POST">
                    @csrf
                    <button class="btn btn-danger btn-sm">
                        X
                    </button>
                </form>
            </span>
        @endauth
    </li>
    @endforeach
</ul>
</x-layout>