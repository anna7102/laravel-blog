<?php

use Illuminate\Database\Seeder;

use App\Tag;

class TagTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $tag = new Tag();
        $tag->tag_name = 'tutorial';
        $tag->save();

        $tag = new Tag();
        $tag->tag_name = 'news';
        $tag->save();
    }
}
