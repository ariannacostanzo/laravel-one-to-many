@extends('layouts.app')

@section('title', 'Home')
@section('content')

<h1>{{$project->title}}</h1>
<hr>
<div class="row">
    <div class="col-3">
        <img src="{{ $project->image ? $project->getImagePath() : 'https://bub.bh/wp-content/uploads/2018/02/image-placeholder.jpg' }}"
            class="card-img-top" alt="{{ $project->title }}" class="img-fluid">
    </div>
    <div class="col">{{ $project->description }}</div>
</div>
<div class="row my-5">
    <div class="col-4"><strong>Creato:</strong> {{ $project->getDate($project->created_at, 'd-m-Y H:m:s') }} </div>
    <div class="col-4"><strong>Modificato:</strong> {{ $project->getDate($project->updated_at, 'd-m-Y H:m:s') }}</div>
    <div class="col-4">
        <div class="d-flex justify-content-end gap-3">
            <a href="{{ route('guest.home') }}" class="btn btn-primary"><i
                    class="fa-solid fa-arrow-left me-2"></i>Torna alla lista</a>
        </div>
    </div>
</div>
@endsection