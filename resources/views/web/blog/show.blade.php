@extends('layouts.guest')
@section('content')
    <h2>Blog</h2>
    <x-web.blog.post.show :post="$post" class="bg-red-100">
    </x-web.blog.post.show>
    <x-dynamic-component component='web.blog.post.show' :post="$post" class="bg-red-100" />
@endsection