<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()  {
        //$posts = Post::with('tags')->get();

        $posts = Post::SelectRaw( 'posts.id, posts.title, posts.text, GROUP_CONCAT(tags.name,\', \') as tag_names')
            ->leftJoin('post_tag', 'posts.id', '=', 'post_tag.post_id')
            ->leftJoin('tags', 'post_tag.tag_id', '=', 'tags.id')
            ->groupBy('posts.id')->get();

        return view('post.index', compact('posts'));
    }
}
