@extends('layouts.guest')
@section('content')
    <h2>Blog</h2>
    <x-web.blog.post.index :posts="$posts">
        <h4>okok</h4>
        @slot('header')
            <h2>Header</h2>
        @endslot
        @slot('footer')
            <footer>
                pie de pagina
            </footer>
        @endslot
        @slot('extra')
            <p>Extra</p>
        @endslot
    </x-web.blog.post.index>
    @foreach ($posts as $p)
        {{$p->title}} {{$p->posted}}<br />
    @endforeach
    {{$posts->links()}}
@endsection