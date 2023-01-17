@extends('admin.layouts.master')

@section('page_title', 'Profile Update')

@push('admin_style')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.css">
@endpush


@section('admin_content')
    <div class="row">
        <div class="col-xl">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 text-primary">Profile Update Form</h5>
                    <a href="{{ route('home') }}" class="btn btn-info"><i class='bx bx-chevrons-left'></i> Dashboard</a>
                </div>
                @if ($profile)
                    <div class="card-body">
                        <form action="{{ route('profile.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label" for="basic-icon-default-fullname">User Name</label>
                                        <div class="input-group input-group-merge">
                                            <span id="basic-icon-default-fullname" class="input-group-text"><i
                                                    class='bx bxs-user-detail'></i></span>
                                            <input type="text" name="name"
                                                class="form-control
                                    @error('name')
                                        is-invalid
                                    @enderror"
                                                value="{{ Auth::user()->name }}" placeholder="Enter User Name">
                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label" for="basic-icon-default-fullemail">User Email</label>
                                        <div class="input-group input-group-merge">
                                            <span id="basic-icon-default-fullemail" class="input-group-text"><i
                                                    class='bx bx-envelope'></i></span>
                                            <input type="text" name="Email"
                                                class="form-control
                                    @error('Email')
                                        is-invalid
                                    @enderror"
                                                value="{{ Auth::user()->email }}" placeholder="Enter User Email">
                                            @error('Email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="user_image" class="form-label">Profile Image <span class="text-danger">*</span></label>
                                <input type="file" name="user_image" class="form-control dropify"
                                data-default-file="{{ asset('uploads/users') }}/{{ $profile->user_image }}">
                                {{-- @error('user_image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror --}}
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="division_id" class="form-label">Division <span
                                                class="text-danger">*</span></label>
                                        <select id="division_id" name="division_id"
                                            class="form-select js-example-basic-single">
                                            <option value="1">Select a Division</option>
                                            @foreach ($divisions as $division)
                                                <option
                                                    value="{{ $division->id }}"@if ($division->id == $profile->division_id) selected @endif>
                                                    {{ $division->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                {{-- For District --}}
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="district_id" class="form-label">District <span
                                                class="text-danger">*</span></label>
                                        <select id="district_id" name="district_id"
                                            class="form-control js-example-basic-single" disabled>
                                            <option value="1">Select a district</option>
                                        </select>
                                    </div>
                                </div>
                                {{-- For Thana/Upazila --}}
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="upazila_id" class="form-label">Thana <span
                                                class="text-danger">*</span></label>
                                        <select id="upazila_id" name="upazila_id"
                                            class="form-control js-example-basic-single" disabled>
                                            <option value="1">Select a Thana</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group mt-3">
                                        <label for="address" class="form-label">Address <span
                                                class="text-danger">*</span></label>
                                        <textarea name="address" id="" cols="30" rows="5" class="form-control">{{ $profile->address }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 mt-3">
                                    <label for="" class="form-label me-4">Select Gender <span
                                            class="text-danger">*</span></label>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="gender" id="inlineRadio1"
                                            value="male">
                                        <label class="form-check-label" for="inlineRadio1">Male</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="gender" id="inlineRadio2"
                                            value="female">
                                        <label class="form-check-label" for="inlineRadio2">Female</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="gender" id="inlineRadio3"
                                            value="other">
                                        <label class="form-check-label" for="inlineRadio3">Other</label>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>
                    </div>
                @else
                    <div class="card-body">
                        <form action="{{ route('profile.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label" for="basic-icon-default-fullname">User Name</label>
                                        <div class="input-group input-group-merge">
                                            <span id="basic-icon-default-fullname" class="input-group-text"><i
                                                    class='bx bxs-user-detail'></i></span>
                                            <input type="text" name="name"
                                                class="form-control
                                    @error('name')
                                        is-invalid
                                    @enderror"
                                                value="{{ Auth::user()->name }}" placeholder="Enter User Name">
                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label" for="basic-icon-default-fullemail">User Email</label>
                                        <div class="input-group input-group-merge">
                                            <span id="basic-icon-default-fullemail" class="input-group-text"><i
                                                    class='bx bx-envelope'></i></span>
                                            <input type="text" name="Email"
                                                class="form-control
                                    @error('Email')
                                        is-invalid
                                    @enderror"
                                                value="{{ Auth::user()->email }}" placeholder="Enter User Email">
                                            @error('Email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="user_image" class="form-label">Add Profile Image</label>
                                        <input type="file" name="user_image"
                                            class="form-control dropify @error('user_image')
                                    is-invalid
                                @enderror"
                                            placeholder="Enter Category Title" data-default-file="">
                                        @error('user_image')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="division_id" class="form-label">Division <span
                                                class="text-danger">*</span></label>
                                        <select id="division_id" name="division_id"
                                            class="form-select js-example-basic-single">
                                            <option value="1">Select a Division</option>
                                            @foreach ($divisions as $division)
                                                <option value="{{ $division->id }}">{{ $division->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                {{-- For District --}}
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="district_id" class="form-label">District <span
                                                class="text-danger">*</span></label>
                                        <select id="district_id" name="district_id"
                                            class="form-control js-example-basic-single" disabled>
                                            <option value="1">Select a district</option>
                                        </select>
                                    </div>
                                </div>
                                {{-- For Thana/Upazila --}}
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="upazila_id" class="form-label">Thana <span
                                                class="text-danger">*</span></label>
                                        <select id="upazila_id" name="upazila_id"
                                            class="form-control js-example-basic-single" disabled>
                                            <option value="1">Select a Thana</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group mt-3">
                                        <label for="address" class="form-label">Address <span
                                                class="text-danger">*</span></label>
                                        <textarea name="address" id="" cols="30" rows="5" class="form-control"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 mt-3">
                                    <label for="" class="form-label me-4">Select Gender <span
                                            class="text-danger">*</span></label>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="gender" id="inlineRadio1"
                                            value="male">
                                        <label class="form-check-label" for="inlineRadio1">Male</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="gender" id="inlineRadio2"
                                            value="female">
                                        <label class="form-check-label" for="inlineRadio2">Female</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="gender" id="inlineRadio3"
                                            value="other">
                                        <label class="form-check-label" for="inlineRadio3">Other</label>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>
                    </div>
                @endif
            </div>
        </div>
    </div>

    @php
        if ($profile) {
            $profile_exist = 1;
        } else {
            $profile_exist = 0;
        }
    @endphp
@endsection
@push('admin_script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.2.2/axios.min.js"
        integrity="sha512-QTnb9BQkG4fBYIt9JGvYmxPpd6TBeKp6lsUrtiVQsrJ9sb33Bn9s0wMQO9qVBFbPX3xHRAsBHvXlcsrnJjExjg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $('.dropify').dropify();
    </script>
    <script>
        // For Create
        // To Get District Data
        const getDistricts = (division_id, selected = null) => {
            axios.get(`${window.location.origin}/get-districts/${division_id}`).then(res => {
                let districts = res.data
                let element = $('#district_id')
                let upazila_element = $('#upazila_id').empty().append(`<option>Select a Thana</option>`).attr(
                    'disabled', 'disabled')
                element.removeAttr('disabled')
                element.empty()
                element.append(`<option>Select a District</option>`)
                districts.map((district, index) => {
                    // console.log(district)
                    element.append(
                        `<option value="${district.id}" ${selected == district.id ?'selected' : ''}>${district.name}</option>`
                        )
                })
            })
        }

        $('#division_id').on('change', function() {
            getDistricts($(this).val())
        })

        // To Get Thana/Upazila Data
        const getUpazilas = (district_id, selected = null) => {
            axios.get(`${window.location.origin}/get-upazilas/${district_id}`).then(res => {
                let upazilas = res.data
                let element = $('#upazila_id')
                element.removeAttr('disabled')
                element.empty()
                element.append(`<option>Select a Thana</option>`)
                upazilas.map((upazila, index) => {
                    // console.log(district)
                    element.append(
                        `<option value="${upazila.id}" ${selected == upazila.id ?'selected' : ''}>${upazila.name}</option>`
                        )
                })
            })
        }

        $('#district_id').on('change', function() {
            getUpazilas($(this).val())
        })
        // End Create

        //For Update, Create + add the code below
        if ('{{ $profile_exist }}' == 1) {
            getDistricts('{{ $profile?->division_id }}', '{{ $profile?->district_id }}')
            getUpazilas('{{ $profile?->district_id }}', '{{ $profile?->upazila_id }}')
        }
        // End Update
    </script>
@endpush
