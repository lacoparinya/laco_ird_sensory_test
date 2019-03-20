<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\QuestionType;
use Illuminate\Http\Request;

class QuestionTypesController extends Controller
{

    public $statusList = array(
        'active' => 'Active',
        'inactive' => 'Inactive'
    );

    public function __construct()
    {
        $this->middleware('admin');

        
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $questiontypes = QuestionType::latest()->paginate($perPage);
        } else {
            $questiontypes = QuestionType::latest()->paginate($perPage);
        }

        return view( 'question-types.index', compact( 'questiontypes'));
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
        return view( 'question-types.create',compact( 'statuslist', 'status'));
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
        
        QuestionType::create($requestData);

        return redirect( 'question-types')->with('flash_message', ' added!');
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
        $questiontype = QuestionType::findOrFail($id);

        return view( 'question-types.show', compact( 'questiontype'));
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
        $statuslist = $this->statusList;
        $questiontype = QuestionType::findOrFail($id);
        $status = $questiontype->status;
        return view( 'question-types.edit', compact( 'questiontype', 'statuslist', 'status'));
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

        $user = $request->user();

        $requestData['modified_by'] = $user->id;
        
        $questiontype = QuestionType::findOrFail($id);
        $questiontype->update($requestData);

        return redirect( 'question-types')->with('flash_message', ' updated!');
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
        QuestionType::destroy($id);

        return redirect( 'question-types')->with('flash_message', ' deleted!');
    }
}
