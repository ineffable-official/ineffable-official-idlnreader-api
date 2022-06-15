<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $data = Category::all();

            return response()->json($data, Response::HTTP_OK);
        } catch (\Throwable $th) {
            return response()->json(["message" => $th->getMessage()], Response::HTTP_BAD_REQUEST);
        }
    }

    public function showBookByCategory()
    {
        try {
            $data = Category::all()->book();

            return response()->json($data, Response::HTTP_OK);
        } catch (\Throwable $th) {
            return response()->json(["message" => $th->getMessage()], Response::HTTP_BAD_REQUEST);
        }
    }

    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                "name" => 'require|string',
            ]);

            if ($validator->fails()) {
                return response()->json(["message" => $validator->errors()->__toString()], Response::HTTP_BAD_REQUEST);
            }

            return response()->json(["message" => "Category added successfully"], Response::HTTP_OK);
        } catch (\Throwable $th) {
            return response()->json(["message" => $th->getMessage()], Response::HTTP_BAD_REQUEST);
        }
    }
}
