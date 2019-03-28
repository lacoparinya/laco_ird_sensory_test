<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AnsD extends Model
{
    protected $fillable = [
        'quiz_d_id', 'ans_m_id',
        'cus1_i', 'cus2_i', 'cus3_i', 'cus4_i', 'cus5_i', 'cus6_i',
        'cus1_s', 'cus2_s', 'cus3_s', 'cus4_s', 'cus5_s', 'cus6_s', 
        'created _by','modified_by'
    ];

    public function quizD()
    {
        return $this->hasOne('App\QuizD', 'id', 'quiz_d_id');
    }
}
