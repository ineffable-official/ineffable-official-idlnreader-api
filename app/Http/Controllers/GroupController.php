<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreGroupRequest;
use App\Http\Requests\UpdateGroupRequest;
use App\Models\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $data = Group::all();

            return response()->json($data, Response::class);
        } catch (\Throwable $th) {
            return response()->json(["message" => $th->getMessage()], Response::HTTP_BAD_REQUEST);
        }
    }

    public function showBookByGroup()
    {
        try {
            $data = Group::find(1);

            return response()->json($data, Response::HTTP_OK);
        } catch (\Throwable $th) {
            return response()->json(["message" => $th->getMessage()], Response::HTTP_BAD_REQUEST);
        }
    }

    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), ["name" => "required|string"]);

            if ($validator->fails()) {
                return response()->json(["message" => $validator->errors()->__toString()], Response::HTTP_BAD_REQUEST);
            }

            return response()->json(["message" => "Group added Successfuly"], Response::HTTP_OK);
        } catch (\Throwable $th) {
            return response()->json(["message" => $th->getMessage()], Response::HTTP_BAD_REQUEST);
        }
    }
}
