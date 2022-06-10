<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $table = 'articles';
    protected $primaryKey = 'id';
    public $incrementing = true;
    public $timestamps = false;

    protected $fillable = ['title', 'text', 'created_at'];

    /**
     * Аксессор возвращает дату на русском, в формате "День Месяц Год"
     *
     * @return string
     */
    public function getCreatedAtAttribute()
    {
        $m = ['', 'Января', 'Февраля', 'Марта', 'Апреля', 'Мая', 'Июня', 'Июля', 'Августа', 'Сентября', 'Октября', 'Ноября', 'Декабря'];
        $d = getdate(strtotime( $this->attributes['created_at'] ));
        return $d['mday'] . ' ' . $m[$d['mon']] . ' ' . $d['year'];
    }

    public function comments()
    {
        return $this->hasMany('App\Comment', 'article_id', 'id');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
}
