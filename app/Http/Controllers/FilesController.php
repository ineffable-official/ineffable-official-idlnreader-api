<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFilesRequest;
use App\Http\Requests\UpdateFilesRequest;
use App\Models\Files;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

class FilesController extends Controller
{
    public function index()
    {
        try {
            $data = Files::all();

            return response()->json($data, Response::HTTP_OK);
        } catch (\Throwable $th) {
            return response()->json(["message" => $th->getMessage()], Response::HTTP_BAD_REQUEST);
        }
    }

    public function upload(Request $request)
    {
        try {
            $images = Storage::put('images', $request->file('images'));

            $files = new Files;
            $files->filename = $request->file('images')->getClientOriginalName();
            $files->path = $images;
            $files->extension = $request->file('images')->getClientOriginalExtension();
            $files->size = $request->file('images')->getSize();
            $files->save();

            return response()->json(["message" => "Files added successfully"], Response::HTTP_OK);
        } catch (\Throwable $th) {
            return response()->json(["message" => $th->getMessage()], Response::HTTP_BAD_REQUEST);
        }
    }
}
