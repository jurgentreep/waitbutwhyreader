@extends('master')

@section('content')
    <article>
        <header>
            <h1>{{ $article->title }}</h1>
            <em>{{ $article->author }}</em>
        </header>
        @foreach($article->paragraphs as $paragraph)
            <p>{!! $paragraph !!}</p>
        @endforeach
        <h2>Footnotes</h2>
        <h3>Extra information</h3>
        <ul class="footnotes-extra-info">
            @foreach($article->footnotes->extra_info as $footnote)
                {!! $footnote !!}
            @endforeach
        </ul>
        <h3>Citations & Sources</h3>
        <ul class="footnotes-citations-sources">
            @foreach($article->footnotes->citations_sources as $footnote)
                {!! $footnote !!}
            @endforeach
        </ul>
    </article>
    <div class="last-position hidden">
        Scroll back to where you left off?
        <button class="btn btn-default" type="button" name="yes">Yes</button>
        <button class="btn btn-default" type="button" name="no">No</button>
    </div>
@endsection
