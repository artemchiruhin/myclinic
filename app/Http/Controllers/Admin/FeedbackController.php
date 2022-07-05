<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Feedback;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    public function index()
    {
        $feedbacks = Feedback::all();
        return view('admin.feedbacks.index', compact('feedbacks'));
    }

    public function approve(Request $request, Feedback $feedback)
    {
        $feedback->approved = 1;
        $feedback->save();
        return redirect(route('admin.feedbacks.index'))
            ->with(['feedbackApproved' => 'Отзыв был одобрен.']);
    }

    public function destroy(Feedback $feedback)
    {
        if($feedback->delete()) {
            return redirect(route('admin.feedbacks.index'))->with(['feedbackDeleted' => 'Отзыв был удален.']);
        }
        return redirect(route('admin.feedbacks.index'))->with(['feedbackError' => 'Произошла ошибка.']);
    }
}
