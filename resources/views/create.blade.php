@extends('layouts.article')

@section('cssPlace')
    <link rel="stylesheet" href="{{ url('css/article.css') }}">
    <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:300,400,700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700&display=swap" rel="stylesheet">
@endsection

@section('jsPlace')
    <script src="/js/validations.js"></script>
@endsection



@section('header')
    @include('layouts.header')
@endsection

@section('main-content')
    <h2 class="article-header">Добавление новой статьи</h2>
    <div class="wr-content">
        <section class="wr-article">

            @if( count($errors)>0 )
                <div style="background: #f3a2a2; padding: .6em .2em;">
                    <ul style="list-style: none;">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="" method="post" class="createArticleForm">
                <div id="wr-title">
                    <label>
                        <input name="title" type="text" placeholder="Тема статьи" value="{{old('title')}}" required>
                    </label>
                </div>
                <div id="wr-date">
                    <label>
                        <input name="date" type="date" value="{{old('date')}}" required>
                    </label>
                </div>
                <div id="wr-tags">
                    <label>
                        <input id="hiddenTags" type="hidden" name="tags">
                        <input list="tagsList" id="inputTags" type="text" placeholder="Теги">
                        <datalist id="tagsList">
                        </datalist>
                    </label>
                    <ul class="selectTags">
                    </ul>
                </div>
                <div id="wr-text">
                    <label>
                        <textarea name="text" placeholder="Введите текст статьи" required>{{old('text')}}</textarea>
                    </label>
                </div>
                <div>
                    <button type="submit">Добавить статью</button>
                </div>
                @csrf
            </form>
        </section>
        <section class="content-right">
            <h2>Теги</h2>
            @component('components.tags', ['tags'=>$tags])@endcomponent
        </section>
    </div>
@endsection



















