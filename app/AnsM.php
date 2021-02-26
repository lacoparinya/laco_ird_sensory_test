<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AnsM extends Model
{
    protected $fillable = [
        'quiz_id', 'name', 'test_date', 'status','created_by','modified_by','company',
        'comment1', 'comment2','company_type', 'product_type', 'product_name',
        'sale_comment'
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
