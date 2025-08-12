<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Menu;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rows = Post::whereNull('posts.deleted_at')
        ->leftJoin('menus', 'posts.menu_id', '=', 'menus.id')
        ->leftJoin('users as u1', 'posts.created_by', '=', 'u1.id')
        ->leftJoin('users as u2', 'posts.updated_by', '=', 'u2.id')
        ->leftJoin('users as u3', 'posts.deleted_by', '=', 'u3.id')
        ->select(
            'posts.*',
            'menus.name as menu_name',
            'u1.name as created_name',
            'u2.name as updated_name',
            'u3.name as deleted_name'
        )
        ->get();


        return view('posts.index', compact('rows'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $menus = Menu::whereNull('menus.deleted_at')->get();

        return view('posts.create', compact('menus'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'contents' => 'required|string',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $path = null;
        if ($request->hasFile('thumbnail')) {
            $file = $request->file('thumbnail');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images/thumbnail'), $filename);
            $path = 'images/thumbnail/' . $filename;
        }

        Post::create([
            'title' => $request->title,
            'subtitle' => $request->subtitle,
            'content' => $request->contents,
            'thumbnail' => $path,
            'menu_id' => $request->menu_id,
            'created_by' => getCurrentUser()->id,
            'created_at' =>  date('Y-m-d-H:i:s'),
        ]);

        return redirect()->route('post_list');
    }



    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $row = Post::findOrFail($id);
        $menus = Menu::whereNull('menus.deleted_at')->get();
        
        return view('posts.edit', compact('row', 'menus'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'contents' => 'required|string',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $post = Post::findOrFail($id);
        $path = $post->thumbnail;

        if ($request->hasFile('thumbnail')) {
            if ($path) {
                unlink(public_path($path));
            }
            $file = $request->file('thumbnail');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images/thumbnail'), $filename);
            $path = 'images/thumbnail/' . $filename;
        }

        $post->update([
            'title' => $request->title,
            'subtitle' => $request->subtitle,
            'content' => $request->contents,
            'thumbnail' => $path,
            'menu_id' => $request->menu_id,
            'updated_by' => getCurrentUser()->id,
            'updated_at' => date('Y-m-d-H:i:s'),
        ]);

        return redirect()->route('post_list');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $post = Post::findOrFail($id);
        $post->deleted_by = getCurrentUser()->id;
        $post->deleted_at = date('Y-m-d-H:i:s');
        $post->save();

        if ($post->thumbnail) {
            unlink(public_path($post->thumbnail));
        }

        return redirect()->route('post_list');
    }
}
