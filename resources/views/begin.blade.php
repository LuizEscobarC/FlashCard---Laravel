@extends('theme', ['users' => \App\Users::select('*')->limit(5)->get()])

@section('content')
    <article class="main_body_article_left">
        <header>
            <h2>Atividades recentes</h2>
        </header>
        @foreach( $folders as $folder)
            <article class="article_children">
                <h3><a href="{{ route('card.myCards', $folder->id) }}">{{ $folder['title'] }}</a></h3>
                <p><a href="{{ route('card.myCards', $folder->id) }}">{{ ($folder->countCards() ?? 0) }} cartões</a></p>
                <p title="{{ $folder->description }}">
                    {{ \Illuminate\Support\Str::limit($folder->description, 20) }}
                </p>
                <img src="<?= asset('images/OIP.jpg') ?>">
                <a>{{ $folder->user()['name'] }}</a>
            </article>
        @endforeach
    </article>
@endsection
