<?php

class ArticlesTableSeeder extends Seeder
{
    public function run()
    {
        DB::table("articles")->delete();
        Laracasts\TestDummy\Factory::times(50)->create('Article');
    }
} 