@extends("layouts.app")

@section("title", $project->title . " - Kone Hamed")

@section("content")
<section class="block">
    <p><a href="{{ route("home") }}#projets">Retour aux projets</a></p>
    <h1 class="small">{{ $project->title }}</h1>
    @if ($project->role)<p class="role">{{ $project->role }}</p>@endif
    @if ($project->technologies)
        <p class="tags">@foreach ($project->technologies as $t)<span>{{ $t }}</span>@endforeach</p>
    @endif
    <div class="lead">
        @foreach (preg_split("/\n{2,}/", $project->description) as $para)
            <p>{{ $para }}</p>
        @endforeach
    </div>
    <p class="actions">
        @if ($project->github_url)<a class="btn" href="{{ $project->github_url }}">Voir le code</a>@endif
        @if ($project->demo_url)<a class="btn ghost" href="{{ $project->demo_url }}">Voir la démo</a>@endif
    </p>
</section>
@endsection
