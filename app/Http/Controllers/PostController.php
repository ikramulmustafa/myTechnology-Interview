<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePostRequest;
use App\Http\Requests\EditPostRequest;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $posts = Post::query();
        if ($request->query()) {
            $posts->where('title', 'like', '%' . $request->q . '%');
        }
        $posts = $posts->orderBy('id', 'desc')
            ->paginate(5);
        $tags = Tag::all();

        return view('posts.index', compact('posts', 'tags'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function create()
    {
        return view('posts.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function store(CreatePostRequest $request)
    {
        $request['slug'] = Str::slug($request->title);
        if ($request->hasFile('featured_image')) {
            $imagePath = $request->file('featured_image');
            $imageName = $imagePath->getClientOriginalName();
            $path = $request->file('featured_image')->storeAs('images', $imageName, 'public');
        }
        $post = Post::create([
            'user_id'=>auth()->user()->id,
            'title' => $request->title,
            'content' => $request['content'],
            'slug' => $request->slug,
            'featured_image' => ($imageName) ? $imageName : NULL,
        ]);
        if($post){
            return redirect(route('posts.index'));
        }else{
            return redirect()->back()
                ->with('error','Something Went Wrong!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Post $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Post $post
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function edit($postId)
    {
        $post=Post::find($postId);
        return view('posts.edit',compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param EditPostRequest $request
     * @param $postId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(EditPostRequest $request,$postId)
    {
        $request['slug'] = Str::slug($request->title);
        if ($request->hasFile('featured_image')) {
            $imagePath = $request->file('featured_image');
            $imageName = $imagePath->getClientOriginalName();
            $path = $request->file('featured_image')->storeAs('images', $imageName, 'public');
        }else{
            $imageName = $request->existing_featured_image;
        }
            $postUpdate = Post::where('id',$postId)->update([
                'title' => $request->title,
                'content' => $request['content'],
                'slug' => $request->slug,
                'featured_image' => ($imageName) ? $imageName : NULL,
            ]);
        if($postUpdate){
            toastr()->success('Post is Successfully Updated ', 'Edit Post Success');
            return redirect(route('posts.index'));
        }else{
            toastr()->error('Post is not Edited ', 'Edit Post Error');
            return redirect()->back()
                ->with('error','Something Went Wrong!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $postId
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($postId)
    {
        $post=Post::find($postId);
        $post->delete();
        return response()->json([
            'message' => 'Post deleted successfully!'
        ]);
    }
}
