@extends('layouts.app')

@section('content')

@section('title', 'Edit Type')
    
<h1>Crea un nuovo tipo</h1>
<hr>

<form action="{{route('admin.types.store')}}" method="POST">
    @csrf
    <div class="row align-items-center justify-content-end">
        <div class="col-4">
            <label for="label" class="form-label">Etichetta</label>
            <input type="text"
                class="form-control @error('label') is-invalid @elseif(old('label', '')) is-valid  @enderror"
                id="label" name="label" placeholder="FrontEnd" value="{{ old('label') }}">
        </div>
        <div class="col-2">
            <label for="color" class="form-label">Colore</label>
            <input type="color"
                class="form-control @error('color') is-invalid @elseif(old('color', '')) is-valid  @enderror"
                id="color" name="color" value="{{ old('color') }}">
        </div>
        <div class="col d-flex justify-content-end ">
                <button class="btn btn-success"><i class="fa-solid fa-plus me-2"></i>Crea</button>
        </div>
    </div>

</form>

@endsection

