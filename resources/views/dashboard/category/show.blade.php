@extends('layout.master')
@section('content')
    <h2>Mostrar Categoria: {{$category->title}}</h2>
    <div class="row">
        <div class="col-md-6">
            <div class="card border-dark mb-3" style="max-width: 18rem;">
                <div class="card-header">Header</div>
                <div class="card-body">
                    <h5 class="card-title">{{$category->title}}</h5>
                    <p class="card-text">{{$category->slug}}</p>
                </div>
            </div>
        </div>
    </div>
@endsection 