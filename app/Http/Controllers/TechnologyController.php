<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTechnologyRequest;
use App\Http\Requests\UpdateTechnologyRequest;
use App\Models\Technology;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TechnologyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $project_technology = DB::table('project_technology')->select()->get();

        return view('admin.technologies.index', compact('project_technology'), ['technologies' => Technology::all()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.technologies.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTechnologyRequest $request)
    {
        // dd($request->all());

        $validated = $request->validated();

        $slug = Str::slug($request->name, '-');

        $validated['slug'] = $slug;

        // dd($validated);

        Technology::create($validated);

        return to_route('admin.technologies.index')->with('message', 'Technology successfully added!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Technology $technology)
    {
        return view('admin.technologies.show', compact('technology'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Technology $technology)
    {
        return view('admin.technologies.edit', compact('technology'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTechnologyRequest $request, Technology $technology)
    {
        // dd($request->all());

        $validated = $request->validated();

        $slug = Str::slug($request->name, '-');

        $validated['slug'] = $slug;

        // dd($validated);

        $technology->update($validated);

        return to_route('admin.technologies.index')->with('message', 'Technology successfully updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Technology $technology)
    {
        $technology->delete();

        return to_route('admin.technologies.index')->with('message', "Technology '$technology->name' successfully deleted!");
    }
}
