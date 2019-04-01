<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\QuestionType;
use App\QuizSubDetail;
use Illuminate\Http\Request;

class QuizSubDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public $statusList = array(
        'active' => 'Active',
        'inactive' => 'Inactive'
    );


    public function __construct()
    {
        $this->middleware('admin');

        
    }   


    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $quizsubdetails = QuizSubDetail::latest()->paginate($perPage);
        } else {
            $quizsubdetails = QuizSubDetail::latest()->paginate($perPage);
        }

        return view( 'quiz-sub-details.index', compact( 'quizsubdetails'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $statuslist = $this->statusList;
        $status = '';
        $questionTypelist = QuestionType::pluck('name', 'id');
        return view( 'quiz-sub-details.create',compact( 'statuslist', 'status', 'questionTypelist'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        
        $requestData = $request->all();

        $user = $request->user();

        $requestData['created_by'] = $user->id;
        $requestData['modified_by'] = $user->id;


        QuizSubDetail::create($requestData);

        return redirect( 'quiz-sub-details')->with('flash_message', ' added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $quizsubdetail = QuizSubDetail::findOrFail($id);

        return view( 'quiz-sub-details.show', compact( 'quizsubdetail'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $quizsubdetail = QuizSubDetail::findOrFail($id);

        return view( 'quiz-sub-details.edit', compact( 'quizsubdetail'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        
        $requestData = $request->all();
        
        $quizsubdetail = QuizSubDetail::findOrFail($id);
        $quizsubdetail->update($requestData);

        return redirect( 'quiz-sub-details')->with('flash_message', ' updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        QuizSubDetail::destroy($id);

        return redirect( 'quiz-sub-details')->with('flash_message', ' deleted!');
    }
}
