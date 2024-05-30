@extends('layouts.admin')


@section('content')
    <header class="py-3 bg-dark text-white">
        <div class="container d-flex justify-content-between align-items-center">
            <h1>Projects</h1>

            <a class="btn btn-primary" href="{{ route('admin.projects.create') }}">Add</a>
        </div>

    </header>


    <div class="container py-5">

        @include('partials.session-message')

        <div class="table-responsive">
            <table class="table table-light border border-2 table-striped table-bordered">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Cover Image</th>
                        <th scope="col">Author</th>
                        <th scope="col">Title</th>
                        <th scope="col">Type</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($projects as $project)
                        <tr class="">
                            <td scope="row">{{ $project->id }}</td>
                            <td>

                                @if (Str::startsWith($project->cover_image, 'https://'))
                                    <img width="140" loading="lazy" src="{{ $project->cover_image }}" alt="">
                                @else
                                    <img width="140" loading="lazy" src="{{ asset('storage/' . $project->cover_image) }}"
                                        alt="">
                                @endif

                            </td>
                            <td>{{ $project->author }}</td>
                            <td>{{ $project->project_title }}</td>
                            <td>{{ $project->type ? $project->type->name : 'untyped' }}</td>
                            <td>

                                <a class="btn btn-dark" href="{{ route('admin.projects.show', $project) }}"><i
                                        class="fa-solid fa-eye"></i></a>

                                <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                    data-bs-target="#modalId-{{ $project->id }}">
                                    <i class="fa-solid fa-trash"></i>
                                </button>

                                <!-- Modal Body -->
                                <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
                                <div class="modal fade" id="modalId-{{ $project->id }}" tabindex="-1"
                                    data-bs-backdrop="static" data-bs-keyboard="false" role="dialog"
                                    aria-labelledby="modalTitleId-{{ $project->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm"
                                        role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="modalTitleId-{{ $project->id }}">
                                                    Attention! Are you sure you want to delete
                                                    "{{ $project->project_title }}" ?
                                                </h5>

                                            </div>
                                            <div class="modal-body">
                                                Attention! You're deleting this record, operation is irreversible!
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                    <i class="fa-solid fa-xmark"></i>

                                                </button>
                                                <form action="{{ route('admin.projects.destroy', $project) }}"
                                                    method="post">
                                                    @csrf

                                                    @method('DELETE')

                                                    <button type="submit" class="btn btn-danger">
                                                        <i class="fa-solid fa-trash"></i>
                                                    </button>

                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </td>

                        </tr>

                    @empty
                    @endforelse

                </tbody>


            </table>
        </div>


    </div>
@endsection
