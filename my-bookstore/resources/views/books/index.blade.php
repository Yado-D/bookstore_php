@extends('layouts.app')

@section('title', 'Book List')

@section('content')
    <div class="header">
        <h1>Book List</h1>
        <div class="add-button">
            <a href="{{ route('books.create') }}" style="color: white; text-decoration: none;">Add New Book</a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="books-container">
        @foreach($books as $book)
            <div class="book-card">
                @if($book->book_image)
                <div class="image-container">
                    <img src="{{ asset($book->book_image) }}" alt="Book Cover">
                </div>
                @endif
                <div class="book-info">
                    <h3 class="book-title">{{ $book->title }}</h3>
                    <p class="book-author">by {{ $book->author }}</p>
                    <div class="action-buttons">
                        <a href="{{ route('books.edit', $book->id) }}" class="btn btn-edit">Edit</a>
                        <form action="{{ route('books.destroy', $book->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-delete">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection