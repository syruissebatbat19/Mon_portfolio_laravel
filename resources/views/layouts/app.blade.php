<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield("title", "Kone Hamed - Développeur web et mobile")</title>
    <meta name="description" content="Portfolio de Kone Hamed, développeur web et mobile fullstack junior à Abidjan.">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Hanken+Grotesk:wght@400;500;700&family=Unbounded:wght@600;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
    <div class="wrap">
        <header class="nav">
            <a class="brand" href="{{ route("home") }}">Kone Hamed</a>
            <nav>
                <a href="{{ route("home") }}#projets">Projets</a>
                <a href="{{ route("home") }}#competences">Compétences</a>
                <a href="{{ route("home") }}#parcours">Parcours</a>
                <a href="{{ route("home") }}#contact">Contact</a>
            </nav>
        </header>

        @yield("content")

        <footer class="foot">© {{ date("Y") }} Kone Hamed, Abidjan</footer>
    </div>
</body>
</html>
