<x-layout title="Séries">
<a href="{{route('series.create')}}" class="btn btn-dark mb-2">adicionar</a>
<ul class="list-group">
    @isset($successMessage)
        <div class="alert alert-success">
            {{$successMessage}}
        </div>
    @endisset
    @foreach ($series as $serie)
    <li class="list-group-item d-flex justify-content-between align-items-center">
        <a href="{{ route('seasons.index',$serie->id) }}">
            {{ $serie->nome }}
        </a>
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
    </li>
    @endforeach
</ul>
</x-layout>