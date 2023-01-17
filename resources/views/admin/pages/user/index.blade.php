@extends('admin.layouts.master')

@section('page_title', 'User Index')

@push('admin_style')
    @include('admin.pages.common.index_style')
@endpush

@section('admin_content')
    <div class="row">
        <div class="col-md-12">
            <div class="card p-4">
                <div class="d-flex justify-content-between align-items-center py-3">
                    <h5 class="card-header px-0 text-primary">User Index / List Page</h5>
                    <div>
                        @can('create-user')
                            <a href="{{ route('users.trash') }}" class="btn btn-outline-primary"><i
                                    class='bx bx-trash mb-1'></i>
                                View Trash</a>
                        @endcan
                        @can('create-user')
                            <a href="{{ route('users.create') }}" class="btn btn-primary"><i
                                    class='bx bx-plus-circle mb-1'></i> Add New</a>
                        @endcan
                    </div>
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
                                <th>User Status</th>
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
                                        <div class="form-check form-switch mb-2">
                                            <input class="form-check-input toggle-class" type="checkbox" id="{{ $user->id }}"
                                            {{ $user->is_active ? 'checked' : ''}} data-id="{{ $user->id }}">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                data-bs-toggle="dropdown">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                @can('edit-user')
                                                    <a class="dropdown-item"
                                                        href="{{ route('users.edit', $user->id) }}"><i
                                                            class="bx bx-edit-alt me-1"></i>
                                                        Edit</a>
                                                @endcan
                                                @can('delete-user')
                                                    <form
                                                        action="{{ route('users.destroy', $user->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="dropdown-item show_confirm"><i
                                                                class="bx bx-trash me-1"></i> Delete</a></button>
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
    <script>
        $(document).ready(function() {
            $('.toggle-class').change(function() {
                var is_active = $(this).prop('checked') == true ? 1 : 0 ;
                var item_id = $(this).data('id');

                // console.log(is_active, item_id); for debug purpose
                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: '/admin/check/user/is_active/'+item_id,
                    success: function(response){
                        console.log(response);
                        Swal.fire({
                            title: `${ response.message}`,
                            text: `${ response.message }`,
                            icon: `${response.type}`,
                        })
                    },
                    error: function(err){
                        if(err){
                            console.log(err);
                        }
                    }
                });
            });
        });
    </script>
@endpush
