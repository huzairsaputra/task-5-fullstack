<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoriesController extends Controller
{
    public function index()
    {
        $categories = Category::paginate(10);

        return view('pages.categories.index', compact('categories'));
    }

    public function show($id)
    {
        $category = Category::findOrFail($id);

        return view('pages.categories.show', compact('category'));
    }

    public function create()
    {
        return view('pages.categories.create');
    }

    public function store(Request $request)
    {
        $rules = [
            'name'      => 'required',
            'user_id'   => 'required|exists:users,id',
        ];

        $input = $request->validate($rules);
        Category::create($input);

        return redirect('categories');
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);

        return view('pages.categories.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $rules = [
            'name'      => 'required',
            'user_id'   => 'required|exists:users,id',
        ];

        $input = $request->validate($rules);
        $category = Category::findOrFail($id);
        $category->update($input);

        return redirect('categories');
    }

    public function destroy($id)
    {
        Category::destroy($id);

        return redirect('categories');
    }

}
