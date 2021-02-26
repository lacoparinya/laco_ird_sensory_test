<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuizM extends Model
{
    protected $fillable = [
        'question_type_id','name', 'desc', 'test_date', 'time_no', 'status','created_by','modified_by',
        'result_comment'
    ];

    public function quizD()
    {
        return $this->hasMany( 'App\QuizD', 'quiz_m_id');
    }

    public function questionType()
    {
        return $this->hasOne('App\QuestionType', 'id', 'question_type_id');
    }

    public function ansM()
    {
        return $this->hasMany('App\AnsM', 'quiz_id');
    }
}
