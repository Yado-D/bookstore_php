@extends('layouts.app')

@section('title', 'Add New Book')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/add.css') }}">
@endpush

@section('content')
    <div class="container">
        <h1>Add New Book</h1>
        
        @if ($errors->any())
            <div class="error-message">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
        <form method="POST" action="{{ route('books.store') }}" enctype="multipart/form-data">
            @csrf
            
            <div class="cover-upload">
                <div class="cover-preview" id="coverPreview">
                    <span>Click to add cover</span>
                </div>
                <input type="file" id="coverImage" name="cover" accept="image/*" style="display: none;">
            </div>
            
            <div class="form-group">
                <label for="title">Title *</label>
                <input type="text" id="title" name="title" class="input-field" required value="{{ old('title') }}">
            </div>
            
            <div class="form-group">
                <label for="author">Author *</label>
                <input type="text" id="author" name="author" class="input-field" required value="{{ old('author') }}">
            </div>
            
            <div class="form-group">
                <label for="genre">Genre</label>
                <input type="text" id="genre" name="genre" class="input-field" value="{{ old('genre') }}">
            </div>
            
            <div class="form-group">
                <label for="published_year">Published Year *</label>
                <input type="number" id="published_year" name="published_year" 
                       class="input-field" min="1900" max="{{ date('Y') + 5 }}" required value="{{ old('published_year') }}">
            </div>
            
            <button type="submit" class="btn">Add Book</button>
        </form>
        
        <a href="{{ route('books.index') }}" class="back-link">← Back to Book List</a>
    </div>

    @push('scripts')
        <script>
            // Cover image preview functionality
            const coverPreview = document.getElementById('coverPreview');
            const coverImage = document.getElementById('coverImage');
            
            coverPreview.addEventListener('click', () => {
                coverImage.click();
            });
            
            coverImage.addEventListener('change', (e) => {
                const file = e.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = (event) => {
                        coverPreview.innerHTML = `<img src="${event.target.result}" style="width:100%;height:100%;object-fit:cover;">`;
                    };
                    reader.readAsDataURL(file);
                }
            });
        </script>
    @endpush
@endsection