<?php

use Illuminate\Database\Seeder;

use App\Post;

class PostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $post = new Post(
            [
                'title' => 'title1',
                'content' => 'content1'
            ]);

        $post->save();

        $post = new Post(

            [
                'title' => 'title1',
                'content' => 'content1'
            ]);

        $post->save();
    }
}
