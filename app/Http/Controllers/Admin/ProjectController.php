<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class ProjectController extends Controller
{


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::orderByDesc('updated_at')->orderByDesc('created_at')->get();
        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $project = new Project();
        return view('admin.projects.create', compact('project'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'title' => 'required|string|unique:projects',
            'description' => 'required|string',
            'image' => 'nullable|image',
        ], [
            'title.required' => 'Inserisci il titolo del progetto',
            'description.required' => 'Inserisci la descrizione del progetto',
            'image.image' => 'Il formato immagine non è corretto',
        ]);

        $data = $request->all();

        $project = new Project();
        
        $project->fill($data);

        $project->slug = Str::slug($project->title);

        //gestisco l'immagine che mi arriva
        if (Arr::exists($data, 'image')) {
            $extension = $data['image']->extension();
            $img_url = Storage::putFileAs('project_images', $data['image'], "$project->slug.$extension");
            $project->image = $img_url;
        }

        
        $project->save();

        return to_route('admin.projects.show', $project->id)
            ->with('message', "Progetto '$project->title' creato con successo!")
            ->with('type', "success");
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {

        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        return view('admin.projects.edit', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        $request->validate([
            'title' => ['required', 'string', Rule::unique('projects')->ignore($project->id)],
            'description' => 'required|string',
            'image' => 'nullable|image',
        ], [
            'title.required' => 'Inserisci il titolo del progetto',
            'description.required' => 'Inserisci la descrizione del progetto',
            'image.url' => 'Il formato immagine non è corretto',
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($data['title']);

        //gestisco l'immagine, se mi arriva
        if (Arr::exists($data, 'image')) {
            //controllo se aveva già un immagine e la cancella
            if ($project->image) Storage::delete($project->image);

            $extension = $data['image']->extension();
            $img_url = Storage::putFileAs('project_images', $data['image'], "{$data['slug']}.$extension");
            $project->image = $img_url;
        }

        $project->update($data);

        return to_route('admin.projects.show', $project->id)
            ->with('message', "Progetto '$project->title' modificato con successo!")
            ->with('type', "info");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        $project->delete();
        return to_route('admin.projects.index')
            ->with('message', "Progetto '$project->title' eliminato con successo!")
            ->with('type', "danger");
    }

    public function trash()
    {
        $projects = Project::onlyTrashed()->get();
        return view('admin.projects.trash', compact('projects'));
    }

    public function restore(Project $project)
    {
        $project->restore();
        return to_route('admin.projects.index')
            ->with('message', "Progetto '$project->title' ripristinato con successo!")
            ->with('type', "success");
    }

    public function drop(Project $project)
    {
        if ($project->image) Storage::delete($project->image);
        $project->forceDelete();
        return to_route('admin.projects.trash')
        ->with('message', "Progetto '$project->title' eliminato definitivamente!")
        ->with('type', "danger");
    }
}
