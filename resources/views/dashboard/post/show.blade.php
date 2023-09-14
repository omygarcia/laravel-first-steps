@extends('layout.master')
@section('content')
    <h2>Mostrar Post: {{$post->title}}</h2>
    @include('fragment/_errors-form')
    <div class="row">
        <div class="col-md-6">
        
        </div>
    </div>
@endsection 