<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class QuizController extends Controller
{

public function index()
{
    $quizzes = Quiz::orderBy('created_at', 'desc')->get();
    return view('quizzes.index', compact('quizzes'));
}

public function create()
{
    return view('quizzes.create');
}

public function store(Request $request)
{
    $data = $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'nullable|string',
        'main_photo' => 'nullable|image',
    ]);

    $quiz = Quiz::create($data);
    
    if ($request->hasFile('main_photo')) {
        $quiz->addMedia($request->main_photo)->toMediaCollection('main_photo');
    }

    return redirect()->route('quizzes.show', $quiz);
}

public function show(Quiz $quiz)
{
    return view('quizzes.show', compact('quiz'));
}

public function edit(Quiz $quiz)
{
    return view('quizzes.edit', compact('quiz'));
}

public function update(Request $request, Quiz $quiz)
{
    $data = $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'nullable|string',
        'main_photo' => 'nullable|image',
    ]);

    $quiz->update($data);

    if ($request->hasFile('main_photo')) {
        $quiz->addMedia($request->main_photo)->toMediaCollection('main_photo');
    }

    return redirect()->route('quizzes.show', $quiz);
}

public function destroy(Quiz $quiz)
{
    $quiz->delete();
    return redirect()->route('quizzes.index');
}


public function checkAnswer(Request $request)
{
    $validated = $request->validate([
        'question_id' => 'required|exists:questions,id',
        'selected_option' => 'required',
    ]);

    $question = Question::find($validated['question_id']);
    $isCorrect = $question->checkIfCorrect($validated['selected_option']);

    return response()->json([
        'correct' => $isCorrect,
    ]);
}


}
