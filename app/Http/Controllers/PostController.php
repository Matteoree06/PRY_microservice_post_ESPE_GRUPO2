<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Post::all(), 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    
    
    // Crear un Post
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'     => 'required|string|max:255',
            'content'   => 'required|string',
            'user_id'   => 'required|integer',
            'published' => 'boolean'
        ]);

        $post = Post::create($validated);

        return response()->json([
            'message' => 'Post creado correctamente',
            'post' => $post
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    
    
    // Obtener un Post por ID
    public function show(string $id)
    {
        $post = Post::find($id);

        if (!$post) {
            return response()->json(['message' => 'Post no encontrado'], 404);
        }

        return response()->json($post, 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    // Editar un Post (no implementado)
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    
    //Actualizar un Post
    public function update(Request $request, string $id)
    {
        $post = Post::find($id);

        if (!$post) {
            return response()->json(['message' => 'Post no encontrado'], 404);
        }

        $validated = $request->validate([
            'title'     => 'string|max:255',
            'content'   => 'string',
            'user_id'   => 'integer',
            'published' => 'boolean'
        ]);

        $post->update($validated);

        return response()->json([
            'message' => 'Post actualizado correctamente',
            'post' => $post
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    
    // Eliminar un Post
    public function destroy(string $id)
    {
        $post = Post::find($id);

        if (!$post) {
            return response()->json(['message' => 'Post no encontrado'], 404);
        }

        $post->delete(); 

        return response()->json(['message' => 'Post eliminado'], 200);
    
    }
}
