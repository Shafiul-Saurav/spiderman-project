@extends('admin.layouts.master')

@section('page_title', 'General Setting')

@push('admin_style')
@endpush

@section('admin_content')
    <div class="row">
        <div class="col-xl">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 text-primary">General Setting Form</h5>
                    <a href="{{ route('home') }}" class="btn btn-info"><i class='bx bx-chevrons-left'></i>
                        Dashboard</a>
                </div>
                <div class="card-body">
                    <form action="{{ route('settings.general.update') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label" for="site_title">Site Title </label>
                            <div class="input-group input-group-merge">
                                <input type="text" name="site_title"
                                    class="form-control
                                @error('site_title')
                                    is-invalid
                                @enderror"
                                    value="{{ setting('site_title') }}" placeholder="Site Title">
                                @error('site_title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="site_address">Site Address </label>
                            <div class="input-group input-group-merge">
                                <input type="text" name="site_address"
                                    class="form-control
                                @error('site_address')
                                    is-invalid
                                @enderror"
                                    value="{{ setting('site_address') }}" placeholder="Site Address">
                                @error('site_address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="site_phone">Site Phone </label>
                            <div class="input-group input-group-merge">
                                <input type="phone" name="site_phone"
                                    class="form-control
                                @error('site_phone')
                                    is-invalid
                                @enderror"
                                    value="{{ setting('site_phone') }}" placeholder="Site Phone">
                                @error('site_phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="site_facebook_link">Site Facebook Link (<i class='bx bxl-facebook'></i>)</label>
                            <div class="input-group input-group-merge">
                                <input type="text" name="site_facebook_link"
                                    class="form-control
                                @error('site_facebook_link')
                                    is-invalid
                                @enderror"
                                    value="{{ setting('site_facebook_link') }}" placeholder="Site Facebook Link">
                                @error('site_facebook_link')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="site_twitter_link">Site Twitter Link (<i class='bx bxl-twitter'></i>)</label>
                            <div class="input-group input-group-merge">
                                <input type="text" name="site_twitter_link"
                                    class="form-control
                                @error('site_twitter_link')
                                    is-invalid
                                @enderror"
                                    value="{{ setting('site_twitter_link') }}" placeholder="Site Twitter Link">
                                @error('site_twitter_link')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="site_linkedin_link">Site LinkedIn Link (<i class='bx bxl-linkedin'></i>)</label>
                            <div class="input-group input-group-merge">
                                <input type="text" name="site_linkedin_link"
                                    class="form-control
                                @error('site_linkedin_link')
                                    is-invalid
                                @enderror"
                                    value="{{ setting('site_linkedin_link') }}" placeholder="Site LinkedIn Link">
                                @error('site_linkedin_link')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="site_github_link">Site GitHub Link (<i class='bx bxl-github'></i>)</label>
                            <div class="input-group input-group-merge">
                                <input type="text" name="site_github_link"
                                    class="form-control
                                @error('site_github_link')
                                    is-invalid
                                @enderror"
                                    value="{{ setting('site_github_link') }}" placeholder="Site GitHub Link">
                                @error('site_github_link')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="site_description">Site Description </label>
                            <div class="input-group input-group-merge">
                                <textarea name="site_description" class="form-control
                                @error('site_address')
                                    is-invalid
                                @enderror" id="site_description" cols="30" rows="5">{{ setting('site_description') }}</textarea>
                                @error('site_description')
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
