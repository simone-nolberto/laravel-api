@extends('layouts.admin')


@section('content')
    <header class="py-3 bg-dark text-white">
        <div class="container d-flex justify-content-between align-items-center">
            <h1>Types</h1>
        </div>

    </header>


    <div class="container py-5">

        @include('partials.session-message')

        <div class="row">
            <div class="col">
                <h3>Add a type here</h3>
                <form action="{{ route('admin.types.store') }}" method="post" enctype="multipart/form-data">

                    @csrf


                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" name="name" id="name"
                            aria-describedby="nameHelper" placeholder="Your type name" />
                        <small id="helpId" class="form-text text-muted">Type the name here</small>

                        @error('name')
                            <div class="text-danger py-2">

                                {{ $message }}
                            </div>
                        @enderror
                    </div>


                    <button type="submit" class="btn btn-primary">
                        Add
                    </button>


                </form>
            </div>
            <div class="col">
                <div class="table-responsive">
                    <table class="table table-light border border-2 table-striped table-bordered text-center">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Name</th>
                                <th scope="col">Slug</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($types as $type)
                                <tr class="">
                                    <td scope="row">{{ $type->id }}</td>

                                    <td>
                                        <form action="{{ route('admin.types.update', $type) }}" method="post"
                                            enctype="multipart/form-data">

                                            @csrf
                                            @method('PUT')


                                            <div class="mb-3">
                                                {{-- <label for="name" class="form-label">Name</label> --}}
                                                <input type="text" class="form-control" name="name" id="name"
                                                    aria-describedby="nameHelper" placeholder="Your type name"
                                                    value="{{ $type->name }}" />


                                                @error('name')
                                                    <div class="text-danger py-2">

                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>


                                        </form>
                                    </td>
                                    <td>{{ $type->slug }}</td>
                                    <td>

                                        <a class="btn btn-dark" href="{{ route('admin.types.show', $type) }}"><i
                                                class="fa-solid fa-eye"></i></a>

                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                            data-bs-target="#modalId-{{ $type->id }}">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>

                                        <!-- Modal Body -->
                                        <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
                                        <div class="modal fade" id="modalId-{{ $type->id }}" tabindex="-1"
                                            data-bs-backdrop="static" data-bs-keyboard="false" role="dialog"
                                            aria-labelledby="modalTitleId-{{ $type->id }}" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm"
                                                role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="modalTitleId-{{ $type->id }}">
                                                            Attention! Are you sure you want to delete
                                                            "{{ $type->name }}" ?
                                                        </h5>

                                                    </div>
                                                    <div class="modal-body">
                                                        Attention! You're deleting this record, operation is irreversible!
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">
                                                            <i class="fa-solid fa-xmark"></i>

                                                        </button>
                                                        <form action="{{ route('admin.types.destroy', $type) }}"
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

        </div>



    </div>
@endsection
