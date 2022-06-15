<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Files;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class BookController extends Controller
{
    public function index()
    {
        try {
            $data = Book::all()->sortBy('timestamp');

            return response()->json($data, 200);
        } catch (\Throwable $th) {
            return response()->json(["message" => $th->getMessage()], Response::HTTP_OK);
        }
    }

    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'title' => "required|string",
                "slug" => 'required|string',
                'group_id' => 'required|integer',
                'category_id' => 'required',
                'type' => 'required|string',
                'author' => 'required|string',
                'publisher' => 'required|string',
                'descriptions' => 'nullable|string',
                'images' => 'file|max:20000',
                'content' => 'required|string'
            ]);

            if ($validator->fails()) {
                return response()->json(["message" => $validator->errors()], Response::HTTP_BAD_REQUEST);
            }

            $images = null;

            if ($request->file('images')) {
                $images = Storage::disk('public')->put('images', $request->file('images'));

                $files = new Files;
                $files->filename = $request->file('images')->getClientOriginalName();
                $files->path = $images;
                $files->extension = $request->file('images')->getClientOriginalExtension();
                $files->size = $request->file('images')->getSize();
                $files->save();
            }

            $book = new Book;
            $book->title = $request->title;
            $book->slug = $request->slug;
            $book->group_id = $request->group_id;
            $book->category_id = $request->category_id;
            $book->type = $request->type;
            $book->author = $request->author;
            $book->publisher = $request->publisher;
            $book->descriptions = $request->descriptions;
            $book->thumbnail = $images;
            $book->content = $request->content;
            $book->save();

            return response()->json(["message" => 'Book added successfully'], Response::HTTP_OK);
        } catch (\Throwable $th) {
            return response()->json(["message" => $th->getMessage()], Response::HTTP_BAD_REQUEST);
        }
    }

    public function show($slug)
    {
        try {
            $data = Book::findOrFail($slug)->first();

            return response()->json($data, 200);
        } catch (ModelNotFoundException $mnfe) {
            return response()->json(["message" => "Book not found"], Response::HTTP_NOT_FOUND);
        } catch (\Throwable $th) {
            return response()->json(["message" => $th->getMessage()], Response::HTTP_BAD_REQUEST);
        }
    }
}
