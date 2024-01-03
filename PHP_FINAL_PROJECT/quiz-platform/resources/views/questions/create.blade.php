@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Add a New Question to "{{ $quiz->title }}"</h2>
    <form action="{{ route('questions.store', $quiz) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="content" class="form-label">Question Content</label>
            <input type="text" class="form-control" id="content" name="content" required>
        </div>
        <div class="mb-3">
            <label for="photo" class="form-label">Photo (optional)</label>
            <input type="file" class="form-control" id="photo" name="photo">
        </div>
        <!-- Add fields for possible answers here -->
        <button type="submit" class="btn btn-primary">Add Question</button>
    </form>
</div>
@endsection
