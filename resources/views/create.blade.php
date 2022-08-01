@extends('theme', ['users' => \App\Users::select('*')->limit(5)->get()])

@section('content')
        <div class="form_left_side">
            <div class="main_form">
                <form class="main_app_form" method="post" action="{{ route('card.create-folder-post') }}">
                    @csrf
                    <input type="text" name="title"
                           placeholder='Digite um título como "Biologia - Capítulo 22:evolução"'>
                    <textarea tabindex="6" name="description"
                              placeholder='Adicione uma descrição...'></textarea>
                </form>
            </div>

            <div class="main_form_edit">
                <form class="main_app_form_edit create" method="post" action="{{ route('card.create-cards-post') }}" enctype="multipart/form-data">
                    @csrf
                    <input type="text" name="front"
                           placeholder='Digite um conceito...'>
                    <textarea tabindex="6" name="back" class='back' placeholder='Adicione uma descrição...'></textarea>
                    <label for='selecao-arquivo' class="btn bg_light_green">
                        <div class="gg-image"></div>
                    </label>
                    <input id='selecao-arquivo' type='file' name="image">
                    <div class="btn bg_purple plus"> + </div>
                </form>
            </div>
            <section class="main_button">
                <div class="button_container">
                    <button class="bg_purple" id='submit_button'>Criar</button>
                </div>
            </section>
        </div>
@endsection
