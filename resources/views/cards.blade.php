@extends('theme', ['users' => \App\Users::select('*')->limit(5)->get()])

@section('content')

    <section class="main_body_article_left">
        @if($card)
            <div class="main_card">
                <div class="main_card_container">
                    <div class="card_front">
                        <p>{{ $card->front }}</p>
                    </div>

                    <div class="card_back">
                        <p>{{ $card->back }}</p>
                        @if($card->img)
                        <div class="container_img">
                            <img alt='imagem do cartão' width="100" class="img_left"
                                 src="{{ asset("storage/$card->img") }}"/>
                        </div>
                        @endif
                    </div>
                </div>
                <div class="main_pages">
                    <a class="bg_purple button_edit" href="{{ route('card.edit-get', $folder->id) }}">Editar Pasta</a>
                </div>
                <div class="main_pages">
                    <a class="bg_light_green" href="{{ $card->paginate()->previousPageUrl() }}"> < </a>
                    <a class="bg_light_green" href="{{ $card->paginate()->nextPageUrl() }}"> > </a>
                </div>
            </div>
        @else
            <div class="main_card">
                <div class="main_card_container">
                    <div class="card_front">
                        <h2 class="title">Acabou por aqui bora voltar a biblioteca?</h2>
                        <a class="btn bg_black_green" href="{{ route('home.begin') }}">Biblioteca</a>
                    </div>

                    <div class="card_back">
                        <h2 class="title">Acabou por aqui bora voltar a biblioteca?</h2>
                        <a class="btn bg_black_green" href="{{ route('home.begin') }}">Biblioteca</a>
                    </div>
                </div>
                <div class="main_pages">
                    <a class="bg_purple button_edit" href="{{ route('card.edit-get', $folder->id) }}">Editar Pasta</a>
                </div>
                <div class="main_pages">
                    <a class="bg_purple button_edit" href="{{ route('card.edit-get', $folder->id) }}">Editar Pasta</a>
                </div>
            </div>
        @endif

    </section>
@endsection
