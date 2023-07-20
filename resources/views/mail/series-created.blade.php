@component('mail::message')
# {{$nomeSerie}} foi adicionada com sucesso

A série {{$nomeSerie}} com {{$qtdTemporadas}} temporadas e {{$episodiosPorTemporada}} episódios foi adicionada ao catalogo

Acesse aqui:

@component('mail::button', ['url' => route('seasons.index', $idSerie)])
    Ver Série
@endcomponent
    
@endcomponent
