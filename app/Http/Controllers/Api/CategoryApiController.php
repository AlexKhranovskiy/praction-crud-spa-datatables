<?php

namespace App\Http\Controllers\Api;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryApiController
{
    public function index()
    {
        return response()->json(Category::all());
    }

    public function indexWrapped()
    {
        return response()->json(['data' => Category::all()]);
    }

    public function show(int $id)
    {
        return response()->json(Category::find($id));
    }

    public function store(Request $request)
    {
        Category::create($request->toArray());
        return response()->json(['message' => 'Successfully created'], 201);
    }

    public function update(int $id, Request $request)
    {
        $category = Category::whereId($id)->firstOr(function(){
            return null;
        });

        if(is_null($category)){
            return response()->json(['message' => 'Wrong Id'], 400);
        } else {
            $category->update($request->toArray());
            return response()->json(['message' => 'Successfully updated'], 201);
        }
    }

    public function destroy(int $id)
    {
        Category::whereId($id)->delete();
        return response()->json(['message' =>'Successfully deleted'], 201); //$id;
    }
}
