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
    public function store(StorePostRequest $request)
    {
        $validated = $request->validated();

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
    public function update(UpdatePostRequest $request, string $id)
    {
        $post = Post::find($id);

        if (!$post) {
            return response()->json(['message' => 'Post no encontrado'], 404);
        }

        $validated = $request->validated();

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
