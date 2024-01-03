@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Question</h2>
    <form action="{{ route('questions.update', $question) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="content" class="form-label">Question Content</label>
            <input type="text" class="form-control" id="content" name="content" value="{{ $question->content }}" required>
        </div>
        <div class="mb-3">
            <label for="photo" class="form-label">Photo (optional)</label>
            <input type="file" class="form-control" id="photo" name="photo">
            @if ($question->photo)
                <img src="{{ $question->photo }}" alt="Question photo" class="img-fluid mt-2">
            @endif
        </div>
        <!-- Add fields for possible answers here -->
        <button type="submit" class="btn btn-primary">Update Question</button>
    </form>
</div>
@endsection
