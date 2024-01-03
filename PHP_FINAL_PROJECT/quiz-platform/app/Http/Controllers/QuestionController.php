<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function create(Quiz $quiz)
    {
        return view('questions.create', compact('quiz'));
    }

    public function store(Request $request, Quiz $quiz)
    {
        $data = $request->validate([
            'content' => 'required|string|max:255',
            'photo' => 'nullable|image',
        ]);

        $question = $quiz->questions()->create($data);

        if ($request->hasFile('photo')) {
            $question->addMedia($request->file('photo'))->toMediaCollection('photos');
        }

        return redirect()->route('quizzes.show', $quiz);
    }

    public function edit(Question $question)
    {
        return view('questions.edit', compact('question'));
    }

    public function update(Request $request, Question $question)
    {
        $data = $request->validate([
            'content' => 'required|string|max:255',
            'photo' => 'nullable|image',
        ]);

        $question->update($data);

        if ($request->hasFile('photo')) {
            $question->clearMediaCollection('photos');
            $question->addMedia($request->file('photo'))->toMediaCollection('photos');
        }

        return redirect()->route('quizzes.show', $question->quiz);
    }

}
