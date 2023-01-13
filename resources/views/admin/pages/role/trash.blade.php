@extends('admin.layouts.master')

@section('page_title', 'Role Index')

@push('admin_style')
    @include('admin.pages.common.index_style')
@endpush

@section('admin_content')
    <div class="row">
        <div class="col-md-12">
            <div class="card p-4">
                <div class="d-flex justify-content-between align-items-center py-3">
                    <h5 class="card-header px-0 text-primary">Role Index / List Page</h5>
                    <a href="{{ route('role.index') }}" class="btn btn-info"><i class='bx bx-chevrons-left'></i> Index</a>
                </div>
                <div class="table-responsive text-nowrap">
                    <table id="dataTable" class="table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Last Updated</th>
                                <th>Role Name</th>
                                <th>Permissions</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @forelse ($roles as $role)
                                <tr>
                                    <td>
                                        <strong>{{ $roles->firstItem() + $loop->index }}</strong>
                                    </td>
                                    <td>{{ $role->updated_at->format('d-M-Y') }}</td>
                                    <td>{{ $role->role_name }}</td>
                                    <td>
                                        @foreach ($role->permissions->chunk(3) as $key => $chunks)
                                        <div class="row">
                                            <div class="col">
                                                @foreach ($chunks as $permission)
                                                    <span class="badge bg-info">{{ $permission->permission_slug }}</span>
                                                @endforeach
                                            </div>
                                        </div>
                                        @endforeach
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                data-bs-toggle="dropdown">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item"
                                                    href="{{ route('role.restore', ['role_slug' => $role->role_slug]) }}"><i
                                                        class="bx bx-edit-alt me-1"></i>
                                                    Restore</a>
                                                <form action="{{ route('role.forcedelete', ['role_slug' => $role->role_slug]) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="dropdown-item show_confirm"><i class="bx bx-trash me-1"></i> Force Delete</a></button>
                                                </form>
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
