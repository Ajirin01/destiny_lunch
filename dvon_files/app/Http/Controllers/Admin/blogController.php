<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class blogController extends Controller
{
    public function index()
    {
        return response()->json(['Blog dashboard']);
    }

    public function create()
    {
        return response()->json(['Blog creation form']);
    }

    public function store(Request $request)
    {
        return response()->json(['Blog creation form']);
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
