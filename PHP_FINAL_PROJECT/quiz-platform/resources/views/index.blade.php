@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Quizzes</h1>
    <a href="{{ route('quizzes.create') }}" class="btn btn-primary">Create New Quiz</a>
    <div class="mt-3">
        @foreach ($quizzes as $quiz)
            <div class="card mb-2">
                <div class="card-body">
                    <h5 class="card-title">{{ $quiz->title }}</h5>
                    <p class="card-text">{{ $quiz->description }}</p>
                    <a href="{{ route('quizzes.show', $quiz) }}" class="btn btn-secondary">View Quiz</a>
                    <a href="{{ route('quizzes.edit', $quiz) }}" class="btn btn-info">Edit Quiz</a>
                    <form action="{{ route('quizzes.destroy', $quiz) }}" method="POST" style="display: inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
