@extends('admin.layouts.master')

@section('page_title', 'Permission Edit')

@push('admin_style')
@endpush


@section('admin_content')
    <div class="row">
        <div class="col-xl">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 text-primary">Permission Edit Form</h5>
                    <a href="{{ route('permission.index') }}" class="btn btn-info"><i class='bx bx-chevrons-left'></i>
                        Index</a>
                </div>
                <div class="card-body">
                    <form action="{{ route('permission.update', $permission->permission_slug) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="module_id" class="form-label">Select Module</label>
                            <select id="defaultSelect" name="module_id"
                                class="form-select
                            @error('module_id')
                                is-invalid
                            @enderror">
                                <option selected>Choose a module</option>
                                @forelse ($modules as $module)
                                    <option value="{{ $module->id }}"
                                    @if ($permission->module_id == $module->id)
                                        selected
                                    @endif>{{ $module->module_name }}</option>
                                @empty
                                @endforelse
                            </select>
                            @error('module_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="basic-icon-default-fullname">Permission Name</label>
                            <div class="input-group input-group-merge">
                                <span id="basic-icon-default-fullname2" class="input-group-text"><i
                                        class='bx bx-lock-open-alt'></i></span>
                                <input type="text" name="permission_name"
                                    class="form-control
                                @error('permission_name')
                                    is-invalid
                                @enderror"
                                    value="{{ $permission->permission_name }}" placeholder="Enter Permission Name">
                                @error('permission_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('admin_script')
@endpush
