@extends('admin.layouts.master')

@section('page_title', 'Role Edit')

@push('admin_style')
@endpush


@section('admin_content')
    <div class="row">
        <div class="col-xl">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 text-primary">Role Edit Form</h5>
                    <a href="{{ route('role.index') }}" class="btn btn-info"><i class='bx bx-chevrons-left'></i> Index</a>
                </div>
                <div class="card-body">
                    <form action="{{ route('role.update', $role->role_slug) }}" method="POST">
                        @csrf
                        @method('PUT')
                        {{-- <div class="mb-3">
                            <label class="form-label" for="basic-icon-default-fullname">Role Name</label>
                            <div class="input-group input-group-merge">
                                <span id="basic-icon-default-fullname2" class="input-group-text"><i
                                        class='bx bx-user-plus'></i></span>
                                <input type="text" name="role_name"
                                    class="form-control
                                @error('role_name')
                                    is-invalid
                                @enderror"
                                    value="{{ $role->role_name }}" placeholder="Enter Role Name" disabled>
                                @error('role_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="basic-icon-default-fullname">Role Note</label>
                            <div class="input-group input-group-merge">
                                <span id="basic-icon-default-fullname2" class="input-group-text"><i
                                        class='bx bx-note'></i></span>
                                <input type="text" name="role_note"
                                    class="form-control
                                @error('role_note')
                                    is-invalid
                                @enderror"
                                    value="{{ $role->role_note }}" placeholder="Enter Role Note" disabled>
                                @error('role_note')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div> --}}
                        <div class="my-3">
                            <strong class="@error('permissions') is-invalid

                            @enderror">Manage Permission for role</strong>
                            @error('permissions')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>
                        <div class="mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="select-all">
                                <label class="form-check-label" for="select-all"> Select All </label>
                            </div>
                        </div>
                        <div class="mb-3">
                            @foreach ($modules->chunk(3) as $key => $chunks)
                                <div class="row">
                                    @foreach ($chunks as $module)
                                        <div class="col-lg-4 col-sm-6 mb-3">
                                            <h5 class="text-primary">Module: {{ $module->module_name }}</h5>
                                            <div class="mb-3">
                                                @foreach ($module->permissions as $permission)
                                                    <div class="form-check">
                                                        <input class="form-check-input" name="permissions[]" type="checkbox"
                                                            value="{{ $permission->id }}"
                                                            id="{{ $permission->id }}"
                                                            @if (isset($role))
                                                                @foreach ($role->permissions as $rPermission)
                                                                    {{ $rPermission->id == $permission->id ? 'checked' : ''}}
                                                                @endforeach
                                                            @endif>
                                                        <label class="form-check-label"
                                                            for="{{ $permission->id }}">
                                                            {{ $permission->permission_name }} </label>
                                                    </div>
                                                @endforeach </label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endforeach
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('admin_script')
<script>
    //Listern for click on select all checkbox
    $('#select-all').click(function(event){
        if(this.checked){
            //Loop each checkbox
            $(':checkbox').each(function(){
                this.checked = true;
            })
        }else{
            //Loop each checkbox
            $(':checkbox').each(function(){
                this.checked = false;
            })
        }
    });
</script>
@endpush
