<?php

use Illuminate\Database\Seeder;

class SubjectTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Subject::class, 50)->create()->each(function ($subject) {

            $questions = factory(App\Question::class, rand(4,40))->make();
            $subject->questions()->saveMany($questions);

            foreach ($questions as $question ){
                $answer = factory(App\Answer::class)->make();
                $question->answer()->save($answer);

                $explanation = factory(App\Explanation::class)->make();
                $question->explanation()->save($explanation);

                $comment = factory(App\Comment::class)->make();
                $question->comment()->save($comment);
            }
        });
    }
}
