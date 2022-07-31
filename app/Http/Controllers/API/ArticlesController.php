<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;

class ArticlesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Article::with(['category', 'user'])->simplePaginate(10);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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

        $post = Article::create($input);

        return response()->json($post, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Article  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Article $post)
    {
        return $post;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Article  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Article $post)
    {
        $rules = [
            'title'         => 'required',
            'content'       => 'required',
            'image'         => 'nullable|mimes:jpeg,jpg,png|max:3072',
            'user_id'       => 'required|exists:users,id',
            'category_id'   => 'required|exists:categories,id',
        ];

        $input = $request->validate($rules);

        if ($request->hasFile('image') && $request->image != '') {
            // remove old image
            if ($post->image != null) {
                $file_path = storage_path() . '/app/public/articles/' . $post->image;
                unlink($file_path); //delete from storage
            }

            $file = $request->file('image');
            $filename = $file->hashName();
            $request->image->storeAs('public/articles', $filename);
            $input['image'] = $filename;
        }

        $post->update($input);

        return response()->json($post, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Article  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $post)
    {
        if ($post->image != null) {
            $file_path = storage_path() . '/app/public/articles/' . $post->image;
            unlink($file_path); //delete from storage
        }

        $post->delete();

        return response()->json(null, 204);
    }
}
