@extends('layouts.app')

@section('content')
    <table class="w-full whitespace-no-wrapw-full whitespace-no-wrap">
        <thead>
        <tr class="text-center font-bold">
            <td class="border px-6 py-4">Title</td>
            <td class="border px-6 py-4">Text</td>
            <td class="border px-6 py-4">Tags</td>
        </tr>
        </thead>
        @foreach($posts as $post)
            <tr>
                <td class="border px-6 py-4">{{$post->title}}</td>
                <td class="border px-6 py-4">{{$post->text}}</td>
                <td class="border px-6 py-4">{{$post->tag_names}}</td>
    {{--        <td class="border px-6 py-4">{{$post['tags']->pluck('name')->implode(',')}}</td> --}}
         </tr>
     @endforeach
 </table>
 @stop
