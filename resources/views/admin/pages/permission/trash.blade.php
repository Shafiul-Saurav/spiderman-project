@extends('admin.layouts.master')

@section('page_title', 'Permission Index')

@push('admin_style')
    @include('admin.pages.common.index_style')
@endpush

@section('admin_content')
    <div class="row">
        <div class="col-md-12">
            <div class="card p-4">
                <div class="d-flex justify-content-between align-items-center py-3">
                    <h5 class="card-header px-0 text-primary">Permission Index / List Page</h5>
                    <a href="{{ route('permission.index') }}" class="btn btn-info"><i class='bx bx-chevrons-left'></i>
                        Index</a>
                </div>
                <div class="table-responsive text-nowrap">
                    <table id="dataTable" class="table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Last Updated</th>
                                <th>Module Name</th>
                                <th>Permission Name</th>
                                <th>Permission Slug</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @forelse ($permissions as $permission)
                                <tr>
                                    <td>
                                        <strong>{{ $permissions->firstItem() + $loop->index }}</strong>
                                    </td>
                                    <td>{{ $permission->updated_at->format('d-M-Y') }}</td>
                                    <td>{{ $permission->module->module_name }}</td>
                                    <td>{{ $permission->permission_name }}</td>
                                    <td>{{ $permission->permission_slug }}</td>
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                data-bs-toggle="dropdown">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                @can('delete-permission')
                                                    <a class="dropdown-item"
                                                        href="{{ route('permission.restore', ['permission_slug' => $permission->permission_slug]) }}"><i
                                                            class='bx bxs-direction-left me-1'></i> Restore</a>
                                                @endcan
                                                @can('delete-permission')
                                                    <form
                                                        action="{{ route('permission.forcedelete', ['permission_slug' => $permission->permission_slug]) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="dropdown-item show_confirm"><i
                                                                class="bx bx-trash me-1"></i> Force Delete</a></button>
                                                    </form>
                                                @endcan


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

@push('admin_script')
    @include('admin.pages.common.index_script')
@endpush
