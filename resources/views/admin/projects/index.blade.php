@extends('layouts.app')

@section('content')

@section('title', 'Projects')

{{-- modal  --}}
@include('includes.projects.modal')


<h1>Progetti</h1>
<hr>
<table class="table table-hover table-striped">
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Titolo</th>
            <th scope="col">Creato</th>
            <th scope="col">Modificato</th>
            <th>
                <div class="d-flex justify-content-end gap-3">
                    <a href="{{route('admin.projects.trash')}}" class="btn btn-secondary">
                        <i class="fa-solid fa-trash-can me-2"></i>
                        Vedi Cestino
                    </a>
                    <a href="{{ route('admin.projects.create') }}" class="btn btn-success">
                        <i class="fa-solid fa-plus me-2"></i>
                        Crea nuovo
                    </a>
                </div>
            </th>
        </tr>
    </thead>
    <tbody>
        @forelse ($projects as $project)

            <tr>
                <th scope="row">{{ $project->id }}</th>
                <td>{{ $project->title }}</td>
                <td>{{ $project->getDate($project->created_at) }}</td>
                <td>{{ $project->getDate($project->updated_at) }}</td>
                <td>
                    <div class="d-flex justify-content-end gap-3">
                        <a href="{{ route('admin.projects.show', $project->id) }}" class="btn btn-primary"><i
                                class="fa-regular fa-eye"></i></a>
                        <a href="{{ route('admin.projects.edit', $project->id) }}" class="btn btn-warning"><i
                                class="fa-solid fa-pen"></i></a>
                        
                        <form action="{{ route('admin.projects.destroy', $project->id) }}" method="POST" class="delete-form" data-bs-toggle="modal" data-bs-target="#delete-modal" data-project="{{$project->title}}">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger"><i class="fa-regular fa-trash-can"></i></button>
                        </form>

                    </div>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5">Non ci sono progetti da vedere</td>
            </tr>
        @endforelse

    </tbody>
</table>



@endsection

@section('scripts')
@vite('resources/js/modal.js')
@endsection

{{-- todo nuova colonna is_completed e cambiare per questo tutto quello che serve --}}
