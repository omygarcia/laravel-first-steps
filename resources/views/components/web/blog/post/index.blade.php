<div>
    <!-- When there is no desire, all things are at peace. - Laozi -->
    {{$header}}
    {{$slot}}
    <h2>Hola soy un componente (*_*)</h2>
    @forelse ($posts as $p)
        <div class="card card-white">
            <h2><a href="{{route('blog.show',$p->id)}}">{{$p->title}}</a></h2>
            <p>{{$p->created_at}}</p>
            <p>{{$p->category->title}}</p>
        </div>
        <hr>
    @empty
        No hay posts
    @endforelse
    {{$posts->links()}}
    {{$footer}}
    {{$extra}}
</div>