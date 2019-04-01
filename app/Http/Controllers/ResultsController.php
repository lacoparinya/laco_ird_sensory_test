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
                    DB::raw('sum(ans_ds.cus1_i) as sum_result')
                )->where([
                    ['quiz_ds.quiz_m_id',' =', $quizMId],
                    ['ans_ms.status',' =', 'delivery'],
                ])
                ->groupBy('quiz_ds.id', 'quiz_ds.name')
                ->get();

            return view('reports.summary', compact('quizM',' data'));
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
            $filename = "triangle_report_" . $quizMId . date('ymdHi');

            Excel::create($filename, function ($excel) use ($quizM) {
                $excel->sheet('clients', function ($sheet) use ($quizM) {
                    $sheet->loadView('reports.excels_' . $quizM->questionType->name)->with('quizM', $quizM);
                });
            })->export('xlsx');
        }

    }
}
