<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuestionType extends Model
{
    protected $fillable = [
        'name', 'desc', 'title','howto','status','created_by','modified_by'
    ];

    public function choiceList()
    {
        return $this->hasMany( 'App\choiceList', 'question_type_id');
    }

    public function quizSubDetail()
    {
        return $this->hasMany('App\QuizSubDetail', 'question_type_id');
    }

}
