<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Explanation extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'body', 'question_id',
    ];

    public function question()
    {
        return $this->belongsTo(Question::class);
    }
}
