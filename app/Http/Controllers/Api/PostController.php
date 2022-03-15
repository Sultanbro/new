<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Http\Requests\PostUpdateRequest;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        return PostResource::collection(Post::all());
    }

    /**
     * @param PostRequest $request
     * @return PostResource
     */
    public function store(PostRequest $request)
    {
        $req = $request->validated();
        $req['image'] = is_null($req['image']) ? $req['image'] : $req['image']->store('public/images');
        return new PostResource(Post::create($req));
    }

    /**
     * Display the specified resource.
     *
     * @param Post $post
     * @return PostResource
     */
    public function show(Post $post)
    {
        return new PostResource($post);
    }

    /**
     * @param PostUpdateRequest $request
     * @param Post $post
     * @return PostResource
     */
    public function update(PostUpdateRequest $request, Post $post)
    {
        $post->update($request->validated());
        return  new PostResource($post);
    }

    /**
     * @param Post $post
     * @return bool|null
     */
    public function destroy(Post $post)
    {
        if (!is_null($post->image))if (Storage::disk('local')->exists($post->image)) {
            Storage::disk('local')->delete($post->image);
        }
        return $post->delete();
    }
}
