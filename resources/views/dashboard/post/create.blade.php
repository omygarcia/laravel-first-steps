@extends('layout.master')
@section('content')
    <h1>Crear Post</h1>
    @include('fragment/_errors-form')
    <div class="row">
        <div class="col-md-6">
            <form action="{{route('post.store')}}" method="POST">
                @csrf
                @include('dashboard.post._form')
                <button type="submit" class="btn btn-primary">
                    Enviar
                </button>
            </form>
        </div>
    </div>
@endsection 