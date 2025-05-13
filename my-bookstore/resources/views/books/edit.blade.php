@extends('layouts.app')

@section('title', 'Edit ' . $book->title)

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/edit.css') }}">
@endpush

@section('content')
    <div class="container">
        <h1>Edit Book Details</h1>
        
        @if ($errors->any())
            <div class="error-message">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
        <form method="POST" action="{{ route('books.update', $book->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="form-group">
                <label for="title">Book Title</label>
                <input type="text" id="title" name="title" class="input-field" 
                       value="{{ old('title', $book->title) }}" required>
            </div>
            
            <div class="form-group">
                <label for="author">Author</label>
                <input type="text" id="author" name="author" class="input-field" 
                       value="{{ old('author', $book->author) }}" required>
            </div>
            
            <div class="form-group">
                <label for="genre">Genre</label>
                <input type="text" id="genre" name="genre" class="input-field" 
                       value="{{ old('genre', $book->genre) }}">
            </div>
            
            <div class="form-group">
                <label for="published_year">Published Year</label>
                <input type="number" id="published_year" name="published_year" class="input-field" 
                       value="{{ old('published_year', $book->published_year) }}" 
                       min="1900" max="{{ date('Y') + 5 }}">
            </div>
            
            <div class="form-group">
                <label for="cover">Change Cover Image</label>
                <input type="file" id="cover" name="cover" class="input-field" accept="image/*">
                @if($book->book_image)
                    <div class="book-cover-preview">
                        <img src="{{ asset($book->book_image) }}" alt="Current Cover" style="width:100%;height:100%;object-fit:cover;">
                    </div>
                @endif
            </div>
            
            <button type="submit" class="btn btn-block">Update Book</button>
        </form>
        
        <a href="{{ route('books.index') }}" class="back-link">← Back to Book List</a>
    </div>
@endsection