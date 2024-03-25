@extends('layouts.app')

@section('title', 'Home')
@section('content')

<h1>I nostri progetti</h1>
<hr>
<div class="row">
        @forelse ($projects as $project)
        <div class="col-3 my-3">

            <div class="card my-card">
                <figure class="my-card-img">
                    <img src="{{ $project->image ? $project->getImagePath() : 'https://bub.bh/wp-content/uploads/2018/02/image-placeholder.jpg' }}" class="card-img-top img-fluid " alt="{{$project->title}}" >
                </figure>
                <div class="card-body d-flex flex-column justify-content-between">
                    <div>
                        <h5 class="card-title mb-3">{{$project->title}}</h5>
                        <p class="card-text">{{$project->getAbstract()}}</p>
                    </div>
                    <div class="mt-3">
                        <a href="{{route('guest.projects.show', $project->slug)}}" class="btn btn-primary">Vedi dettagli</a>
                    </div>
                </div>
            </div>
        </div>
        @empty
            <h5>Non ci sono progetti</h5>
        @endforelse
    
</div>
@endsection