@extends('layout.master')
@section('content')
    <h2>Nueva Categoria</h2>
    <form action="{{route('category.store')}}" method="POST">
        @csrf
        @include('dashboard.category._form')
    </form>
@endsection