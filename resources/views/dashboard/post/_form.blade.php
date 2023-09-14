<label>Categoria</label>
<select name="category_id" class="form-control">
    <option>Seleccione una opción</option>
    @foreach ($categories as $c => $val)
        <option {{old('category_id',$post->category_id) == $val?'selected':''}} value="{{$val}}">{{$c}}</option>
    @endforeach
</select>
<label>Posteado</label>
<select name="posted" class="form-control">
    <option {{old('posted',$post->posted) == 'not'?'selected':''}} value="not">No</option>
    <option {{old('posted',$post->posted) == 'yes'?'selected':''}} value="yes">Si</option>
</select>
<label>Titulo</label>
<input type="text" name="title" value="{{old('title',$post->title)}}" class="form-control" />
<label>Slug</label>
<input type="text" name="slug" value="{{old('slug',$post->slug)}}" class="form-control" />
<label>Contenido</label>
<textarea name="content" class="form-control">{{old('content',$post->content)}}</textarea>
<label>Descripción</label>
<textarea name="description" class="form-control">{{old('description',$post->description)}}</textarea>
@if(isset($task) && $task == 'edit')
    <label>Foto: </label>
    <input style="display:none;" type="file" name="image" id="fls_imagen" />
    <a href="#" onclick="document.getElementById('fls_imagen').click();" class="btn btn-primary btn-sm">Subir Imagen</a>
    <br />
@endif