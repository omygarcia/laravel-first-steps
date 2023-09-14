<div class="col-md-6">
    <label>Titulo</label>
    <input type="text" name="title" value="{{old('title',$category->title)}}" class="form-control" />
    <label>Slug</label>
    <input type="text" name="slug" value="{{old('slug',$category->slug)}}" class="form-control" />
    <button type="submit" class="btn btn-primary">
        <i class="bi bi-floppy"></i>
        Guardar
    </button>
</div>
