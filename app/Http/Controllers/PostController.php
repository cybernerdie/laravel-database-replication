<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePostRequest;
use App\Http\Resources\PostResource;
use App\Models\Post;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('created_at', 'desc')->paginate(20);
        $postsResource = PostResource::collection($posts)->response()->getData();

        return response()->json([
            'success' => true,
            'message' => 'Posts retrieved successfully',
            'data' => $postsResource
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePostRequest $request)
    {
        $data = $request->validated();
        $post = Post::create($data);
        $postResource = new PostResource($post);

        return response()->json([
            'success' => true,
            'message' => 'Post created successfully',
            'data' => $postResource
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        $postResource = new PostResource($post);

        return response()->json([
            'success' => true,
            'message' => 'Post retrieved successfully',
            'data' => $postResource
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(CreatePostRequest $request, Post $post)
    {
        $data = $request->validated();
        $post = $post->update($data);
        $postResource = new PostResource($post);

        return response()->json([
            'success' => true,
            'message' => 'Post updated successfully',
            'data' => $postResource
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();

        return response()->json([
            'success' => true,
            'message' => 'Post deleted successfully'
        ], 200);
    }
}
