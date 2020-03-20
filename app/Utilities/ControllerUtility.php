<?php
namespace App\Utilities;

class ControllerUtility {
    public static function decodeAnswerJsonFile($questions)
    {
        // if (count($questions) == 1) {
        //     dd(($questions));
        //     $questions->answer->incorrect = json_decode($questions->answer->incorrect, true);
        // }
        // elseif($questions->count() > 1) {
            foreach ($questions as $question) {
                $question->answer->incorrect = json_decode($question->answer->incorrect, true);
            }
        // }
        return $questions;
    }

}
