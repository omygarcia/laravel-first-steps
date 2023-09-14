@extends('layout.master')
@section('content')
    <h2>Actualizar Post: {{$post->title}}</h2>
    @include('fragment/_errors-form')
    <div class="row">
        <div class="col-md-6">
            <form action="{{route('post.update',$post->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                @include('dashboard.post._form',["task"=>"edit"])
                <button type="submit" class="btn btn-primary">
                    Enviar
                </button>
            </form>
        </div>
    </div>
@endsection 