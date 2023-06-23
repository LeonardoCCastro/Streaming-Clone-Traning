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
        {{ $serie->nome }}
        <form action="{{route('series.destroy',$serie->id)}}" method="POST">
            @csrf
            <button class="btn btn-danger btn-sm">
                X
            </button>
        </form>
    </li>
    @endforeach
</ul>
</x-layout>