@if ($project->exists)
    <form action="{{ route('admin.projects.update', $project->id) }}" method="POST" enctype="multipart/form-data">
        @method('PUT')
    @else
        <form action="{{ route('admin.projects.store') }}" method="POST" enctype="multipart/form-data">
@endif

<div class="row">
    @csrf
    <div class="col-6">
        <div class="mb-3">
            <label for="title" class="form-label">Titolo</label>
            <input type="text"
                class="form-control @error('title') is-invalid @elseif(old('title', '')) is-valid  @enderror"
                id="title" name="title" placeholder="Il mio progetto" value="{{ old('title', $project->title) }}">
            @error('title')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>
    <div class="col-6">
        <div class="mb-3">
            <label for="slug" class="form-label">Slug</label>
            <input type="text" class="form-control" id="slug" disabled>
        </div>
    </div>
    <div class="col-6">
        <div class="mb-3">
            <label for="description" class="form-label">Descrizione</label>
            <textarea class="form-control @error('description') is-invalid @elseif(old('description', '')) is-valid @enderror"
                id="description" name="description" rows="10">{{ old('description', $project->description) }}</textarea>
            @error('description')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>
    <div class="col-5">
        <div class="mb-3">
            <label for="image" class="form-label">Immagine</label>
            <input type="file"
                class="form-control @error('image') is-invalid @elseif(old('image', '')) is-valid @enderror @if ($project->image) d-none @endif"
                id="image" name="image">

            @if ($project->exists)
            <div class="input-group mb-3" id="change-img-container">
                <button class="btn btn-outline-secondary" type="button" id="change-img-button" >Cambia immagine</button>
                <input type="text" class="form-control" disabled value="{{old('image', $project->image)}}">
            </div>
            @endif
            
            @error('image')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>
    <div class="col-1">
        <div class="mb-3">
            <img src=" {{old('image', $project->image) ? $project->getImagePath() : 'https://bub.bh/wp-content/uploads/2018/02/image-placeholder.jpg' }}" id="preview" class="img-fluid">
        </div>
    </div>
    <div class="col-6"></div>
    <div class="col-6 d-flex justify-content-end">
        <div class="mt-3 d-flex gap-3">
            @if ($project->exists)
                @if (!$project->trashed())
                    <a href="{{ route('admin.projects.index') }}" class="btn btn-primary"><i
                            class="fa-solid fa-arrow-left me-2"></i>Torna alla lista</a>
                @else
                    <a href="{{ route('admin.projects.trash') }}" class="btn btn-primary"><i
                            class="fa-solid fa-arrow-left me-2"></i>Torna al cestino</a>
                @endif
                <a href="{{ route('admin.projects.show', $project->id) }}" class="btn btn-secondary"><i
                        class="fa-solid fa-arrow-right me-2"></i>Torna al progetto</a>
                <button class="btn btn-success"><i class="fa-solid fa-floppy-disc me-2"></i>Salva modifiche</button>
            @else
                <a href="{{ route('admin.projects.index') }}" class="btn btn-primary"><i
                        class="fa-solid fa-arrow-left me-2"></i>Torna alla lista</a>
                <button class="btn btn-success"><i class="fa-solid fa-plus me-2"></i>Crea</button>
            @endif

        </div>
    </div>
</div>
</form>
