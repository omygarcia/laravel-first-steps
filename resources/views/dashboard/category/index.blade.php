@extends('layout.master')
@section('content')
    <h2>Lista Categorias</h2>
    <a href="{{route('category.create')}}" class="btn btn-primary">
        <i class="bi bi-floppy"></i>
        Nuevo
    </a>
    <!--<table class="table table-bordered">
        <thead class="bg-dark text-white">-->
    <table class="table2">
        <thead>
            <tr>
                <th>Categoria</th>
                <th>Slug</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($categories as $c)
                <tr>
                    <td>{{$c->title}}</td>
                    <td>{{$c->slug}}</td>
                    <td>
                        <a href="{{route('category.edit',$c->id)}}" class="btn btn-primary">
                            <i class="bi bi-pencil-square"></i>
                            Editar
                        </a>
                        <a href="{{route('category.show',$c->id)}}" class="btn btn-primary">
                            <i class="bi bi-eye"></i>
                            Ver
                        </a>
                        <form action="{{route('category.destroy',$c->id)}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">
                                <i class="bi bi-trash"></i>
                                Eliminar
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection