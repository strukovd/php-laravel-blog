<?php

use App\Article;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class article_tagTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::insert('
            INSERT INTO `article_tag`
            (`article_id`, `tag_id`) VALUES
            (1, 1),(9, 1),(1, 2),(3, 2),(2, 3),(3, 3),(4, 4),(5, 6),(7, 6),(6, 7),(1, 8),(5, 8),(8, 8),(9, 8),(8, 9),(1, 10),(2, 10),(3, 11),(6, 11),(7, 11);
            ');
    }
}
