@extends('admin.layouts.master')

@section('page_title', 'Module Create')

@push('admin_style')
@endpush


@section('admin_content')
    <div class="row">
        <div class="col-xl">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 text-primary">Module Create Form</h5>
                    <a href="{{ route('module.index') }}" class="btn btn-info"><i class='bx bx-chevrons-left'></i> Index</a>
                </div>
                <div class="card-body">
                    <form action="{{ route('module.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label" for="basic-icon-default-fullname">Module Name</label>
                            <div class="input-group input-group-merge">
                                <span id="basic-icon-default-fullname2" class="input-group-text"><i
                                        class='bx bx-devices'></i></span>
                                <input type="text" name="module_name"
                                    class="form-control
                                @error('module_name')
                                    is-invalid
                                @enderror"
                                    value="{{ old('module_name') }}" placeholder="Enter Module Name">
                                @error('module_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
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
@endpush
