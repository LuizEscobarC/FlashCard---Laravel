<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= asset('css/boot.css')?>">
    <link rel="stylesheet" href="<?= asset('css/css.css')?>">
    <link rel="stylesheet" href="<?= asset('css/image-icon.css')?>">
    <title>Dream Card</title>
</head>
<body>

<header class="main_header">
    <section class="main_header_section">
        <h1>Title</h1>

        <nav>
            <ul>
                <li><a href="{{ route('home.begin') }}">Biblioteca</a></li>
                <li><a href="{{ route('folder.explorer') }}">Explorar</a></li>
                <li><a href="{{ route('card.create') }}">Criar</a></li>
            </ul>
        </nav>
        <form method="get" action="{{ route('folder.explorer') }}">
            <input type="search" name='filter' placeholder="Pesquisa por titulo">
        </form>
        <div class="images">
            <img src="<?= asset('images/bell-white.png'); ?>" alt="bell" title="bell">
            <img class="profile" src="<?= asset('images/OIP.jpg'); ?>">
        </div>
    </section>
</header>

<section class="main_body">
    <div class="main_body_container">

    @yield('content')

    <!-- ASIDE --->
        <aside class="main_body_aside">

            @foreach( $users as $user)
                <article class="article_aside">
                    <header>
                        <img src="<?= asset('images/OIP.jpg'); ?>">
                        <p>{{ $user['name'] }}</p>
                    </header>
                    <div class="btn bg_light_green_aside">follow</div>
                </article>
            @endforeach

        </aside>
    </div>
</section>

<script src="<?= asset('js/card.js') ?>"></script>
<script src="<?= asset('js/ajax.js') ?>"></script>
</body>
</html>
