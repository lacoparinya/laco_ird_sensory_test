<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\QuizM;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class ResultsController extends Controller
{
    public function summary($quizMId){
        $quizM = QuizM::findOrFail($quizMId);

        if($quizM->questionType->name == 'test_triangle'){

            $data = DB::table( 'quiz_ds')
                ->leftJoin( 'ans_ms', 'ans_ms.quiz_id', '=', 'quiz_ds.quiz_m_id')
                ->leftJoin( 'ans_ds', function ($join) {
                    $join->on( 'ans_ds.ans_m_id', '=', 'ans_ms.id');
                    $join->on( 'ans_ds.quiz_d_id', '=', 'quiz_ds.id');
                })
                ->select(
                'quiz_ds.id',
                'quiz_ds.name',
                    DB::raw( 'COUNT(ans_ds.id) as sum_result')
                )->where([
                    [ 'ans_ms.quiz_id','=', $quizMId], 
                    [ 'ans_ms.status','=', 'delivery'],
                ])
                ->groupBy( 'quiz_ds.id', 'quiz_ds.name')
                ->get();

                   // var_dump( $data);
                    //exit();

            return view('reports.summary', compact( 'quizM','data'));
        } elseif ($quizM->questionType->name == 'test_like_summary') {
            $data = DB::table( 'quiz_ds')
                ->leftJoin( 'ans_ms', 'ans_ms.quiz_id', '=', 'quiz_ds.quiz_m_id')
                ->leftJoin('ans_ds', function ($join) {
                    $join->on( 'ans_ds.quiz_d_id', '=', 'quiz_ds.id');
                    $join->on( 'ans_ds.ans_m_id', '=', 'ans_ms.id');
                })
                ->select(
                    'quiz_ds.id',
                     'quiz_ds.name',
                    DB::raw('sum(ans_ds.cus1_i) as sum_result')
                )->where([
                    [ 'quiz_ds.quiz_m_id','=', $quizMId],
                    ['ans_ms.status','=', 'delivery'],
                ] )
                ->groupBy('quiz_ds.id', 'quiz_ds.name')
                ->get();

            return view('reports.summary', compact('quizM','data'));
        } elseif ($quizM->questionType->name == 'test_like_details') {
            $data = DB::table('quiz_ds')
                ->leftJoin('ans_ms', 'ans_ms.quiz_id', '=', 'quiz_ds.quiz_m_id')
                ->leftJoin('ans_ds', function ($join) {
                    $join->on('ans_ds.quiz_d_id', '=', 'quiz_ds.id');
                    $join->on('ans_ds.ans_m_id', '=', 'ans_ms.id');
                })
                ->select(
                    'quiz_ds.id',
                    'quiz_ds.name',
                    DB::raw('sum(ans_ds.cus1_i) as sum_result1'),
                    DB::raw('sum(ans_ds.cus2_i) as sum_result2'),
                    DB::raw('sum(ans_ds.cus3_i) as sum_result3'),
                    DB::raw('sum(ans_ds.cus4_i) as sum_result4'),
                    DB::raw('sum(ans_ds.cus5_i) as sum_result5'),
                    DB::raw('sum(ans_ds.cus6_i) as sum_result6'),
                    DB::raw('sum(ISNULL(ans_ds.cus1_i,0)) + sum(ISNULL(ans_ds.cus2_i,0)) + sum(ISNULL(ans_ds.cus3_i,0))+ sum(ISNULL(ans_ds.cus4_i,0))+ sum(ISNULL(ans_ds.cus5_i,0)) + sum(ISNULL(ans_ds.cus6_i,0)) as sum_resultall')
                )->where([
                    ['quiz_ds.quiz_m_id', '=', $quizMId],
                    ['ans_ms.status','=', 'delivery'],
                ])
                ->groupBy('quiz_ds.id', 'quiz_ds.name')
                ->get();

            return view('reports.summary', compact('quizM','data'));
        } elseif ($quizM->questionType->name == 'test_like_details_02') {
            $data = DB::table('quiz_ds')
                ->leftJoin('ans_ms', 'ans_ms.quiz_id', '=', 'quiz_ds.quiz_m_id')
                ->leftJoin('ans_ds', function ($join) {
                    $join->on('ans_ds.quiz_d_id', '=', 'quiz_ds.id');
                    $join->on('ans_ds.ans_m_id', '=', 'ans_ms.id');
                })
                ->select(
                    'quiz_ds.id',
                    'quiz_ds.name',
                    DB::raw('sum(ans_ds.cus1_i) as sum_result1'),
                    DB::raw('sum(ans_ds.cus2_i) as sum_result2'),
                    DB::raw('sum(ans_ds.cus3_i) as sum_result3'),
                    DB::raw('sum(ans_ds.cus4_i) as sum_result4'),
                    DB::raw('sum(ans_ds.cus5_i) as sum_result5'),
                    DB::raw('sum(ans_ds.cus6_i) as sum_result6'),
                    DB::raw('sum(ans_ds.cus7_i) as sum_result7'),
                    DB::raw('sum(ISNULL(ans_ds.cus1_i,0)) + sum(ISNULL(ans_ds.cus2_i,0)) + sum(ISNULL(ans_ds.cus3_i,0))+ sum(ISNULL(ans_ds.cus4_i,0))+ sum(ISNULL(ans_ds.cus5_i,0)) + sum(ISNULL(ans_ds.cus6_i,0))  + sum(ISNULL(ans_ds.cus7_i,0)) as sum_resultall')
                )->where([
                    ['quiz_ds.quiz_m_id', '=', $quizMId],
                    ['ans_ms.status', '=', 'delivery'],
                ])
                ->groupBy('quiz_ds.id', 'quiz_ds.name')
                ->get();

            return view('reports.summary', compact('quizM', 'data'));
        } elseif ($quizM->questionType->name == 'test_like_details_ard') {
            $data = DB::table('quiz_ds')
                ->leftJoin('ans_ms', 'ans_ms.quiz_id', '=', 'quiz_ds.quiz_m_id')
                ->leftJoin('ans_ds', function ($join) {
                    $join->on('ans_ds.quiz_d_id', '=', 'quiz_ds.id');
                    $join->on('ans_ds.ans_m_id', '=', 'ans_ms.id');
                })
                ->select(
                    'quiz_ds.id',
                    'quiz_ds.name',
                    DB::raw('sum(ans_ds.cus1_i) as sum_result1'),
                    DB::raw('sum(ans_ds.cus2_i) as sum_result2'),
                    DB::raw('sum(ans_ds.cus3_i) as sum_result3'),
                    DB::raw('sum(ans_ds.cus4_i) as sum_result4'),
                    DB::raw('sum(ans_ds.cus5_i) as sum_result5'),
                    DB::raw('sum(ans_ds.cus6_i) as sum_result6'),
                    DB::raw('sum(ISNULL(ans_ds.cus1_i,0)) + sum(ISNULL(ans_ds.cus2_i,0)) + sum(ISNULL(ans_ds.cus3_i,0))+ sum(ISNULL(ans_ds.cus4_i,0))+ sum(ISNULL(ans_ds.cus5_i,0)) + sum(ISNULL(ans_ds.cus6_i,0)) as sum_resultall')
                )->where([
                    ['quiz_ds.quiz_m_id', '=', $quizMId],
                    ['ans_ms.status', '=', 'delivery'],
                ])
                ->groupBy('quiz_ds.id', 'quiz_ds.name')
                ->get();

            return view('reports.summary', compact('quizM', 'data'));
        
        } elseif ($quizM->questionType->name == 'test_reference') {
            $dataRM = DB::table('quiz_ds')
                ->leftJoin('ans_ms', 'ans_ms.quiz_id', '=', 'quiz_ds.quiz_m_id')
                ->leftJoin('ans_ds', function ($join) {
                    $join->on('ans_ds.quiz_d_id', '=', 'quiz_ds.id');
                    $join->on('ans_ds.ans_m_id', '=', 'ans_ms.id');
                })
                ->select(
                    'quiz_ds.id',
                    'quiz_ds.name',
                'ans_ds.cus1_i',
                'quiz_ds.desc as quizname',
                    DB::raw('count(ans_ds.id) as sum_result')
                )->where([
                    ['quiz_ds.quiz_m_id', '=', $quizMId],
                    ['ans_ms.status', '=', 'delivery'],
                ])
                ->groupBy('quiz_ds.id', 'quiz_ds.name', 'ans_ds.cus1_i', 'quiz_ds.desc')
                ->get();

                $data = array();
                foreach ($dataRM as $obj) {
                    $data[$obj->id][$obj->cus1_i] = $obj;
                }

            return view('reports.summary', compact('quizM', 'data'));
        } elseif ($quizM->questionType->name == 'test_like_details_v2') {
            $data = DB::table('quiz_ds')
                ->leftJoin('ans_ms', 'ans_ms.quiz_id', '=', 'quiz_ds.quiz_m_id')
                ->leftJoin('ans_ds', function ($join) {
                    $join->on('ans_ds.quiz_d_id', '=', 'quiz_ds.id');
                    $join->on('ans_ds.ans_m_id', '=', 'ans_ms.id');
                })
                ->select(
                    'quiz_ds.id',
                    'quiz_ds.name',
                    DB::raw('sum(ans_ds.cus1_i) as sum_result1'),
                    DB::raw('sum(ans_ds.cus2_i) as sum_result2'),
                    DB::raw('sum(ans_ds.cus3_i) as sum_result3'),
                    DB::raw('sum(ans_ds.cus4_i) as sum_result4'),
                    DB::raw('sum(ans_ds.cus5_i) as sum_result5'),
                    DB::raw('sum(ans_ds.cus6_i) as sum_result6'),
                    DB::raw('sum(ISNULL(ans_ds.cus1_i,0)) + sum(ISNULL(ans_ds.cus2_i,0)) + sum(ISNULL(ans_ds.cus3_i,0))+ sum(ISNULL(ans_ds.cus4_i,0))+ sum(ISNULL(ans_ds.cus5_i,0)) + sum(ISNULL(ans_ds.cus6_i,0)) as sum_resultall')
                )->where([
                    ['quiz_ds.quiz_m_id', '=', $quizMId],
                    ['ans_ms.status', '=', 'delivery'],
                ])
                ->groupBy('quiz_ds.id', 'quiz_ds.name')
                ->get();

            return view('reports.summary', compact('quizM', 'data'));
        } elseif ($quizM->questionType->name == 'sale_customer_satisfaction_survey') {
            $dataRw = DB::table('ans_ms')
                
                ->leftJoin('ans_ds', 'ans_ds.ans_m_id', '=', 'ans_ms.id')
                ->leftJoin('quiz_sub_details', 'ans_ds.quiz_sub_detail_id', '=', 'quiz_sub_details.id')
                ->select(
                    'ans_ms.id',
                    'ans_ms.name',
                    'ans_ms.company',
                'quiz_sub_details.label',
                    DB::raw('sum(ans_ds.cus1_i) as sum_laco_perform'),
                    DB::raw('sum(ans_ds.cus2_i) as sum_laco_compare'),
                    DB::raw('sum(5) as max_laco_perform'),
                    DB::raw('sum(5) as max_laco_compare')
                )->where([
                    ['ans_ms.quiz_id', '=', $quizMId],
                    ['ans_ms.status', '=', 'delivery'],
                ])
                ->groupBy(
                'ans_ms.id',
                'ans_ms.name',
                'ans_ms.company',
                'quiz_sub_details.label')
                ->get();
            $data = array();
            foreach ($dataRw as $datObj) {
                $data[$datObj->id][$datObj->label] = $datObj;                
                if($datObj->label == '1. Sales' || $datObj->label == '2. CUSTOMER SERVICE'){
                    if (isset($data[$datObj->id]['PART1'])) {
                        $data[$datObj->id]['PART1']['data1'] += $datObj->sum_laco_perform;
                        $data[$datObj->id]['PART1']['sum1'] += $datObj->max_laco_perform;
                        $data[$datObj->id]['PART1']['data2'] += $datObj->sum_laco_compare;
                        $data[$datObj->id]['PART1']['sum2'] += $datObj->max_laco_compare;
                    }else{
                        $data[$datObj->id]['PART1']['data1'] = $datObj->sum_laco_perform;
                        $data[$datObj->id]['PART1']['sum1'] = $datObj->max_laco_perform;
                        $data[$datObj->id]['PART1']['data2'] = $datObj->sum_laco_compare;
                        $data[$datObj->id]['PART1']['sum2'] = $datObj->max_laco_compare;
                        $data[$datObj->id]['PART1']['name'] = $datObj->name;
                    }
                }else{
                    if (isset($data[$datObj->id]['PART2'])) {
                        $data[$datObj->id]['PART2']['data1'] += $datObj->sum_laco_perform;
                        $data[$datObj->id]['PART2']['sum1'] += $datObj->max_laco_perform;
                        $data[$datObj->id]['PART2']['data2'] += $datObj->sum_laco_compare;
                        $data[$datObj->id]['PART2']['sum2'] += $datObj->max_laco_compare;
                    } else {
                        $data[$datObj->id]['PART2']['data1'] = $datObj->sum_laco_perform;
                        $data[$datObj->id]['PART2']['sum1'] = $datObj->max_laco_perform;
                        $data[$datObj->id]['PART2']['data2'] = $datObj->sum_laco_compare;
                        $data[$datObj->id]['PART2']['sum2'] = $datObj->max_laco_compare;
                        $data[$datObj->id]['PART2']['name'] = $datObj->name;
                    }
                }
                
            }

            return view('reports.summary', compact('quizM', 'data'));
        }
    }

    public function detailsExcel( $quizMId){
        $quizM = QuizM::findOrFail($quizMId);
        if($quizM->questionType->name == 'test_triangle'){
            $filename = "triangle_report_". $quizMId.date('ymdHi' ) ;

            Excel::create($filename, function ($excel) use ( $quizM) {
                $excel->sheet('clients', function ($sheet) use ( $quizM) {
                    $sheet->loadView( 'reports.excels_'. $quizM->questionType->name)->with( 'quizM', $quizM);
                });
            })->export('xlsx');
        } elseif ($quizM->questionType->name == 'test_like_summary') {
            $filename = "like_summary_report_" . $quizMId . date('ymdHi');

            Excel::create($filename, function ($excel) use ($quizM) {
                $excel->sheet('clients', function ($sheet) use ($quizM) {
                    $sheet->loadView('reports.excels_' . $quizM->questionType->name)->with('quizM', $quizM);
                });
            })->export('xlsx');
        } elseif ($quizM->questionType->name == 'test_like_details') {
            $filename = "like_details_report_" . $quizMId . date('ymdHi');

            Excel::create($filename, function ($excel) use ($quizM) {
                $excel->sheet('clients', function ($sheet) use ($quizM) {
                    $sheet->loadView('reports.excels_' . $quizM->questionType->name)->with('quizM', $quizM);
                });
            })->export('xlsx');
        } elseif ($quizM->questionType->name == 'test_like_details_02') {
            $filename = "like_details_report_" . $quizMId . date('ymdHi');

            Excel::create($filename, function ($excel) use ($quizM) {
                $excel->sheet('clients', function ($sheet) use ($quizM) {
                    $sheet->loadView('reports.excels_' . $quizM->questionType->name)->with('quizM', $quizM);
                });
            })->export('xlsx');
        } elseif ($quizM->questionType->name == 'test_like_details_ard') {
            $filename = "like_details_ard_report_" . $quizMId . date('ymdHi');

            Excel::create($filename, function ($excel) use ($quizM) {
                $excel->sheet('clients', function ($sheet) use ($quizM) {
                    $sheet->loadView('reports.excels_' . $quizM->questionType->name)->with('quizM', $quizM);
                });
            })->export('xlsx');
        } elseif ($quizM->questionType->name == 'test_reference') {
            $filename = "reference_report_" . $quizMId . date('ymdHi');

            Excel::create($filename, function ($excel) use ($quizM) {
                $excel->sheet('clients', function ($sheet) use ($quizM) {
                    $sheet->loadView('reports.excels_' . $quizM->questionType->name)->with('quizM', $quizM);
                });
            })->export('xlsx');
        } elseif ($quizM->questionType->name == 'test_like_details_v2') {
            $filename = "like_details_v2_report_" . $quizMId . date('ymdHi');

            Excel::create($filename, function ($excel) use ($quizM) {
                $excel->sheet('clients', function ($sheet) use ($quizM) {
                    $sheet->loadView('reports.excels_' . $quizM->questionType->name)->with('quizM', $quizM);
                });
            })->export('xlsx');
        }

    }

    public function details($id){
        $quizM = QuizM::findOrFail($id);
        return view('reports.details', compact('quizM'));
    }

    public function editcomment($id){
        $quizM = QuizM::findOrFail($id);
        return view('quizs.editcomment', compact('quizM'));
    }

    public function editcommentAction($id, Request $request)
    {
        $requestData = $request->all();
        $quizM = QuizM::findOrFail($id);
        $quizM->result_comment = $requestData['sale_comment'];
        $quizM->update();

        return redirect('results/details/' . $id)->with('flash_message', ' save!');
    }

    public function summarydata($id)
    {
        $quizM = QuizM::findOrFail($id);

        $data = DB::table('ans_ms')
            ->leftJoin('ans_ds', 'ans_ms.id', '=', 'ans_ds.ans_m_id')
            ->leftJoin('quiz_sub_details', 'quiz_sub_details.id', '=', 'ans_ds.quiz_sub_detail_id')
            ->select(
'ans_ms.id',
'ans_ms.company',
'ans_ms.company_type',
'ans_ms.product_type',
DB::raw('sum(ans_ds.cus1_i) as sumpart1'),
DB::raw('sum(ans_ds.cus2_i) as sumpart2'),
DB::raw('sum(5) as sumall'),
DB::raw('sum(ans_ds.cus1_i)*50/sum(5) as sumperpart1'),
DB::raw('sum(ans_ds.cus2_i)*50/sum(5) as sumperpart2'),
DB::raw('sum(ans_ds.cus1_i)*50/sum(5) + sum(ans_ds.cus2_i)*50/sum(5) as sumper'),
DB::raw("CASE
    WHEN (sum(ans_ds.cus1_i)*50/sum(5) + sum(ans_ds.cus2_i)*50/sum(5)) >= 80 THEN 'A'
    WHEN (sum(ans_ds.cus1_i)*50/sum(5) + sum(ans_ds.cus2_i)*50/sum(5)) < 59 THEN 'C'
    ELSE 'B'
END as resulttxt")
            )->where([
                ['ans_ms.quiz_id', '=', $id],
                ['ans_ms.status', '=', 'inuse'],
            ])
            ->groupBy('ans_ms.id',
            'ans_ms.company',
            'ans_ms.company_type',
            'ans_ms.product_type'
            )
            ->get();


        return view('reports.summarydata', compact('quizM', 'data'));
    }
}
