<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuizD extends Model
{
    protected $fillable = [
        'quiz_m_id','name', 'desc', 'seq', 'status','created_by','modified_by'
    ];
}
