<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function listQuizzes()
    {
        $quizzes = Quiz::all(); 
        return view('admin.quizzes.list', compact('quizzes'));
    }

    public function publishQuiz($id)
    {
        $quiz = Quiz::findOrFail($id);
        $quiz->is_published = true;
        $quiz->save();

        return redirect()->route('admin.quizzes.list')->with('status', 'Quiz published!');
    }


}

