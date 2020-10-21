<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AuthorController extends Controller
{
    public function store(Request $request)
    {
        $author = Author::create($request->only('name', 'dob'));

        return response()->json(compact('author'), Response::HTTP_OK);
    }
}
