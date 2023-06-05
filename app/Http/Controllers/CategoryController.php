<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        return view('categories', ['categories' => Category::all()]);
    }

    public function delete(int $id)
    {
        file_put_contents('1.txt', $id);
    }

}
