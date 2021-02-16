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
            $tmpAnsD['comments'] = $requestData['comments'];

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
                $tmpAnsD['comments'] = $requestData['comment' . $value->id];

                AnsD::create($tmpAnsD);
            }
        } elseif ($quizM->questionType->name == 'test_like_details') {

            $ansList = array(
                '' => '===เลือก==='
            );
            foreach ($quizM->questionType->choiceList as $ansValue) {
                $ansList[$ansValue->value] = $ansValue->label;
            }

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
                $tmpAnsD['comments'] = $requestData['comment'. $value->id];
                $loop = 1;

                foreach ($quizM->questionType->quizSubDetail as $subitem){
                    $tmpAnsD['cus'.$loop.'_i'] = $requestData['answer'.   $value->id .'-'. $subitem->id];
                    $tmpAnsD['cus' . $loop . '_s'] = $ansList[ $requestData['answer' .   $value->id . '-' . $subitem->id]];
                    $tmpAnsD['cus' . $loop . '_ref'] = $subitem->id;
                    $loop++;
                }
                
                AnsD::create($tmpAnsD);
            }
        } elseif ($quizM->questionType->name == 'test_like_details_02') {

            $ansList = array(
                '' => '===เลือก==='
            );
            foreach ($quizM->questionType->choiceList as $ansValue) {
                $ansList[$ansValue->value] = $ansValue->label;
            }

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
                $tmpAnsD['comments'] = $requestData['comment' . $value->id];
                $loop = 1;

                foreach ($quizM->questionType->quizSubDetail as $subitem) {
                    $tmpAnsD['cus' . $loop . '_i'] = $requestData['answer' .   $value->id . '-' . $subitem->id];
                    $tmpAnsD['cus' . $loop . '_s'] = $ansList[$requestData['answer' .   $value->id . '-' . $subitem->id]];
                    $tmpAnsD['cus' . $loop . '_ref'] = $subitem->id;
                    $loop++;
                }

                AnsD::create($tmpAnsD);
            }
        } elseif ($quizM->questionType->name == 'test_like_details_ard') {

            $ansList = array(
                '' => '===เลือก==='
            );
            foreach ($quizM->questionType->choiceList as $ansValue) {
                $ansList[$ansValue->value] = $ansValue->label;
            }

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
                $tmpAnsD['comments'] = $requestData['comment' . $value->id];
                $loop = 1;

                foreach ($quizM->questionType->quizSubDetail as $subitem) {
                    $tmpAnsD['cus' . $loop . '_i'] = $requestData['answer' .   $value->id . '-' . $subitem->id];
                    $tmpAnsD['cus' . $loop . '_s'] = $ansList[$requestData['answer' .   $value->id . '-' . $subitem->id]];
                    $tmpAnsD['cus' . $loop . '_ref'] = $subitem->id;
                    $loop++;
                }

                AnsD::create($tmpAnsD);
            }


        } elseif ($quizM->questionType->name == 'test_reference') {

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
                $tmpAnsD['cus1_i'] = $requestData['result' . $value->id];
                $tmpAnsD['cus1_s'] = $value->name;
                $tmpAnsD['comments'] = $requestData['comment' . $value->id];

                AnsD::create($tmpAnsD);
            }
        } elseif ($quizM->questionType->name == 'test_like_details_v2') {

            $ansList = array(
                '' => '===เลือก==='
            );
            foreach ($quizM->questionType->choiceList as $ansValue) {
                $ansList[$ansValue->value] = $ansValue->label;
            }

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
                $tmpAnsD['comments'] = $requestData['comment' . $value->id];
                $loop = 1;

                foreach ($quizM->questionType->quizSubDetail as $subitem) {
                    $tmpAnsD['cus' . $loop . '_i'] = $requestData['answer' .   $value->id . '-' . $subitem->id];
                    $tmpAnsD['cus' . $loop . '_s'] = $ansList[$requestData['answer' .   $value->id . '-' . $subitem->id]];
                    $tmpAnsD['cus' . $loop . '_ref'] = $subitem->id;
                    $loop++;
                }

                AnsD::create($tmpAnsD);
            }
        } elseif ($quizM->questionType->name == 'sale_customer_satisfaction_survey') {

            $ansList = array(
                '' => '===เลือก==='
            );
            foreach ($quizM->questionType->choiceList as $ansValue) {
                $ansList[$ansValue->value] = $ansValue->label;
            }

            $tmpAnsM = array();

            $tmpAnsM['quiz_id'] = $id;
            $tmpAnsM['company'] = $requestData['company'];
            $tmpAnsM['name'] = $requestData['name'];
            $tmpAnsM['test_date'] = $requestData['test_date'];
            $tmpAnsM['comment1'] = $requestData['comment1'];
            $tmpAnsM['comment2'] = $requestData['comment2'];
            $tmpAnsM['status'] = 'active';

            $resultid = AnsM::create($tmpAnsM)->id;


            foreach ($quizM->questionType->quizSubDetail as $subitem) {
                $tmpAnsD = array();

                $tmpAnsD['quiz_sub_detail_id'] = $subitem->id;
                $tmpAnsD['ans_m_id'] = $resultid;
                $tmpAnsD['cus1_i'] = $requestData['answer' .   $subitem->id . '-1' ];
                $tmpAnsD['cus1_s'] = $ansList[$requestData['answer' .   $subitem->id . '-1']];
                $tmpAnsD['cus2_i'] = $requestData['answer' .   $subitem->id . '-2'];
                $tmpAnsD['cus2_s'] = $ansList[$requestData['answer' .   $subitem->id . '-2' ]];

                AnsD::create($tmpAnsD);
            }
        }



       return redirect('tests/confirm/'. $resultid)->with( 'flash_message', ' save!');
    }

    public function confirm($ansMId){
        $ansM = AnsM::findOrFail($ansMId);

        if ($ansM->status != "delivery") {

        if($ansM->quizM->questionType->name == 'test_triangle'){

            return view( 'tests.confirm', compact( 'ansM'));

        } elseif ( $ansM->quizM->questionType->name == 'test_like_summary') {

            $choiceArray = array();
            foreach ( $ansM->quizM->questionType->choiceList as $key => $value) {
                $choiceArray[$value->value] = $value->label;
            }

            return view('tests.confirm', compact( 'ansM', 'choiceArray'));
        } elseif ($ansM->quizM->questionType->name == 'test_like_details') {

            $choiceArray = array();
            foreach ($ansM->quizM->questionType->choiceList as $key => $value) {
                $choiceArray[$value->value] = $value->label;
            }

            return view('tests.confirm', compact('ansM', 'choiceArray'));
        } elseif ($ansM->quizM->questionType->name == 'test_like_details_02') {

            $choiceArray = array();
            foreach ($ansM->quizM->questionType->choiceList as $key => $value) {
                $choiceArray[$value->value] = $value->label;
            }

            return view('tests.confirm', compact('ansM', 'choiceArray'));
        } elseif ($ansM->quizM->questionType->name == 'test_like_details_ard') {

            $choiceArray = array();
            foreach ($ansM->quizM->questionType->choiceList as $key => $value) {
                $choiceArray[$value->value] = $value->label;
            }

            return view('tests.confirm', compact('ansM', 'choiceArray'));
        } elseif ($ansM->quizM->questionType->name == 'test_reference') {

            $choiceArray = array();
            foreach ($ansM->quizM->questionType->choiceList as $key => $value) {
                $choiceArray[$value->value] = $value->label;
            }

            return view('tests.confirm', compact('ansM', 'choiceArray'));
        } elseif ($ansM->quizM->questionType->name == 'test_like_details_v2') {

            $choiceArray = array();
            foreach ($ansM->quizM->questionType->choiceList as $key => $value) {
                $choiceArray[$value->value] = $value->label;
            }

            return view('tests.confirm', compact('ansM', 'choiceArray'));
        } elseif ($ansM->quizM->questionType->name == 'sale_customer_satisfaction_survey') {

            $choiceArray = array();
            foreach ($ansM->quizM->questionType->choiceList as $key => $value) {
                $choiceArray[$value->value] = $value->label;
            }

            return view('tests.confirm', compact('ansM', 'choiceArray'));            
        }else{

        }
        } else {
            return redirect('tests/delivery/' . $ansMId)->with('flash_message', ' save!');
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

        if($ansM->status != "delivery"){

        $quizM = $ansM->quizM;

        if($ansM->quizM->questionType->name == 'test_triangle'){
            return view('tests.edit', compact('quizM', 'ansM'));
        } elseif ( $ansM->quizM->questionType->name == 'test_like_summary') {
            return view('tests.edit', compact( 'quizM', 'ansM'));
        } elseif ($ansM->quizM->questionType->name == 'test_like_details') {
            return view('tests.edit', compact('quizM', 'ansM'));
        } elseif ($ansM->quizM->questionType->name == 'test_like_details_02') {
            return view('tests.edit', compact('quizM', 'ansM'));
        } elseif ($ansM->quizM->questionType->name == 'test_like_details_ard') {
            return view('tests.edit', compact('quizM', 'ansM'));
        } elseif ($ansM->quizM->questionType->name == 'test_reference') {
            return view('tests.edit', compact('quizM', 'ansM'));
        } elseif ($ansM->quizM->questionType->name == 'test_like_details_v2') {
            return view('tests.edit', compact('quizM', 'ansM'));
        } elseif ($ansM->quizM->questionType->name == 'sale_customer_satisfaction_survey') {
            return view('tests.edit', compact('quizM', 'ansM'));
        }

        }else{
            return redirect('tests/delivery/' . $ansMId)->with('flash_message', ' save!');
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
            $ansD->comments =  $requestData['comments'];
            $ansD->update();

            return redirect('tests/confirm/'. $id)-> with('flash_message', ' save!');

        } elseif ($ansM->quizM->questionType->name == 'test_like_summary') {
            
            $ansM->name = $requestData['name'];
            $ansM->update();

            foreach ( $ansM->ansD as $item) {
                
                $item->cus1_i = $requestData['result'. $item->id];
                $item->cus1_s = $item->quizD->name;
                $item->comments = $requestData['comment' . $item->id];
                $item->update();
            }

            return redirect('tests/confirm/'. $id)->with ('flash_message', ' save!');
        } elseif ($ansM->quizM->questionType->name == 'test_like_details') {

            $ansList = array(
                '' => '===เลือก==='
            );
            foreach ( $ansM->quizM->questionType->choiceList as $ansValue) {
                $ansList[$ansValue->value] = $ansValue->label;
            }
            
            $ansM->name = $requestData['name'];
            $ansM->update();

            foreach ($ansM->ansD as $item) {

                $loop = 1;

                foreach ($ansM->quizM->questionType->quizSubDetail as $item2){
                    $val = "cus".$loop."_i";
                    $name = "cus".$loop."_s";
                    $ref = "cus".$loop."_ref";
                    $item->$val = $requestData['answer'.   $item->id .'-'.  $item2->id];
                    $item->$name = $ansList[$requestData['answer'.   $item->id  .'-'.  $item2->id]];
                    $item->$ref =  $item2->id;
                    $loop++;
                }

                $item->comments = $requestData['comment'. $item->id];
                
                $item->update();
            }

            return redirect('tests/confirm/'.  $id)->with('flash_message', ' save!');
        } elseif ($ansM->quizM->questionType->name == 'test_like_details_02') {

            $ansList = array(
                '' => '===เลือก==='
            );
            foreach ($ansM->quizM->questionType->choiceList as $ansValue) {
                $ansList[$ansValue->value] = $ansValue->label;
            }

            $ansM->name = $requestData['name'];
            $ansM->update();

            foreach ($ansM->ansD as $item) {

                $loop = 1;

                foreach ($ansM->quizM->questionType->quizSubDetail as $item2) {
                    $val = "cus" . $loop . "_i";
                    $name = "cus" . $loop . "_s";
                    $ref = "cus" . $loop . "_ref";
                    $item->$val = $requestData['answer' .   $item->id . '-' .  $item2->id];
                    $item->$name = $ansList[$requestData['answer' .   $item->id  . '-' .  $item2->id]];
                    $item->$ref =  $item2->id;
                    $loop++;
                }

                $item->comments = $requestData['comment' . $item->id];

                $item->update();
            }

            return redirect('tests/confirm/' .  $id)->with('flash_message', ' save!');
        } elseif ($ansM->quizM->questionType->name == 'test_like_details_ard') {

            $ansList = array(
                '' => '===เลือก==='
            );
            foreach ($ansM->quizM->questionType->choiceList as $ansValue) {
                $ansList[$ansValue->value] = $ansValue->label;
            }

            $ansM->name = $requestData['name'];
            $ansM->update();

            foreach ($ansM->ansD as $item) {

                $loop = 1;

                foreach ($ansM->quizM->questionType->quizSubDetail as $item2) {
                    $val = "cus" . $loop . "_i";
                    $name = "cus" . $loop . "_s";
                    $ref = "cus" . $loop . "_ref";
                    $item->$val = $requestData['answer' .   $item->id . '-' .  $item2->id];
                    $item->$name = $ansList[$requestData['answer' .   $item->id  . '-' .  $item2->id]];
                    $item->$ref =  $item2->id;
                    $loop++;
                }

                $item->comments = $requestData['comment' . $item->id];

                $item->update();
            }

            return redirect('tests/confirm/' .  $id)->with('flash_message', ' save!');

        } elseif ($ansM->quizM->questionType->name == 'test_reference') {

            $ansM->name = $requestData['name'];
            $ansM->update();

            foreach ($ansM->ansD as $item) {

                $item->cus1_i = $requestData['result' . $item->id];
                $item->cus1_s = $item->quizD->name;
                $item->comments = $requestData['comment' . $item->id];
                $item->update();
            }

            return redirect('tests/confirm/' . $id)->with('flash_message', ' save!');
        } elseif ($ansM->quizM->questionType->name == 'test_like_details_v2') {

            $ansList = array(
                '' => '===เลือก==='
            );
            foreach ($ansM->quizM->questionType->choiceList as $ansValue) {
                $ansList[$ansValue->value] = $ansValue->label;
            }

            $ansM->name = $requestData['name'];
            $ansM->update();

            foreach ($ansM->ansD as $item) {

                $loop = 1;

                foreach ($ansM->quizM->questionType->quizSubDetail as $item2) {
                    $val = "cus" . $loop . "_i";
                    $name = "cus" . $loop . "_s";
                    $ref = "cus" . $loop . "_ref";
                    $item->$val = $requestData['answer' .   $item->id . '-' .  $item2->id];
                    $item->$name = $ansList[$requestData['answer' .   $item->id  . '-' .  $item2->id]];
                    $item->$ref =  $item2->id;
                    $loop++;
                }

                $item->comments = $requestData['comment' . $item->id];

                $item->update();
            }

            return redirect('tests/confirm/' .  $id)->with('flash_message', ' save!');
        } elseif ($ansM->quizM->questionType->name == 'sale_customer_satisfaction_survey') {

            $ansList = array(
                '' => '===เลือก==='
            );
            foreach ($ansM->quizM->questionType->choiceList as $ansValue) {
                $ansList[$ansValue->value] = $ansValue->label;
            }

            $ansM->name = $requestData['name'];
            $ansM->company = $requestData['company'];
            $ansM->test_date = $requestData['test_date'];
            $ansM->comment1 = $requestData['comment1'];
            $ansM->comment2 = $requestData['comment2'];
            $ansM->update();

            foreach ($ansM->ansD as $item) {

                $item->cus1_i = $requestData['answer' . $item->quiz_sub_detail_id."-1"];
                $item->cus2_i = $requestData['answer' . $item->quiz_sub_detail_id . "-2"];
                $item->cus1_s = $ansList[trim($requestData['answer' . $item->quiz_sub_detail_id . "-1"])];
                $item->cus2_s = $ansList[trim($requestData['answer' . $item->quiz_sub_detail_id . "-2"])];                

                $item->update();
            }

            return redirect('tests/confirm/' .  $id)->with('flash_message', ' save!');
        }
    }

    public function view($ansMId)
    {
        $ansM = AnsM::findOrFail($ansMId);

        if ($ansM->quizM->questionType->name == 'test_triangle') {

            return view( 'tests.view', compact('ansM'));
        } elseif ($ansM->quizM->questionType->name == 'test_like_summary') {

            $choiceArray = array();
            foreach ($ansM->quizM->questionType->choiceList as $key => $value) {
                $choiceArray[$value->value] = $value->label;
            }

            return view( 'tests.view', compact('ansM', 'choiceArray'));
        } elseif ($ansM->quizM->questionType->name == 'test_like_details') {

            $choiceArray = array();
            foreach ($ansM->quizM->questionType->choiceList as $key => $value) {
                $choiceArray[$value->value] = $value->label;
            }

            return view( 'tests.view', compact('ansM', 'choiceArray'));
        } elseif ($ansM->quizM->questionType->name == 'test_like_details_02') {

            $choiceArray = array();
            foreach ($ansM->quizM->questionType->choiceList as $key => $value) {
                $choiceArray[$value->value] = $value->label;
            }

            return view('tests.view', compact('ansM', 'choiceArray'));
        } elseif ($ansM->quizM->questionType->name == 'test_like_details_ard') {

            $choiceArray = array();
            foreach ($ansM->quizM->questionType->choiceList as $key => $value) {
                $choiceArray[$value->value] = $value->label;
            }

            return view('tests.view', compact('ansM', 'choiceArray'));
        } elseif ($ansM->quizM->questionType->name == 'test_reference') {

            $choiceArray = array();
            foreach ($ansM->quizM->questionType->choiceList as $key => $value) {
                $choiceArray[$value->value] = $value->label;
            }

            return view( 'tests.view', compact('ansM', 'choiceArray'));
        } elseif ($ansM->quizM->questionType->name == 'test_like_details_v2') {

            $choiceArray = array();
            foreach ($ansM->quizM->questionType->choiceList as $key => $value) {
                $choiceArray[$value->value] = $value->label;
            }

            return view('tests.view', compact('ansM', 'choiceArray'));
        } elseif ($ansM->quizM->questionType->name == 'sale_customer_satisfaction_survey') {

            $choiceArray = array();
            foreach ($ansM->quizM->questionType->choiceList as $key => $value) {
                $choiceArray[$value->value] = $value->label;
            }

            return view('tests.view', compact('ansM', 'choiceArray'));
        } else { }
    }

    public function delete($id){

        $ansM = AnsM::findOrFail($id);

        AnsD::where( 'ans_m_id', $id)->delete();

        AnsM::destroy($id);

        return redirect( 'results/details/'. $ansM->quizM->id)->with('flash_message', ' save!');
    }

}
