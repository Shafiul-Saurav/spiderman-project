@extends('admin.layouts.master')

@section('page_title', 'User Edit')

@push('admin_style')
@endpush


@section('admin_content')
    <div class="row">
        <div class="col-xl">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 text-primary">User Edit Form</h5>
                    @can('index-user')
                    <a href="{{ route('users.index') }}" class="btn btn-info"><i class='bx bx-chevrons-left'></i>
                        Index</a>
                    @endcan
                </div>
                <div class="card-body">
                    <form action="{{ route('users.update', $user->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="role_id" class="form-label">Select Role</label>
                            <select id="defaultSelect" name="role_id"
                                class="form-select
                            @error('role_id')
                                is-invalid
                            @enderror">
                                @forelse ($roles as $role)
                                    <option value="{{ $role->id }}"
                                    @if ($user->role_id == $role->id)
                                        selected
                                    @endif>{{ $role->role_name }}</option>
                                @empty
                                @endforelse
                            </select>
                            @error('role_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="basic-icon-default-fullname">User Name</label>
                            <div class="input-group input-group-merge">
                                <span id="basic-icon-default-fullname2" class="input-group-text"><i
                                        class='bx bxs-user-detail'></i></span>
                                <input type="text" name="name"
                                    class="form-control
                                @error('name')
                                    is-invalid
                                @enderror"
                                    value="{{ $user->name }}" placeholder="Enter User Name">
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="basic-icon-default-email">User Email</label>
                            <div class="input-group input-group-merge">
                                <span id="basic-icon-default-email" class="input-group-text"><i
                                        class='bx bx-envelope'></i></span>
                                <input type="text" name="email"
                                    class="form-control
                                @error('email')
                                    is-invalid
                                @enderror"
                                    value="{{ $user->email }}" placeholder="Enter User Email">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-password-toggle mb-3">
                            <label class="form-label" for="basic-default-password">Password</label>
                            <div class="input-group input-group-merge">
                                <span id="basic-default-password" class="input-group-text"><i
                                    class='bx bx-lock-alt'></i></span>
                                <input type="password" name="password" class="form-control @error('password')
                                    is-invalid
                                @enderror" id="basic-default-password"
                                    placeholder=" ············" aria-describedby="basic-default-password">
                                <span class="input-group-text cursor-pointer" id="basic-default-password"><i
                                        class="bx bx-hide"></i></span>
                                @error('password')
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
