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
}
