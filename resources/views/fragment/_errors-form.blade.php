@if($errors->any())
<div class="alert alert-danger" role="alert">
    @foreach($errors->all() as $err)
        <li>{{$err}}</li>
    @endforeach
</div>
@endif