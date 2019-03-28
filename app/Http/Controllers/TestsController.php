<?php

namespace App\Http\Controllers;

use App\QuizM;
use App\QuizD;
use App\QuestionType;
use App\AnsM;
use App\AnsD;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TestsController extends Controller
{
    public function runtest($id)
    {
        $quizM = QuizM::findOrFail($id);
        if($quizM->status == 'running'){
            return view('tests.runtest', compact( 'quizM'));
        }else{
            return redirect('quizs/list')->with('flash_message', ' save!');
        }
    }

    public function store($id,Request $request){
        $requestData = $request->all();

        $quizM = QuizM::findOrFail($id);

        $resultid = 0;

        if($quizM->questionType->name == 'test_triangle'){
        
            $tmpAnsM = array();

            $tmpAnsM['quiz_id'] = $id;
            $tmpAnsM['name'] = $requestData['name'];
            $tmpAnsM['test_date'] = Carbon::now()->toDateString();
            $tmpAnsM['status'] = 'active';
            
            $resultid = AnsM::create($tmpAnsM)->id;

            $tmpAnsD = array();

            $quizD = QuizD::findOrFail($requestData['result']);

            $tmpAnsD['quiz_d_id'] = $requestData['result'];
            $tmpAnsD['ans_m_id'] = $resultid;
            $tmpAnsD['cus1_i'] = $quizD->id;
            $tmpAnsD['cus1_s'] = $quizD->name;

            AnsD::create($tmpAnsD);

            

        } elseif ($quizM->questionType->name == 'test_like_summary') {

            $tmpAnsM = array();

            $tmpAnsM['quiz_id'] = $id;
            $tmpAnsM['name'] = $requestData['name'];
            $tmpAnsM['test_date'] = Carbon::now()->toDateString();
            $tmpAnsM['status'] = 'active';

            $resultid = AnsM::create($tmpAnsM)->id;

            foreach ($quizM->quizD as $value) {
                $tmpAnsD = array();

                $tmpAnsD['quiz_d_id'] = $value->id;
                $tmpAnsD['ans_m_id'] = $resultid;
                $tmpAnsD['cus1_i'] = $requestData['result'. $value->id];
                $tmpAnsD['cus1_s'] = $value->name;

                AnsD::create($tmpAnsD);
            }

            
        }




       return redirect('tests/confirm/'. $resultid)->with( 'flash_message', ' save!');
    }

    public function confirm($ansMId){
        $ansM = AnsM::findOrFail($ansMId);

        if($ansM->quizM->questionType->name == 'test_triangle'){

            return view( 'tests.confirm', compact( 'ansM'));

        } elseif ( $ansM->quizM->questionType->name == 'test_like_summary') {

            $choiceArray = array();
            foreach ( $ansM->quizM->questionType->choiceList as $key => $value) {
                $choiceArray[$value->value] = $value->label;
            }

            return view('tests.confirm', compact( 'ansM', 'choiceArray'));
        }else{

        }
    }

    public function delivery($ansMId){
        $ansM = AnsM::findOrFail($ansMId);
        $ansM->status = 'delivery';
        $ansM->update();
        return view('tests.delivery', compact('ansM'));
    }

    public function edit($ansMId){
        $ansM = AnsM::findOrFail($ansMId);

        $quizM = $ansM->quizM;

        if($ansM->quizM->questionType->name == 'test_triangle'){
            return view('tests.edit', compact('quizM', 'ansM'));
        } elseif ( $ansM->quizM->questionType->name == 'test_like_summary') {
            return view('tests.edit', compact( 'quizM', 'ansM'));
        }

    }

    public function update($id,Request $request){
        $requestData = $request->all();

        $ansM = AnsM::findOrFail( $id);

        if($ansM->quizM->questionType->name == 'test_triangle'){

            $ansM->name = $requestData['name'];
            $ansM->update();

            $quizD = QuizD::findOrFail($requestData['result']);

            $ansD = $ansM->ansD[0];
            $ansD->quiz_d_id=  $quizD->id;
            $ansD->cus1_i =  $quizD->id;
            $ansD->cus1_s =  $quizD->name;
            $ansD->update();

            return redirect('tests/confirm/'. $id)-> with('flash_message', ' save!');

        } elseif ($ansM->quizM->questionType->name == 'test_like_summary') {
            
            $ansM->name = $requestData['name'];
            $ansM->update();

            foreach ( $ansM->ansD as $item) {
                
                $item->cus1_i = $requestData['result'. $item->id];
                $item->cus1_s = $item->quizD->name;
                $item->update();
            }

            return redirect('tests/confirm/'. $id)->with ('flash_message', ' save!');
        }
    }

}