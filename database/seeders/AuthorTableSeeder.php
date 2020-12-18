<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AuthorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('authors')->insert([
            [
                'name' => 'Иван',
                'surname' => 'Котляревский'
            ],
            [
                'name' => 'Тарас',
                'surname' => 'Шевченко'
            ],
            [
                'name' => 'Леся',
                'surname' => 'Украинка'
            ],
            [
                'name' => 'Марко',
                'surname' => 'Вовчок'
            ],
            [
                'name' => 'Иван',
                'surname' => 'Франко'
            ],
            ],
        );
    }
}
