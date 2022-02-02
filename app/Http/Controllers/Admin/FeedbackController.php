<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
            $request->validate([
                'nickName'=>[
                    'min:5',
                    'required',
                    'string'
                ],
                'message'=>[
                    'required',
                    'max:500'
                ]
            ]);

        $data = $request->only('nickName', 'message');
        $created = Feedback::create($data);
        if($created){

            return redirect()->route('admin.feedbacks')->with('success', 'Отзыв добавлен');
        }
        return back()->with('error', 'Ошибка добавления отзыва')->withInput();
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
     * @param \Illuminate\Http\Request $request
     * @param Feedback $feedback
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Feedback $feedback)
    {
        $request->validate([
            'nickName'=>[
                'min:5',
                'required',
                'string'
            ],
            'message'=>[
                'required',
                'min:20',
                'max:500'
            ]
        ]);
        $updated = $feedback->fill($request->only('nickName', 'message'))->save();

        if($updated){
            return redirect()->route('admin.feedbacks')->with('success', 'Запись обновлена');
        }
        return back()->with('error', 'Ошибка обновления записи')->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Feedback $feedback
     * @return \Illuminate\Http\Response
     */
    public function destroy(Feedback $feedback)
    {
        //
    }
}
