<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Feedbacks\CreateRequest;
use App\Http\Requests\Feedbacks\UpdateRequest;
use App\Models\Feedback;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $feedbacks = Feedback::paginate(5);
        return view('admin.feedbacks.index', [
            'feedbackList' => $feedbacks,
            'fields' =>Feedback::getAllFields('feedbacks')
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $feedback = Feedback::$columnsToGet;
        return view('admin.feedbacks.create', [
            'feedbackFields' => $feedback,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRequest $request)
    {
        $data = $request->only('nickName', 'message');
        $created = Feedback::create($data);
        if($created){

            return redirect()->route('admin.feedbacks')->with('success', __('messages.admin.feedbacks.created.success'));
        }
        return back()->with('error', __('messages.admin.feedbacks.created.error'))->withInput();
    }

    /**
     * Display the specified resource.
     *
     * @param Feedback $feedback
     * @return \Illuminate\Http\Response
     */
    public function show(Feedback $feedback)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Feedback $feedback
     * @return \Illuminate\Http\Response
     */
    public function edit(Feedback $feedback)
    {
        return view('admin.feedbacks.edit', [
            'feedbackFields' => $feedback::$columnsToGet,
            'feedback' => $feedback,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param Feedback $feedback
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, Feedback $feedback)
    {

        $updated = $feedback->fill($request->only('nickName', 'message'))->save();

        if($updated){
            return redirect()->route('admin.feedbacks')->with('success', __('messages.admin.feedbacks.updated.success'));
        }
        return back()->with('error', __('messages.admin.feedbacks.updated.error'))->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Feedback $feedback
     * @return \Illuminate\Http\Response
     */
    public function destroy(Feedback $feedback)
    {
        $deleted = $feedback->delete();
        if($deleted){
            return redirect()->route('admin.feedbacks')->with('success', __('messages.admin.feedbacks.deleted.success'));
        }
        return back()->with('error', __('messages.admin.feedbacks.deleted.error'))->withInput();
    }
}
