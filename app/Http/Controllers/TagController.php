<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function tagpost($tag)
    {
//        $posts= $tag->posts()'
        $data =  Tag::with('posts')->where('id',$tag)->paginate(3);
        $tags = Tag::all();

        return view('tagposts.posts',compact('data','tags'));
    }


}
