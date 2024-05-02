<?php

namespace App\Http\Controllers\Admin_Controller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserFeedback;
use App\Models\User;
use App\Http\Requests\UserFeedbackRequest;
use App\Notifications\FeedbackNotification;
use Illuminate\Support\Facades\Notification;
use Spatie\Permission\Models\Role;

class FeedbackController extends Controller
{
    protected $userfeedback;
    public function __construct(UserFeedback $userfeedback)
    {
        $this->userfeedback = $userfeedback;
    }

    public function index()
    {
        $userfeedbacks = $this->userfeedback->simplePaginate(10);
        return view('admin_Panel.feedback.index',compact('userfeedbacks'));
    }

    public function store(UserFeedbackRequest $request)
    {
        $validatedData = $request->validated();

        $this->userfeedback->create($validatedData);

        $admins = User::role(['Super Admin', 'Administrator'])->get();
        foreach ($admins as $admin) {
           $admin->notify(new FeedbackNotification($validatedData));
        }

        return response()->json([
            'message' => 'Your message has been sent. Thank you!',
            'data' => $validatedData
          ], 200);
    }

    public function show($id)
    {
        $feedbackDetail = $this->userfeedback->where('id', $id)->firstOrFail();
        return view('admin_Panel.feedback.feedback-detail',compact('feedbackDetail'));
    }
}
