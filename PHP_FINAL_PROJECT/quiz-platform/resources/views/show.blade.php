@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $quiz->title }}</h1>
    <img src="{{ $quiz->main_photo }}" alt="Quiz photo" class="img-fluid">
    <p class="mt-3">{{ $quiz->description }}</p>
    <!-- Display questions and other quiz details here -->
</div>
@endsection
