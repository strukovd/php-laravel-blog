<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class tagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::insert('
            INSERT INTO `tags`
            (`id`, `name`) VALUES
            (1, "HTTP"),
            (2, "Сеть"),
            (3, "Сокеты"),
            (4, "UML"),
            (5, "Диаграммы"),
            (6, "C++"),
            (7, "PHP"),
            (8, "Уроки"),
            (9, "Исскуственный интелект"),
            (10, "Интернет"),
            (11, "Программирование");
            ');
    }
}
