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
    <h2 class="article-header">{{ $article->title }}</h2>
    <div class="wr-content">
        <section class="wr-article">
            <article>
                <nav class="blif">
                    <div class="date">{{ $article->created_at }}</div>
                    @foreach($article->tags as $t)
                    <div class="curTags">{!! '<a href="'. url('/tag/'.$t['id']) .'">'. $t['name'] .'</a>' !!}</div>
                    @endforeach
{{--                    <div class="curTags">{!! $article->tags !!}</div>--}}
                </nav>
                <div class="article-content">
                    {{ $article->text }}
                </div>
            </article>

            <div class="comments">
                @foreach($article->comments as $c)
                <div class="comment">
                    <div class="com-name">{{ $c->name }}</div>
                    <div class="com-text">{{ $c->text }}</div>
                </div>
                @endforeach
            </div>
            <hr>
            @if( count($errors)>0 )
                <div style="background: #f3a2a2; padding: .6em .2em;">
                    <ul style="list-style: none;">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form method="POST" class="addComment">
                <div id="wr-name">
                    <label>
                        <input name="name" type="text" placeholder="Имя" value="" required="">
                    </label>
                </div>
                <div id="wr-text">
                    <label>
                        <textarea name="text" placeholder="Комментарий" required=""></textarea>
                    </label>
                </div>
                @csrf
                <div>
                    <button type="submit">Отправить</button>
                </div>
            </form>
        </section>
        <section class="content-right">
            <h2>Теги</h2>
            @component('components.tags', ['tags'=>$tags])@endcomponent
        </section>
    </div>
@endsection

















@section('footer')
    <style>
        footer{
            height: 100px;
        }
        footer:active img
        {
            display:inline !important;
        }
    </style>
    <img src="{{url('img/1.png')}}" alt="22" style="display:none">
@endsection

