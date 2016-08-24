@extends('master')

@section('content')
    <h1>Wait But Why</h1>
    <ul class="post-list">
        @foreach($article->list as $item)
            <li>
                {!! $item->image !!}
                <div class="post-title">{!! $item->title !!}</div>
            </li>
        @endforeach
    </ul>
@endsection
