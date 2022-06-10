<?php

namespace App;

/**
 * Класс для расчета количества номерков страниц
 *
 * Class MyPagination
 * @package App\Http\Controllers
 */
class MyPagination
{
    /**@var int Текущая страница*/
    public $curPage;
    /**@var int Начало пагинации (Первое число номерков)*/
    public $start;
    /**@var int Конец пагинации (Последнее число номерков)*/
    public $end;
    /**@var int Последняя страница (Всего возможных страниц)*/
    public $lastPage;

    /**@var int Количество статей в БД*/
    private $countArticles;
    /**@var int Количество статей на 1 страницу*/
    private $articlesOnPage;

    /**@var int Максимальное количество страниц*/
    private $limitPages;
    /**@var int Номеров с лева*/
    private $left;
    /**@var int Номеров с права*/
    private $right;


    /**
     * MyPagination constructor.
     * @param $curPage
     * @param $limitPages
     * @param $countArticles
     * @param $articlesOnPage
     *
     * @return \App\Http\Controllers\MyPagination
     */
    public function __construct( $curPage, $limitPages, $countArticles, $articlesOnPage )
    {
        $this->curPage = $curPage;
        $this->limitPages = $limitPages;

        $this->left = floor( ($limitPages-1) / 2 ); //Тут меньше
        $this->right = ceil( ($limitPages-1) / 2 ); //Тут больше, если не четное

        $this->countArticles = $countArticles;
        $this->articlesOnPage = $articlesOnPage;
        $this->lastPage = ceil($this->countArticles / $this->articlesOnPage); //Всего страниц, округлить до большего

        return $this->calculate();
    }


    function calculate()
    {
        $this->start = $this->curPage - $this->left;
        $this->end = $this->curPage + $this->right;


        $lost = 0;//Потеряно, разница, лишнее

        if($this->start < 1)
        {
            $lost = $this->curPage - $this->start; //4
            $this->start = 1;
        }

        $this->end += $lost;


        if($this->end > $this->lastPage) //Если конец больше допустимого
        {
            $lost = $this->end - $this->lastPage;
            $this->end -= $lost;
            $this->start -= $lost;
            if($this->start < 1) $this->start = 1; //Если за границей
        }

        $totalShowPages = ($this->end - $this->start + 1); //Общее количество номеров

        if ( $totalShowPages > $this->limitPages ) //Количество номеров больше допустимого
        {
            //То обрежем лишнее в конце
            $lost = $totalShowPages - $this->limitPages;//Лишнее
            $this->end -= $lost;
        }


        return $this;
    }


    /**
     * Возвратит экземпляр класса с расчитанными полями. С их помощью строится блок номеров пагинации.
     *
     * @param $curPage
     * @param $limitPages
     * @param $countArticles
     * @param $articlesOnPage
     *
     * @return MyPagination
     */
    public static function getData( $curPage, $limitPages, $countArticles, $articlesOnPage )
    {
        return new MyPagination( $curPage, $limitPages, $countArticles, $articlesOnPage );
    }



}

