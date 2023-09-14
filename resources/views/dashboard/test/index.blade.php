@extends('layout.master')
@section('title')
    Home
@endsection
@section('content')
    {!! $html !!}

    @include("fragment.subview")

    @if ($name == "Omar García")
        Es True
    @else
        Es False
    @endif

    @foreach ($arr as $elem)
        {{$elem}}
    @endforeach
    <hr />
    @forelse ($arr as $item)
        {{$item}}
    @empty
        No hay Elementos
    @endforelse
    <h1>{{$name}}</h1>
    <h3>{{$age}}</h3>
    {{--$age--}}
@endsection
