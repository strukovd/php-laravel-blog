<?php

Route::get('/{page?}', [
    'uses'=>'articlesController@index'
    ])->where('page', '[0-9]+');


Route::get('articles/{page?}',
[
    'as'=>'articles.index',
    'uses'=>'articlesController@index'
])->where('page', '[0-9]+');


Route::get('article/{id}', [
    'as'=>'article.show',
    'uses'=>'articlesController@show'
])->where('id', '[0-9]+');

Route::post('article/{id}', [
    'uses'=>'articlesController@addComment'
])->where('id', '[0-9]+');


Route::get('article/create', [
    'as'=>'article.create',
    'uses'=>'articlesController@create'
]);

Route::post('article/create', [
    'as'=>'article.store',
    'uses'=>'articlesController@store'
]);


Route::get('tag/{id}/{page?}', [
    'as'=>'article.tagIndex',
    'uses'=>'articlesController@tagsIndex'
])->where(['id' => '[0-9]+', 'page' => '[0-9]+']);

Route::get('getTags/{text}', [
    'uses' => 'articlesController@getTags',
    'as' => 'getTags']);






//Инициализация БД
Route::get('init', function ()
{
    $err = 0;
    if ( !Schema::hasTable('articles') )
    {
        $err += Artisan::call('migrate');
        $err += Artisan::call('db:seed', ['--class'=>'mainSeeder']);

        if ( $err )
            return
                '<div style="text-align:center; font:32px sans-serif; padding:2em; background:#f77a7a;">Что-то пошло не так../div>
            <div style="font:32px monospace; padding:2em; background:#e9e2e7">'. Artisan::output() .'</div>';

        else
            return
                '<div style="text-align:center; font:32px sans-serif; padding:2em; background:#b2e8b2;">Успех! Перейти на <a href="/">главную</a></div>
            <div style="font:32px monospace; padding:2em; background:#e9e2e7;">' . Artisan::output() .'</div>';
    }
    else
    {
        return '<div style="text-align:center; font: 32px sans-serif; padding:2em; background:#f77a7a">Таблица articles уже существует!</div>';
    }
});
