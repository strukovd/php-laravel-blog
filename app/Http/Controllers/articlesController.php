<?php

namespace App\Http\Controllers;

use App\Article;
use App\Comment;
use App\Tag;
use App\MyPagination;

use Illuminate\Http\Request;

class articlesController extends Controller
{
    /**
     * @var int $countArticles Количество записей
     */
    private $countArticles;
    /**
     * @var int $curPage Текущая страница
     */
    private $curPage;
    /**
     * @var int $articlesOnPage Количество записей на странице
     */
    private $articlesOnPage = 3;












    //==========================================================================================================
    /**
    * Достает из бд одну страницу статей, вместе с ее тегами
    *
    * @param int $curPage текущая таблица
    * @param int $articlesOnPage количество статей на страницу
    * @return array
    */
    function getPageArticles($curPage, $articlesOnPage = 3)
    {
        $this->countArticles = Article::count();
        $this->curPage = $curPage;
        $this->articlesOnPage = $articlesOnPage;


        return Article::select('id', 'title', 'text', 'created_at')
            ->with('tags')
            ->offset( ($curPage-1)*$articlesOnPage )
            ->limit( $articlesOnPage )
            ->orderBy('created_at', 'DESC')
            ->get();
    }












    //==========================================================================================================
    /**
     * Получение страницы со списком статей
     *
     * @param int $curPage текущая страница
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    function index($curPage=1)
    {
        $articles = $this->getPageArticles( $curPage );
        $tags = Tag::limit(100)->get();


        return view('articles',
        [
            'articles'=>$articles,
            'tags'=>$tags,
            'pages'=>MyPagination::getData($curPage, 7, $this->countArticles, $this->articlesOnPage)
        ]);
    }












    //==========================================================================================================
    /**
     * Получение страницы со статьей
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    function show($id)
    {
        $article = Article::select('id', 'title', 'text', 'created_at')
            ->with('tags')
            ->with('comments')
            ->where('id', $id)
            ->first();

        $tags = Tag::limit(100)
            ->get();


        return view('article',
            [
                'article'=>$article,
                'tags'=>$tags
            ]);
    }












    //==========================================================================================================
    /**
     * Создание нового комментария
     *
     * @param Request $request
     * @param $id
     * @throws \Illuminate\Validation\ValidationException
     * @return Response
     */
    function addComment(Request $request, $id)
    {

        $rules =
            [
                'name'=>'required',
                'text'=>'required'
            ];
        $this->validate($request, $rules);


        $a = Article::findOrFail($id);

        $c = new Comment(['name'=>$request->input('name'), 'text'=>$request->input('text')]);

        $a->comments()->save($c);
        $a->save();

        return redirect()->back();
    }












    //==========================================================================================================
    /**
     * Получение страницы - создания новой статьи
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    function create()
    {
        $tags = Tag::limit(100)->get();

        return view('create',
        [
            'tags'=>$tags
        ]);
    }












    //==========================================================================================================
    /**
     * Обработка создания новой статьи
     *
     * @param Request $request
     * @throws \Illuminate\Validation\ValidationException
     * @return
     */
    function store(Request $request)
    {
        $rules =
            [
                'title'=>'required',
                'date'=>'date',
                'text'=>'required'
            ];
        $this->validate($request, $rules);

        //Если валидация пройдена
        $a = new Article(['title'=>$request->input('title'), 'text'=>$request->input('text'), 'created_at'=>$request->input('date')]);
        $a->save();

        //Получение тегов в виде массива
        $receivedTags =  explode( ',', $request->input('tags') ) ;
        $tags = [];

        for($i=0; $i<count($receivedTags); $i++)
        {
            $receivedTags[$i] = trim( $receivedTags[$i] );
            if ( '' != $receivedTags[$i] )
            {
                $tags[] = Tag::firstOrCreate( [ 'name'=>$receivedTags[$i] ] );
            }
        }
        //Привязка к каждому тегу
        foreach ($tags as $tag)
        {
            $a->tags()->attach( $tag->id );
        }

        return redirect()->route('articles.index');
    }












    //==========================================================================================================
    /**
     * Получение страницы со списком статей, с определенным тегом
     *
     * @param int $tagID номер тега
     * @param int $curPage номер страницы
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    function tagsIndex($tagID, $curPage=1)
    {
        $this->countArticles = Tag::withCount('articles')->findOrFail($tagID)->articles_count;

        $articles = Tag::with('articles')->findOrFail($tagID)
            ->articles()
            ->limit($this->articlesOnPage)
            ->offset( ($curPage-1)*$this->articlesOnPage )
            ->with('tags')
            ->get();

        $tags = Tag::limit(100)->get();


        return view('tags',
            [
                'articles'=>$articles,
                'tags'=>$tags,
                'pages'=>MyPagination::getData($curPage, 7, $this->countArticles, $this->articlesOnPage),
                'tagID'=>$tagID
            ]);
    }












    //==========================================================================================================
    /**
     * Возвращает список тегов похожий на $text в формате JSON
     *
     * @param $text
     *
     * @return false|string
     */
    function getTags($text)
    {
        $tags = Tag::where('name','LIKE',$text.'%')->get();
        return json_encode($tags);
    }

}
