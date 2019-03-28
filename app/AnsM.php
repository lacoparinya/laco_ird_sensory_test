<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AnsM extends Model
{
    protected $fillable = [
        'quiz_id', 'name', 'test_date', 'status','created_by','modified_by'
    ];

    public function quizM()
    {
        return $this->hasOne('App\QuizM', 'id', 'quiz_id');
    }

    public function ansD()
    {
        return $this->hasMany('App\AnsD', 'ans_m_id');
    }
}
