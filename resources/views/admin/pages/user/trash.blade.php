@extends('admin.layouts.master')

@section('page_title', 'User Trash')

@push('admin_style')
    @include('admin.pages.common.index_style')
@endpush

@section('admin_content')
    <div class="row">
        <div class="col-md-12">
            <div class="card p-4">
                <div class="d-flex justify-content-between align-items-center py-3">
                    <h5 class="card-header px-0 text-primary">User Trash / List Page</h5>
                    @can('index-user')
                        <a href="{{ route('users.index') }}" class="btn btn-info"><i class='bx bx-chevrons-left'></i>
                            Index</a>
                    @endcan

                </div>
                <div class="table-responsive text-nowrap">
                    <table id="dataTable" class="table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Last Updated</th>
                                <th>Role Name</th>
                                <th>User Name</th>
                                <th>User Email</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @forelse ($users as $user)
                                <tr>
                                    <td>
                                        <strong>{{ $users->firstItem() + $loop->index }}</strong>
                                    </td>
                                    <td>{{ $user->updated_at->format('d-M-Y') }}</td>
                                    <td>{{ $user->role->role_name }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                data-bs-toggle="dropdown">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                @can('edit-user')
                                                    <a class="dropdown-item"
                                                        href="{{ route('users.restore', ['id' => $user->id]) }}"><i
                                                            class='bx bxs-direction-left me-1'></i>
                                                        Restore</a>
                                                @endcan
                                                @can('delete-user')
                                                    <form action="{{ route('users.forcedelete', ['id' => $user->id]) }}"
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
