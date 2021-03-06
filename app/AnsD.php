<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AnsD extends Model
{
    protected $fillable = [
        'quiz_d_id', 'ans_m_id',
        'quiz_sub_detail_id',
        'cus1_i', 'cus2_i', 'cus3_i', 'cus4_i', 'cus5_i', 'cus6_i','cus7_i', 'cus8_i', 'cus9_i', 'cus10_i',
        'cus1_s', 'cus2_s', 'cus3_s', 'cus4_s', 'cus5_s', 'cus6_s', 'cus7_s', 'cus9_s', 'cus9_s', 'cus10_s',
        'cus1_ref', 'cus2_ref', 'cus3_ref', 'cus4_ref', 'cus5_ref', 'cus6_ref', 'cus7_ref', 'cus8_ref', 'cus9_ref', 'cus10_ref', 
        'comments',
        'created _by','modified_by'
    ];

    public function quizD()
    {
        return $this->hasOne('App\QuizD', 'id', 'quiz_d_id');
    }

    public function quizSubDetail()
    {
        return $this->hasOne('App\QuizSubDetail', 'id', 'quiz_sub_detail_id');
    }

    public function ref1()
    {
        return $this->hasOne('App\QuizSubDetail', 'id', 'cus1_ref');
    }

    public function ref2()
    {
        return $this->hasOne('App\QuizSubDetail', 'id', 'cus2_ref');
    }

    public function ref3()
    {
        return $this->hasOne('App\QuizSubDetail', 'id', 'cus3_ref');
    }

    public function ref4()
    {
        return $this->hasOne('App\QuizSubDetail', 'id', 'cus4_ref');
    }

    public function ref5()
    {
        return $this->hasOne('App\QuizSubDetail', 'id', 'cus5_ref');
    }

    public function ref6()
    {
        return $this->hasOne('App\QuizSubDetail', 'id', 'cus6_ref');
    }
}
