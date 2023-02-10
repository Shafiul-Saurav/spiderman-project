@extends('admin.layouts.master')

@section('page_title', 'Dashboard')

@push('admin_style')
    @include('admin.pages.common.index_style')
@endpush


@section('admin_content')
    <h1>Welcome To Advance Laravel Dashboard</h1>
    <div class="row">
        <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="card-title d-flex align-items-start justify-content-between">
                        <div class="avatar flex-shrink-0">
                            <img src="{{ asset('admin') }}/assets/img/icons/unicons/chart-success.png" alt="chart success"
                                class="rounded">
                        </div>
                        <div class="dropdown">
                            <button class="btn p-0" type="button" id="cardOpt3" data-bs-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <i class="bx bx-dots-vertical-rounded"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3">
                                <a class="dropdown-item" href="javascript:void(0);">View More</a>
                                <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                            </div>
                        </div>
                    </div>
                    <span class="fw-semibold d-block mb-1">User Count</span>
                    <h3 class="card-title mb-2">{{ $user_count }}</h3>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="card-title d-flex align-items-start justify-content-between">
                        <div class="avatar flex-shrink-0">
                            <img src="{{ asset('admin') }}/assets/img/icons/unicons/cc-primary.png" alt="Credit Card"
                                class="rounded">
                        </div>
                        <div class="dropdown">
                            <button class="btn p-0" type="button" id="cardOpt3" data-bs-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <i class="bx bx-dots-vertical-rounded"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3">
                                <a class="dropdown-item" href="javascript:void(0);">View More</a>
                                <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                            </div>
                        </div>
                    </div>
                    <span class="fw-semibold d-block mb-1">Role Count</span>
                    <h3 class="card-title mb-2">{{ $role_count }}</h3>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="card-title d-flex align-items-start justify-content-between">
                        <div class="avatar flex-shrink-0">
                            <img src="{{ asset('admin') }}/assets/img/icons/unicons/wallet-info.png" alt="Credit Card"
                                class="rounded">
                        </div>
                        <div class="dropdown">
                            <button class="btn p-0" type="button" id="cardOpt3" data-bs-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <i class="bx bx-dots-vertical-rounded"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3">
                                <a class="dropdown-item" href="javascript:void(0);">View More</a>
                                <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                            </div>
                        </div>
                    </div>
                    <span class="fw-semibold d-block mb-1">Module Count</span>
                    <h3 class="card-title mb-2">{{ $module_count }}</h3>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="card-title d-flex align-items-start justify-content-between">
                        <div class="avatar flex-shrink-0">
                            <img src="{{ asset('admin') }}/assets/img/icons/unicons/paypal.png" alt="Credit Card"
                                class="rounded">
                        </div>
                        <div class="dropdown">
                            <button class="btn p-0" type="button" id="cardOpt3" data-bs-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <i class="bx bx-dots-vertical-rounded"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3">
                                <a class="dropdown-item" href="javascript:void(0);">View More</a>
                                <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                            </div>
                        </div>
                    </div>
                    <span class="fw-semibold d-block mb-1">Permission Count</span>
                    <h3 class="card-title mb-2">{{ $permission_count }}</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="table-responsive text-nowrap p-3">
            <table id="dataTable" class="table table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Last Updated</th>
                        <th>Profile</th>
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
                            <td>
                                @if ($user->profile)
                                    <img src="{{ asset('uploads/users') }}/{{ $user->profile->user_image }}" alt
                                            class="w-px-40 h-auto rounded-circle" />
                                @else
                                    <img src="{{ asset('uploads/users/default_user.jpg') }}" alt
                                            class="w-px-40 h-auto rounded-circle" />
                                @endif

                            </td>
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
                                            @if ($user->email != 'shafi@gmail.com')
                                            <form
                                                action="{{ route('users.destroy', $user->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="dropdown-item show_confirm"><i
                                                        class="bx bx-trash me-1"></i> Delete</a></button>
                                            </form>
                                            @endif

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
