@extends('theme', ['users' => \App\Users::select('*')->limit(5)->get()])

@section('content')
    <div class="form_left_side">
        <section class="main_button">
            <div class="button_container">
                <a class="bg_red" id='delete_button' data-folderId="{{ $folder->id }}" href="{{ route('folder.delete', $folder->id) }}">Excluir Pasta</a>
            </div>
        </section>
        <div class="main_form">
            <form class="main_app_form edit" method="post" action="{{ route('card.create-folder-post') }}">
                @csrf
                <input type="hidden" name="folder_id" value="{{ $folder->id }}">
                <input type="text" name="title"
                       placeholder='Digite um título como "Biologia - Capítulo 22:evolução' value="{{ $folder->title }}">
                <textarea tabindex="6" name="description"
                          placeholder='Adicione uma descrição...'>{{ $folder->description }}</textarea>
            </form>
        </div>

        <?php $i = 1 ?>
        @foreach($cards as $card)
        <?php  $i++ ?>
            <div class="main_form_edit">
            <form class="main_app_form_edit edit" method="post" action="{{ route('card.edit-post') }}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="card_id" value="{{ $card->id }}">
                <input type="text" name="front"
                       placeholder='Digite um conceito...' value="{{ $card->front }}">
                <textarea tabindex="6" name="back" class='back' placeholder='Adicione uma descrição...'>{{ $card->back }}</textarea>
                @if($card->img)
                <div class="container_img">
                    <img class="img_left" src="{{ ( !empty($card->img) ? env('URL_APP') . "/storage/" . $card->img : ' ') }}">
                </div>
                @endif
                <label for='selecao-arquivo{{ $i }}' class="btn bg_light_green">
                    <div class="gg-image"></div>
                </label>
                <input id="selecao-arquivo{{ $i }}" type='file' name="image">
                <div class="btn bg_purple plus"> + </div>
            </form>
        </div>
        @endforeach

        <section class="main_button">
            <div class="button_container">
                <button class="bg_purple" id='submit_button'>Atualizar</button>
            </div>
        </section>
    </div>
@endsection
