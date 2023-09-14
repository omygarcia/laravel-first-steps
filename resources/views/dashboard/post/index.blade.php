@extends('layout.master')
@section('content')
    <h2>Listado</h2>
    <a href="{{route('post.create')}}" class="btn btn-primary">Crear</a>
    <table class="table table-bordered">
        <thead class="bg-dark text-white">
            <tr>
                <th>Titulo</th>
                <th>Categoria</th>
                <th>Posted</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($posts as $p)
                <tr>
                    <td>{{$p->title}}</td>
                    <td>{{$p->category->title}}</td>
                    <td>{{$p->posted}}</td>
                    <td>
                        <a href="{{route('post.edit',$p->id)}}" class="btn btn-primary">
                            Editar
                        </a>
                        <a href="{{route('post.show',$p->id)}}" class="btn btn-primary">
                            Ver
                        </a>
                        <form action="{{route('post.destroy',$p->id)}}" method="POST">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger">
                                Eliminar
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="pagination">
        {{$posts->links('pagination::bootstrap-4')}}
    </div>
@endsection