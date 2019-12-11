<?php

namespace App\Http\Controllers;

use App\QuizM;
use App\QuizD;
use App\QuestionType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuizsController extends Controller
{
    public $statusList = array(
        'active' => 'Active',
        'inactive' => 'Inactive'
    );

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request){
        $keyword = $request->get('search');
        $perPage = 10;
        $status = $request->get('status');;

        if (empty($status)) {
            $status = 'running';
        }

        if (!empty($keyword)) {
            $quizs = QuizM::where('status',$status)->where('name', 'like', '%' . $keyword . '%')->latest()->paginate($perPage);
        } else {
            $quizs = QuizM::where('status', $status)->latest()->paginate($perPage);
        }

        return view('quizs.index', compact( 'quizs','status'));
    }

    public function create($questionType)
    {
        $questionTypeObj = QuestionType::findOrFail( $questionType);
        $statuslist = $this->statusList;
        $status = '';
        return view( 'quizs.create',compact( 'questionTypeObj', 'statuslist', 'status'));
    }

    public function store($questionType, Request $request){

        $requestData = $request->all();

        $user = $request->user();


        if($questionType == 'test_triangle'){
            $tmpMaster = array();
            $tmpMaster['question_type_id'] = $requestData['question_type_id'];
            $tmpMaster['name'] = $requestData['name'];
            $tmpMaster['desc'] = $requestData['desc'];
            $tmpMaster['test_date'] = $requestData['test_date'];
            $tmpMaster['time_no'] = $requestData['time_no'];
            $tmpMaster['status'] = $requestData['status'];
            $tmpMaster['created_by'] = $user->id;
            $tmpMaster[ 'modified_by'] = $user->id;


            $quizid = QuizM::create($tmpMaster)->id;

            for ($i=1; $i <= 3; $i++) {
                $tmpDetail = array();

                $tmpDetail['quiz_m_id'] = $quizid;
                $tmpDetail['name'] = $requestData[ 'choice'.$i];
                $tmpDetail['desc'] = $requestData[ 'choicedesc'.$i];
                $tmpDetail['seq'] = $i;
                $tmpDetail['status'] = $requestData['status'];
                $tmpDetail['created_by'] = $user->id;
                $tmpDetail[ 'modified_by'] = $user->id;

                QuizD::create($tmpDetail);
            }
            
            return redirect('quizs/list')->with('flash_message', ' added!');

        }elseif( $questionType == 'test_like_summary'){
            $tmpMaster = array();
            $tmpMaster['question_type_id'] = $requestData['question_type_id'];
            $tmpMaster['name'] = $requestData['name'];
            $tmpMaster['desc'] = $requestData['desc'];
            $tmpMaster['test_date'] = $requestData['test_date'];
            $tmpMaster['time_no'] = $requestData['time_no'];
            $tmpMaster['status'] = $requestData['status'];
            $tmpMaster['created_by'] = $user->id;
            $tmpMaster['modified_by'] = $user->id;


            $quizid = QuizM::create($tmpMaster)->id;

            for ($i=1; $i <= 6;  $i++) {
                if(!empty( $requestData['choice' . $i])){
                    $tmpDetail = array();

                    $tmpDetail['quiz_m_id'] = $quizid;
                    $tmpDetail['name'] = $requestData['choice'.$i];
                    $tmpDetail['desc'] = $requestData[ 'choicedesc'.$i];
                    $tmpDetail['seq'] = $i;
                    $tmpDetail['status'] = $requestData['status'];
                    $tmpDetail['created_by'] = $user->id;
                    $tmpDetail['modified_by'] = $user->id;

                    QuizD::create($tmpDetail);
                }
            }

            return redirect('quizs/list')->with('flash_message', ' added!');
        } elseif ($questionType == 'test_like_details') {
            $tmpMaster = array();
            $tmpMaster['question_type_id'] = $requestData['question_type_id'];
            $tmpMaster['name'] = $requestData['name'];
            $tmpMaster['desc'] = $requestData['desc'];
            $tmpMaster['test_date'] = $requestData['test_date'];
            $tmpMaster['time_no'] = $requestData['time_no'];
            $tmpMaster['status'] = $requestData['status'];
            $tmpMaster['created_by'] = $user->id;
            $tmpMaster['modified_by'] = $user->id;


            $quizid = QuizM::create($tmpMaster)->id;

            for ($i = 1; $i <= 6; $i++) {
                if (!empty($requestData['choice' . $i])) {
                    $tmpDetail = array();

                    $tmpDetail['quiz_m_id'] = $quizid;
                    $tmpDetail['name'] = $requestData['choice' . $i];
                    $tmpDetail['desc'] = $requestData[ 'choicedesc'.$i];
                    $tmpDetail['seq'] = $i;
                    $tmpDetail['status'] = $requestData['status'];
                    $tmpDetail['created_by'] = $user->id;
                    $tmpDetail['modified_by'] = $user->id;

                    QuizD::create($tmpDetail);
                }
            }

            return redirect('quizs/list')->with('flash_message', ' added!');
        } elseif ($questionType == 'test_like_details_02') {
            $tmpMaster = array();
            $tmpMaster['question_type_id'] = $requestData['question_type_id'];
            $tmpMaster['name'] = $requestData['name'];
            $tmpMaster['desc'] = $requestData['desc'];
            $tmpMaster['test_date'] = $requestData['test_date'];
            $tmpMaster['time_no'] = $requestData['time_no'];
            $tmpMaster['status'] = $requestData['status'];
            $tmpMaster['created_by'] = $user->id;
            $tmpMaster['modified_by'] = $user->id;


            $quizid = QuizM::create($tmpMaster)->id;

            for ($i = 1; $i <= 6; $i++) {
                if (!empty($requestData['choice' . $i])) {
                    $tmpDetail = array();

                    $tmpDetail['quiz_m_id'] = $quizid;
                    $tmpDetail['name'] = $requestData['choice' . $i];
                    $tmpDetail['desc'] = $requestData['choicedesc' . $i];
                    $tmpDetail['seq'] = $i;
                    $tmpDetail['status'] = $requestData['status'];
                    $tmpDetail['created_by'] = $user->id;
                    $tmpDetail['modified_by'] = $user->id;

                    QuizD::create($tmpDetail);
                }
            }

            return redirect('quizs/list')->with('flash_message', ' added!');

        }elseif($questionType == 'test_reference'){
            $tmpMaster = array();
            $tmpMaster['question_type_id'] = $requestData['question_type_id'];
            $tmpMaster['name'] = $requestData['name'];
            $tmpMaster['desc'] = $requestData['desc'];
            $tmpMaster['test_date'] = $requestData['test_date'];
            $tmpMaster['time_no'] = $requestData['time_no'];
            $tmpMaster['status'] = $requestData['status'];
            $tmpMaster['created_by'] = $user->id;
            $tmpMaster['modified_by'] = $user->id;


            $quizid = QuizM::create($tmpMaster)->id;

            for ($i = 1; $i <= 6; $i ++) {
                if (!empty($requestData['choice' . $i])) {
                    $tmpDetail = array();

                    $tmpDetail['quiz_m_id'] = $quizid;
                    $tmpDetail['name'] = $requestData['choice' . $i];
                    $tmpDetail['desc'] = $requestData['choicedesc' . $i];
                    $tmpDetail['seq'] = $i;
                    $tmpDetail['status'] = $requestData['status'];
                    $tmpDetail['created_by'] = $user->id;
                    $tmpDetail['modified_by'] = $user->id;

                    QuizD::create($tmpDetail);
                }
            }

            return redirect('quizs/list')->with('flash_message', ' added!');
        } elseif ($questionType == 'test_like_details_ard') {
            $tmpMaster = array();
            $tmpMaster['question_type_id'] = $requestData['question_type_id'];
            $tmpMaster['name'] = $requestData['name'];
            $tmpMaster['desc'] = $requestData['desc'];
            $tmpMaster['test_date'] = $requestData['test_date'];
            $tmpMaster['time_no'] = $requestData['time_no'];
            $tmpMaster['status'] = $requestData['status'];
            $tmpMaster['created_by'] = $user->id;
            $tmpMaster['modified_by'] = $user->id;


            $quizid = QuizM::create($tmpMaster)->id;

            for ($i = 1; $i <= 6; $i++) {
                if (!empty($requestData['choice' . $i])) {
                    $tmpDetail = array();

                    $tmpDetail['quiz_m_id'] = $quizid;
                    $tmpDetail['name'] = $requestData['choice' . $i];
                    $tmpDetail['desc'] = $requestData['choicedesc' . $i];
                    $tmpDetail['seq'] = $i;
                    $tmpDetail['status'] = $requestData['status'];
                    $tmpDetail['created_by'] = $user->id;
                    $tmpDetail['modified_by'] = $user->id;

                    QuizD::create($tmpDetail);
                }
            }

            return redirect('quizs/list')->with('flash_message', ' added!');
        }else{

        }
    }

    public function view($id){
        $quizM = QuizM::findOrFail($id);

        return view( 'quizs.show', compact( 'quizM'));
    }

    public function edit($id){
    
        $quizM = QuizM::findOrFail($id);

        return view('quizs.edit', compact('quizM'));
    }

    public function update($id, Request $request){
        $requestData = $request->all();

        $user = $request->user();

        $quizM = QuizM::findOrFail($id);

        $quizM->modified_by = $user->id;

        if($quizM->questionType->name == 'test_triangle'){

            $quizM->update($requestData);

            for ($i=1; $i <= 3; $i++) { 
                $tmpid = $requestData['choiceid'.$i];
                $quizD = QuizD::findOrFail( $tmpid);
                $quizD->name = $requestData['choice'.$i];
                $quizD->desc = $requestData[ 'choicedesc'.$i];
                $quizD->modified_by = $user->id;
                $quizD->update();
            }
        } elseif ($quizM->questionType->name == 'test_like_summary') {
            $quizM->update($requestData);
            $loop=1;
            for ($i=1; $i <= 6;  $i++) {
                $tmpid = $requestData['choiceid'.$i];
                $dname = $requestData['choice' . $i];
                if(!empty( $dname)){
                    if(!empty( $tmpid)){
                        $quizD = QuizD::findOrFail($tmpid);
                        $quizD->name = $requestData['choice' . $i];
                        $quizD->desc = $requestData[ 'choicedesc'.$i];
                        $quizD->seq = $loop;
                        $quizD->modified_by = $user->id;
                        $quizD->update();
                    }else{
                        $tmpQuizD = array();
                        $tmpQuizD['quiz_m_id'] = $id;
                        $tmpQuizD['name'] =$requestData['choice' . $i];
                        $tmpQuizD['desc'] =$requestData[ 'choicedesc '.$i];
                        $tmpQuizD['seq'] = $loop;
                        $tmpQuizD['status'] = $requestData['status'];
                        $tmpQuizD['created_by'] = $user->id;
                        $tmpQuizD['modified_by'] = $user->id;
                        QuizD::create($tmpQuizD);
                    }
                    $loop++;
                }else{
                    if(!empty( $tmpid)){
                        QuizD::destroy($tmpid);
                    }
                }
            }
        } elseif ($quizM->questionType->name == 'test_like_details') {
            $quizM->update($requestData);
            $loop= 1 ;
            for ($i= 1 ; $i <= 6; $i++) {
                $tmpid = $requestData['choiceid'. $i];
                $dname = $requestData['choice' . $i];
                if( !empty($dname)){ 
                    if( !empty($tmpid)){ 
                        $quizD = QuizD::findOrFail($tmpid);
                        $quizD->name = $requestData['choice' . $i];
                        $quizD->desc = $requestData[ 'choicedesc'.$i];
                        $quizD->seq = $loop;
                        $quizD->modified_by = $user->id;
                        $quizD->update();
                    }else{ 
                        $tmpQuizD = array();
                        $tmpQuizD['quiz_m_id'] = $id;
                        $tmpQuizD['name'] =$requestData['choice' . $i];
                        $tmpQuizD['desc'] =$requestData[ 'choicedesc '.$i];
                        $tmpQuizD['seq'] = $loop;
                        $tmpQuizD['status'] = $requestData['status'];
                        $tmpQuizD['created_by'] = $user->id;
                        $tmpQuizD['modified_by'] = $user->id;
                        QuizD::create($tmpQuizD);
                    }
                    $loop++;
                }else{ 
                    if( !empty($tmpid)){ 
                        QuizD::destroy($tmpid);
                    }
                }
            }
        } elseif ($quizM->questionType->name == 'test_reference') {
            $quizM->update($requestData);
            $loop = 1;
            for ($i = 1; $i <= 6; $i++) {
                $tmpid = $requestData['choiceid' . $i];
                $dname = $requestData['choice' . $i];
                if (!empty($dname)) {
                    if (!empty($tmpid)) {
                        $quizD = QuizD::findOrFail($tmpid);
                        $quizD->name = $requestData['choice' . $i];
                        $quizD->desc = $requestData['choicedesc' . $i];
                        $quizD->seq = $loop;
                        $quizD->modified_by = $user->id;
                        $quizD->update();
                    } else {
                        $tmpQuizD = array();
                        $tmpQuizD['quiz_m_id'] = $id;
                        $tmpQuizD['name'] = $requestData['choice' . $i];
                        $tmpQuizD['desc'] = $requestData['choicedesc' . $i];
                        $tmpQuizD['seq'] = $loop;
                        $tmpQuizD['status'] = $requestData['status'];
                        $tmpQuizD['created_by'] = $user->id;
                        $tmpQuizD['modified_by'] = $user->id;
                        QuizD::create($tmpQuizD);
                    }
                    $loop++;
                } else {
                    if (!empty($tmpid)) {
                        QuizD::destroy($tmpid);
                    }
                }
            }

        }else{

        }

        return redirect('quizs/list')->with('flash_message', ' updated!');
    }

    public function changestatus($id,$status){

        $user = Auth::user();

        $quizM = QuizM::findOrFail($id);

        $quizM->status = $status;
        $quizM->modified_by = $user->id;
        $quizM->update();
        return redirect('quizs/list')->with('flash_message', ' updated!');
    }

    public function qrcode($id){

        $quizM = QuizM::findOrFail($id);

        return view('quizs.qrcode', compact('quizM'));
    }
}
