<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChoiceList extends Model
{
    protected $fillable = [
        'question_type_id', 'label','value','seq', 'status','created_by','modified_by'
    ];


    public function questionType(){
     
       return $this->hasOne('App\QuestionType', 'id', 'question_type_id');
    }
}
