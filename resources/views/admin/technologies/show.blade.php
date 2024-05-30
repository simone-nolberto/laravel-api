@extends('layouts.admin')


@section('content')
    <header class="py-3 bg-dark text-white">
        <div class="container d-flex align-items-center justify-content-between">
            <h1>{{ $technology->name }}</h1>
            <a class="btn btn-primary" href="{{ route('admin.technologies.index') }}"><i
                    class="fa-solid fa-arrow-left"></i></a>
        </div>

    </header>


    @include('partials.session-message')


    <div class="container py-5">
        <div class="row row-cols-1 row-cols-md-2 g-4">

            <div class="col">

                <div class="card">

                    <div class="card-body bg-white">
                        <h2 class="card-title"> {{ $technology->name }} </h2>
                        <p class="card-text">
                            {{ $technology->description }}
                        </p>
                    </div>

                    <div class="card-footer d-flex justify-content-between">


                    </div>

                </div>

                <div class="container my-5 d-flex justify-content-between">
                    <a class="btn btn-primary" href="{{ route('admin.technologies.edit', $technology) }}"><i
                            class="fa-solid fa-pen"></i></a>
                    <!-- Modal trigger button -->
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                        data-bs-target="#modalId-{{ $technology->id }}">
                        <i class="fa-solid fa-trash"></i>
                    </button>

                    <!-- Modal Body -->
                    <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
                    <div class="modal fade" id="modalId-{{ $technology->id }}" tabindex="-1" data-bs-backdrop="static"
                        data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId-{{ $technology->id }}"
                        aria-hidden="true">
                        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalTitleId-{{ $technology->id }}">
                                        Attention! Are you sure you want to delete "{{ $technology->name }}" ?
                                    </h5>

                                </div>
                                <div class="modal-body">
                                    Attention! You're deleting this record, operation is irreversible!
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                        <i class="fa-solid fa-xmark"></i>
                                    </button>
                                    <form action="{{ route('admin.technologies.destroy', $technology) }}" method="post">
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
                </div>



            </div>



        </div>
    </div>
@endsection
