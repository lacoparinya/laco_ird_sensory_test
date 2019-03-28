<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuestionType extends Model
{
    protected $fillable = [
        'name', 'desc', 'status','created_by','modified_by'
    ];

    public function choiceList()
    {
        return $this->hasMany( 'App\choiceList', 'question_type_id');
    }

}
