@extends('layouts.admin')


@section('content')
    <header class="py-3 bg-dark text-white">
        <div class="container">
            <h1>Create a new project</h1>
        </div>

    </header>



    <div class="container py-5">


        @include('partials.validation-message')


        <form action="{{ route('admin.projects.store') }}" method="post" enctype="multipart/form-data">

            @csrf


            <div class="mb-3">
                <label for="author" class="form-label">Author</label>
                <input type="text" class="form-control" name="author" id="author" aria-describedby="authorHelper"
                    placeholder="Your post author" />
                <small id="helpId" class="form-text text-muted">Type the author here</small>

                @error('author')
                    <div class="text-danger py-2">

                        {{ $message }}
                    </div>
                @enderror
            </div>


            <div class="mb-3">
                <label for="project_title" class="form-label">Project Title</label>
                <input type="text" class="form-control" name="project_title" id="project_title"
                    aria-describedby="project_titleHelper" placeholder="Your post project_title" />
                <small id="helpId" class="form-text text-muted">Type the title of the your project</small>

                @error('project_title')
                    <div class="text-danger py-2">

                        {{ $message }}
                    </div>
                @enderror
            </div>



            <div class="mb-3">
                <label for="cover_image" class="form-label">cover_image</label>
                <input type="file" class="form-control" name="cover_image" id="cover_image"
                    aria-describedby="cover_imageHelper" placeholder="Your post cover_image" />
                <small id="helpId" class="form-text text-muted">Add an image here</small>

                @error('cover_image')
                    <div class="text-danger py-2">

                        {{ $message }}
                    </div>
                @enderror
            </div>


            <div class="mb-3">
                <label for="type_id" class="form-label">Type</label>
                <select class="form-select" name="type_id" id="type_id">

                    <option selected disabled>Select one of the following type</option>

                    @foreach ($types as $type)
                        <option value="{{ $type->id }} {{ $type->id == old('type_id') ? 'selected' : '' }}">
                            {{ $type->name }}</option>
                    @endforeach

                </select>

                @error('type_id')
                    <div class="text-danger py-2">

                        {{ $message }}
                    </div>
                @enderror
            </div>


            <div class="d-flex gap-3 my-5">
                @foreach ($technologies as $technology)
                    <div class="form-check">
                        <input name="technologies[]" class="form-check-input" type="checkbox" value="{{ $technology->id }}"
                            id="{{ $technology->id }}" />
                        <label class="form-check-label" for="{{ $technology->id }}"> {{ $technology->name }} </label>
                    </div>
                @endforeach


                @error('technology')
                    <div class="text-danger py-2">

                        {{ $message }}
                    </div>
                @enderror
            </div>


            <div class="mb-3">
                <label for="source_code" class="form-label">Source Code</label>
                <input type="text" class="form-control" name="source_code" id="source_code"
                    aria-describedby="source_codeHelper" placeholder="Your post source_code" />
                <small id="helpId" class="form-text text-muted">Add a link to your GitHub here</small>

                @error('source_code')
                    <div class="text-danger py-2">

                        {{ $message }}
                    </div>
                @enderror
            </div>



            <div class="mb-3">
                <label for="site_link" class="form-label">Site Link</label>
                <input type="text" class="form-control" name="site_link" id="site_link"
                    aria-describedby="site_linkHelper" placeholder="Your post site_link" />
                <small id="helpId" class="form-text text-muted">Add the link to your site here</small>

                @error('site_link')
                    <div class="text-danger py-2">

                        {{ $message }}
                    </div>
                @enderror
            </div>


            <div class="mb-3">
                <label for="description" class="form-label"></label>
                <textarea class="form-control" name="description" id="description" rows="5"></textarea>
                <small id="helpId" class="form-text text-muted">Add a brief description of your project</small>

                @error('description')
                    <div class="text-danger py-2">

                        {{ $message }}
                    </div>
                @enderror
            </div>


            <button type="submit" class="btn btn-primary">
                Invia
            </button>


        </form>


    </div>
@endsection
