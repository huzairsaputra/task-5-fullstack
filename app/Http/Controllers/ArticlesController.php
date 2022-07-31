<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class ArticlesController extends Controller
{
    public function index()
    {
        $articles = Article::paginate(10);

        return view('pages.articles.index', compact('articles'));
    }

    public function show($id)
    {
        $article = Article::findOrFail($id);

        return view('pages.articles.show', compact('article'));
    }

    public function create()
    {
        $categories = Category::where('user_id', Auth::user()->id)->get()->pluck('name', 'id')->toArray();

        if (count($categories) == 0) {
            return redirect()->route('categories.create');
        }

        return view('pages.articles.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $rules = [
            'title'         => 'required',
            'content'       => 'required',
            'image'         => 'nullable|mimes:jpeg,jpg,png|max:3072',
            'user_id'       => 'required|exists:users,id',
            'category_id'   => 'required|exists:categories,id',
        ];

        $input = $request->validate($rules);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = $file->hashName();
            $request->image->storeAs('public/articles', $filename);
            $input['image'] = $filename;
        }

        Article::create($input);

        return redirect('articles');
    }

    public function edit($id)
    {
        $article = Article::findOrFail($id);
        $categories = Category::where('user_id', Auth::user()->id)->get()->pluck('name', 'id')->toArray();

        return view('pages.articles.edit', compact('article', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $rules = [
            'title'         => 'required',
            'content'       => 'required',
            'image'         => 'nullable|mimes:jpeg,jpg,png|max:3072',
            'user_id'       => 'required|exists:users,id',
            'category_id'   => 'required|exists:categories,id',
        ];

        $input = $request->validate($rules);
        $article = Article::findOrFail($id);

        if ($request->hasFile('image') && $request->image != '') {
            // remove old image
            if ($article->image != null) {
                $file_path = storage_path() . '/app/public/articles/' . $article->image;
                unlink($file_path); //delete from storage
            }

            $file = $request->file('image');
            $filename = $file->hashName();
            $request->image->storeAs('public/articles', $filename);
            $input['image'] = $filename;
        }

        $article->update($input);

        return redirect('articles');
    }

    public function destroy($id)
    {
        $article = Article::findOrFail($id);

        if ($article->image != null) {
            $file_path = storage_path() . '/app/public/articles/' . $article->image;
            unlink($file_path); //delete from storage
        }

        $article->delete();

        return redirect('articles');
    }
}
