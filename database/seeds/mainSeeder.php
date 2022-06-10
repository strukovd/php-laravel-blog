<?php

use Illuminate\Database\Seeder;

class mainSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(articlesTableSeeder::class);
        $this->call(tagsTableSeeder::class);
        $this->call(article_tagTableSeeder::class);
        $this->call(commentsTableSeeder::class);
    }
}
