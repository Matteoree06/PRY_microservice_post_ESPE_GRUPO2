<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::all();

        return response()->json([
            'message' => 'Token validado correctamente. Listado de posts obtenido.',
            'posts' => $posts
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(StorePostRequest $request)
    {
        $validated = $request->validated();

        $post = Post::create($validated);

        return response()->json([
            'message' => 'Token validado correctamente. Post creado correctamente',
            'post' => $post
        ], 201);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {
        return $this->create($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $post = Post::find($id);

        if (!$post) {
            return response()->json(['message' => 'Post no encontrado'], 404);
        }

        return response()->json([
            'message' => 'Token validado correctamente. Post encontrado.',
            'post' => $post
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, string $id)
    {
        $post = Post::find($id);

        if (!$post) {
            return response()->json(['message' => 'Post no encontrado'], 404);
        }

        $validated = $request->validated();
        $post->update($validated);

        return response()->json([
            'message' => 'Token validado correctamente. Post actualizado correctamente',
            'post' => $post
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $post = Post::find($id);

        if (!$post) {
            return response()->json(['message' => 'Post no encontrado'], 404);
        }

        $post->delete();

        return response()->json([
            'message' => 'Token validado correctamente. Post eliminado'
        ], 200);
    }
}