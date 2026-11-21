@extends("layouts.app")

@section("content")
<section class="hero">
    <div>
        <h1>KONE<br>HAMED</h1>
        <p class="role">Développeur web et mobile<br>fullstack junior</p>
        <p class="actions">
            <a class="btn" href="#contact">Me contacter</a>
            <a class="btn ghost" href="{{ asset("cv/CV_Kone_Hamed.pdf") }}" download>Télécharger mon CV</a>
        </p>
    </div>
    <img class="photo" src="{{ asset("images/hamed.png") }}" alt="Portrait de Kone Hamed" width="300" height="420">
</section>

<section class="block" id="apropos">
    <h2>À propos</h2>
    <p class="lead">Je conçois des applications web et mobiles avec Laravel. Étudiant en Licence 3 Génie logiciel à Cefiat, j’ai développé le back-end d’une application de remboursement d’assurance maladie pendant mon stage à la SOTRA.</p>
</section>

<section class="block" id="projets">
    <h2>Projets</h2>

    <div class="grid">
        @forelse ($projects as $project)
            <a class="card" href="{{ route('projects.show', $project) }}">
                <h3>{{ $project->title }}</h3>

                <p>{{ $project->summary }}</p>

                @if (!empty($project->technologies))
                    <p class="tags">
                        @foreach ($project->technologies as $t)
                            <span>{{ $t }}</span>
                        @endforeach
                    </p>
                @endif
            </a>
        @empty
            <p>Aucun projet pour l'instant.</p>
        @endforelse
    </div>
</section>

<section class="block" id="competences">
    <h2>Compétences</h2>
    <div class="grid">
        @foreach ($skills as $group => $items)
            <div>
                <h3>{{ $group }}</h3>
                <p class="tags">@foreach ($items as $item)<span>{{ $item }}</span>@endforeach</p>
            </div>
        @endforeach
    </div>
</section>

<section class="block" id="parcours">
    <h2>Parcours</h2>
    <ol class="timeline">
        <li><strong>Stagiaire développeur mobile</strong>SOTRA Vridi, novembre 2025 - février 2026</li>
        <li><strong>Licence 3 professionnelle, Génie logiciel</strong>Groupe Cefiat, 2025 - 2026</li>
        <li><strong>Brevet de technicien supérieur</strong>Groupe Cefiat, 2024 - 2025</li>
        <li><strong>Baccalauréat scientifique (Bac D)</strong>Catholique Saint Michel Toumodi, 2022 - 2023</li>
    </ol>
</section>

<section class="block" id="contact">
    <h2>Contact</h2>
    <div class="grid">
        <div>
            <p>saamousku19@gmail.com</p>
            <p>+225 05 00 69 59 46</p>
            <p>Abobo Anonkoua, Abidjan</p>
        </div>
        <form method="POST" action="/contact">
            @csrf
            @if (session("sent"))<p class="ok" role="status">{{ session("sent") }}</p>@endif
            <label>Nom <input name="name" value="{{ old("name") }}" required></label>
            @error("name")<small class="err">{{ $message }}</small>@enderror
            <label>Email <input type="email" name="email" value="{{ old("email") }}" required></label>
            @error("email")<small class="err">{{ $message }}</small>@enderror
            <label>Message <textarea name="body" rows="5" required>{{ old("body") }}</textarea></label>
            @error("body")<small class="err">{{ $message }}</small>@enderror
            <button class="btn" type="submit">Envoyer le message</button>
        </form>
    </div>
</section>
@endsection
