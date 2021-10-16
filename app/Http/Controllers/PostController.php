<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()  {
        //$posts = Post::with('tags')->get();

        //SQLite
        $groupTags = 'GROUP_CONCAT(tags.name,\', \') as tag_names';

        switch (config('database.default')) {
            case 'mysql':
                $groupTags = 'GROUP_CONCAT(tags.name SEPARATOR \', \') as tag_names';
                break;
            case 'pgsql':
                $groupTags = 'STRING_AGG(tags.name,\', \') as tag_names';
                break;
        }

        $posts = Post::SelectRaw( 'posts.id, posts.title, posts.text, '.$groupTags)
            ->leftJoin('post_tag', 'posts.id', '=', 'post_tag.post_id')
            ->leftJoin('tags', 'post_tag.tag_id', '=', 'tags.id')
            ->groupBy('posts.id')->get();

        return view('post.index', compact('posts'));
    }
}
