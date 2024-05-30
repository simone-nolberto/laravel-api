@extends('layouts.admin')


@section('content')
    <header class="py-3 bg-dark text-white">
        <div class="container">
            <h1>Update selected type: {{ $type->name }}</h1>
        </div>

    </header>



    <div class="container py-5">


        @include('partials.validation-message')


        <form action="{{ route('admin.types.update', $type) }}" method="post" enctype="multipart/form-data">

            @csrf
            @method('PUT')


            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" name="name" id="name" aria-describedby="nameHelper"
                    placeholder="Your type name" value="{{ $type->name }}" />
                <small id="helpId" class="form-text text-muted">Type the name here</small>

                @error('name')
                    <div class="text-danger py-2">

                        {{ $message }}
                    </div>
                @enderror
            </div>


            <button type="submit" class="btn btn-primary">
                Update
            </button>


        </form>


    </div>
@endsection
