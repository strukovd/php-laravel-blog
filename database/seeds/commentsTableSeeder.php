<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class commentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::insert('
            INSERT INTO `comments`
            (`article_id`, `name`, `text`) VALUES
            (1, "Дмитрий", "Классная статья!"),
            (2, "Олег", "Познавательно"),
            (2, "Мария", "Lorem ipsum dolor sit amet, consectetur adipisicing elit."),
            (3, "Антон", "maiores minima modi molestias natus nemo obcaecati provident quaerat quidem quis sit suscipit temporibus veritatis! Accusantium delectus iusto magni minima molestias qui, rem voluptatem."),
            (6, "Виталий", "Adipisci aliquam aut autem beatae culpa dolorem doloremque dolores earum eos error est et explicabo, fuga, incidunt iste maiores minima modi molestias natus nemo obcaecati provident quaerat quidem quis sit suscipit temporibus veritatis!"),
            (1, "Анастасия", "consectetur adipisicing elit. Adipisci aliquam aut autem beatae culpa dolorem doloremque");
            ');
    }
}
