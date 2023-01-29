@extends('admin.layouts.master')

@section('page_title', 'Page Create')

@push('admin_style')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.css">
<style>
    #container {
        width: 1000px;
        margin: 20px auto;
    }
    .ck-editor__editable[role="textbox"] {
        /* editing area */
        min-height: 200px;
    }
    .ck-content .image {
        /* block images */
        max-width: 80%;
        margin: 20px auto;
    }
</style>
@endpush


@section('admin_content')
    <div class="row">
        <div class="col-xl">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 text-primary">Page Create Form</h5>
                    <a href="{{ route('page.index') }}" class="btn btn-info"><i class='bx bx-chevrons-left'></i>
                        Index</a>
                </div>
                <div class="card-body">
                    <form action="{{ route('page.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="page_image" class="form-label">Page Image</label>
                            <input type="file" name="page_image" class="form-control dropify" data-default-file="">
                            @error('page_image')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="basic-icon-default-fullname">Page Title</label>
                                    <div class="input-group input-group-merge">
                                        <input type="text" name="page_title"
                                            class="form-control
                                        @error('page_title')
                                            is-invalid
                                        @enderror"
                                            value="{{ old('page_title') }}" placeholder="Enter Page Title">
                                        @error('page_title')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="basic-icon-default-fullname">Page Slug</label>
                                    <div class="input-group input-group-merge">
                                        <input type="text" name="page_slug"
                                            class="form-control
                                        @error('page_slug')
                                            is-invalid
                                        @enderror"
                                            value="{{ old('page_slug') }}" placeholder="Enter Page Slug">
                                        @error('page_slug')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="basic-icon-default-fullname">Meta Title</label>
                                    <div class="input-group input-group-merge">
                                        <input type="text" name="meta_title"
                                            class="form-control
                                        @error('meta_title')
                                            is-invalid
                                        @enderror"
                                            value="{{ old('meta_title') }}" placeholder="Enter Meta Title">
                                        @error('meta_title')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="basic-icon-default-fullname">Meta Keywords</label>
                                    <div class="input-group input-group-merge">
                                        <input type="text" name="meta_keywords"
                                            class="form-control
                                        @error('meta_keywords')
                                            is-invalid
                                        @enderror"
                                            value="{{ old('meta_keywords') }}" placeholder="Enter Meta Keywords">
                                        @error('meta_keywords')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="page_short" class="form-label">Short Description</label>
                                    <textarea name="page_short" id="page_short" cols="30" rows="5" class="form-control"></textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="page_long" class="form-label">Long Description</label>
                                    <textarea name="page_long" id="page_long" cols="30" rows="5" class="form-control"></textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="meta_description" class="form-label">Meta Description</label>
                                    <textarea name="meta_description" id="meta_description" cols="30" rows="5" class="form-control @error('meta_description')
                                        is-invalid
                                    @enderror"></textarea>
                                    @error('meta_description')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Send</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('admin_script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/36.0.0/classic/ckeditor.js"></script>
<script>
    $('.dropify').dropify();
</script>
<script>
    ClassicEditor
    .create( document.querySelector( '#page_short' ) )
    .then( editor => {
            console.log( editor );
    } )
    .catch( error => {
            console.error( error );
    } );

    ClassicEditor
    .create( document.querySelector( '#page_long' ) )
    .then( editor => {
            console.log( editor );
    } )
    .catch( error => {
            console.error( error );
    } );

    ClassicEditor
    .create( document.querySelector( '#meta_description' ) )
    .then( editor => {
            console.log( editor );
    } )
    .catch( error => {
            console.error( error );
    } );
</script>
@endpush
