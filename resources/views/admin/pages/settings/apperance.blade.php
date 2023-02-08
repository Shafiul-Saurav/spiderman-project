@extends('admin.layouts.master')

@section('page_title', 'Apperance Setting')

@push('admin_style')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.css">
@endpush

@section('admin_content')
    <div class="row">
        <div class="col-xl">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 text-primary">Apperance Setting Form</h5>
                    <a href="{{ route('home') }}" class="btn btn-info"><i class='bx bx-chevrons-left'></i>
                        Dashboard</a>
                </div>
                <div class="card-body">
                    <form action="{{ route('settings.apperance.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label" for="bg_color">Background Color </label>
                            <div class="input-group input-group-merge">
                                <input type="text" name="bg_color"
                                    class="form-control
                                @error('bg_color')
                                    is-invalid
                                @enderror"
                                    value="{{ setting('bg_color') }}" placeholder="Site Title">
                                @error('bg_color')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="logo_image" class="form-label">Upload Logo </label>
                            <input type="file" name="logo_image" class="form-control dropify"
                            data-default-file="{{ setting('logo_image') != null ? Storage::url(setting('logo_image')) : ''}}">
                            @error('logo_image')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="favicon_image" class="form-label">Upload Favicon (SIZE:33 x 33) </label>
                            <input type="file" name="favicon_image" class="form-control dropify"
                            data-default-file="{{ setting('favicon_image') != null ? Storage::url(setting('favicon_image')) : ''}}">
                            @error('favicon_image')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        @can('appearance-setting-update')
                        <button type="submit" class="btn btn-primary">Send</button>
                        @endcan
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('admin_script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
<script>
    $('.dropify').dropify({
        messages: {
            'default': 'Drag Your Image',
        }
    });

</script>
@endpush
