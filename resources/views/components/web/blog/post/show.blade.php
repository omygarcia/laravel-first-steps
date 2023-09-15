<!--<div {{--$attributes->merge(['class'=>'my-5','other-attr'=>'data1'])--}}>-->
    <!-- Life is available only in the present moment. - Thich Nhat Hanh -->
    {{--$changeTitle()--}}

<x-alert class="mb-4" message="Hola mundo" type="success" data-id="1" data-priority="medium" />
<div {{$attributes->class(['py-4 px-4 rounded'])->merge(['other-attr'=>'data1'])}}>
    <h2>{{$post->title}}</h2>
    <p>{{$post->created_at}}</p>
    <p>{{$post->content}}</p>
</div>