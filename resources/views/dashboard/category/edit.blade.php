@extends('layout.master')
@section('content')
    <h1>Editar: {{$category->id}}</h1>
    <form action="{{route('category.update',$category->id)}}" method="POST">
        @csrf
        @method('PUT')
        @include('dashboard.category._form')
    </form>
@endsection