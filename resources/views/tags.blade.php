@extends('layouts.article')

@section('cssPlace')
    <link rel="stylesheet" href="{{ url('css/article.css') }}">
    <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:300,400,700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700&display=swap" rel="stylesheet">
@endsection

@section('header')
    @include('layouts.header')
@endsection


@section('main-content')
    <div class="wr-content">
        <section class="wr-articles">
            @foreach($articles as $article)
            <article>
                <h3 class="article-title"><a href="{{ url('article') .'/'. $article->id }}">{{ $article->title }}</a></h3>
                <nav class="blif">
                    <div class="date">{{ $article->created_at }}</div>
                    @foreach($article->tags as $t)
                        <div class="curTags">{!! '<a href="'. url('/tag/'.$t['id']) .'">'. $t['name'] .'</a>' !!}</div>
                    @endforeach
                </nav>
                <div class="article-content">
                    {{ $article->text }}
                </div>
                <div class="show-more">
                    <a href="{{ url('article').'/'.$article->id }}">Читать далее...</a>
                </div>
            </article>
            @endforeach

            <nav class="pagination">
                <ul>
                    <li><a href="/tag/{{ $tagID }}/1" class="side">Первая</a></li>
                    @for($i=$pages->start; $i<=$pages->end; $i++)
                        @if($i == $pages->curPage)
                            {!! '<li><a class="curPage">'. $i .'</a></li>' !!}
                        @else
                            {!! '<li><a href="/tag/'. $tagID. '/' . $i .'">'. $i .'</a></li>' !!}
                        @endif
                    @endfor
                    <li><a href="/tag/{{ $tagID. '/' .$pages->lastPage }}" class="side">Последняя</a></li>
                </ul>
            </nav>
        </section>
        <section class="content-right">
            <div class="createArticle">
                <a href="/article/create">Добавить статью</a>
            </div>
            <h2>Теги</h2>
            @component('components.tags', ['tags'=>$tags])@endcomponent
        </section>
    </div>
@endsection








