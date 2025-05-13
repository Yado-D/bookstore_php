<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::all();
        return view('books.index', compact('books'));
    }

    public function create()
    {
        return view('books.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'genre' => 'nullable|string|max:255',
            'published_year' => 'required|integer|min:1900|max:' . (date('Y') + 5),
            'cover' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        try {
            $book = new Book();
            $book->title = $validated['title'];
            $book->author = $validated['author'];
            $book->genre = $validated['genre'];
            $book->published_year = $validated['published_year'];

            if ($request->hasFile('cover')) {
                $path = $request->file('cover')->store('covers', 'public');
                $book->book_image = $path;
            }

            $book->save();

            return redirect()->route('books.index')->with('success', 'Book added successfully!');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Error uploading image: ' . $e->getMessage());
        }
    }

    public function edit(Book $book)
    {
        return view('books.edit', compact('book'));
    }

    public function update(Request $request, Book $book)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'genre' => 'nullable|string|max:255',
            'published_year' => 'required|integer|min:1900|max:' . (date('Y') + 5),
            'cover' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $book->title = $validated['title'];
        $book->author = $validated['author'];
        $book->genre = $validated['genre'];
        $book->published_year = $validated['published_year'];

        if ($request->hasFile('cover')) {
            // Delete old image if exists
            if ($book->book_image) {
                $oldImage = str_replace('storage/', 'public/', $book->book_image);
                Storage::delete($oldImage);
            }

            $path = $request->file('cover')->store('public/covers');
            $book->book_image = str_replace('public/', 'storage/', $path);
        }

        $book->save();

        return redirect()->route('books.index')->with('success', 'Book updated successfully!');
    }

    public function destroy(Book $book)
    {
        // Delete associated image if exists
        if ($book->book_image) {
            $imagePath = str_replace('storage/', 'public/', $book->book_image);
            Storage::delete($imagePath);
        }

        $book->delete();
        return redirect()->route('books.index')->with('success', 'Book deleted successfully!');
    }
}
