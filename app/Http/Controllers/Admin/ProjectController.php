<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\Project;
use App\Models\Technology;
use App\Models\Type;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.projects.index', ['projects' => Project::all()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $types = Type::all();
        $technologies = Technology::all();

        return view('admin.projects.create', compact('types', 'technologies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProjectRequest $request)
    {

        // dd($request->all());

        $validated = $request->validated();

        $slug = Str::slug($request->project_title, '-');

        $validated['slug'] = $slug;

        if ($request->has('cover_image')) {
            $img_path = Storage::put('uploads', $validated['cover_image']);

            $validated['cover_image'] = $img_path;
        }

        // dd($validated);

        $project = Project::create($validated);

        $project->technologies()->attach($validated['technologies']);

        return to_route('admin.projects.index')->with('message', 'Project successfully created!');
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
        $types = Type::all();
        $technologies = Technology::all();

        return view('admin.projects.edit', compact('project', 'types', 'technologies'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {

        $validated = $request->validated();

        $slug = Str::slug($request->project_title, '-');

        $validated['slug'] = $slug;

        if ($request->has('cover_image')) {

            if ($project->cover_image) {
                Storage::delete($project->cover_image);
            }

            $img_path = Storage::put('uploads', $validated['cover_image']);

            $validated['cover_image'] = $img_path;
        }

        $project->update($validated);

        $project->technologies()->sync($validated['technologies']);

        return to_route('admin.projects.show', compact('project'))->with('message', "Project '$project->project_title' successfully updated!");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {

        if ($project->cover_image) {
            Storage::delete($project->cover_image);
        }

        $project->delete();

        return to_route('admin.projects.index')->with('message', "Project '$project->project_title' successfully deleted!");
    }
}
