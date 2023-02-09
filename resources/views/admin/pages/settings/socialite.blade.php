@extends('admin.layouts.master')

@section('page_title', 'Socialite Setting')

@push('admin_style')
@endpush

@section('admin_content')
    <div class="row">
        <div class="col-xl">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 text-primary">Socialite Setting Form</h5>
                    <a href="{{ route('home') }}" class="btn btn-info"><i class='bx bx-chevrons-left'></i>
                        Dashboard</a>
                </div>
                <div class="card-body">
                    <form action="{{ route('settings.socialite.update') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label" for="git_client_id">GITHUB Client ID </label>
                            <div class="input-group input-group-merge">
                                <input type="text" name="git_client_id"
                                    class="form-control
                                @error('git_client_id')
                                    is-invalid
                                @enderror"
                                    value="{{ setting('git_client_id') }}" placeholder="GITHUB Client ID">
                                @error('git_client_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="git_client_secret">GITHUB Client Secret </label>
                            <div class="input-group input-group-merge">
                                <input type="text" name="git_client_secret"
                                    class="form-control
                                @error('git_client_secret')
                                    is-invalid
                                @enderror"
                                    value="{{ setting('git_client_secret') }}" placeholder="GITHUB Client Secret">
                                @error('git_client_secret')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="git_client_redirect_url">GITHUB Client Redirect URL</label>
                            <div class="input-group input-group-merge">
                                <input type="phone" name="git_client_redirect_url"
                                    class="form-control
                                @error('git_client_redirect_url')
                                    is-invalid
                                @enderror"
                                    value="{{ setting('git_client_redirect_url') }}" placeholder="GITHUB Client Redirect URL">
                                @error('git_client_redirect_url')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="google_client_id">GOOGLE Client ID </label>
                            <div class="input-group input-group-merge">
                                <input type="text" name="google_client_id"
                                    class="form-control
                                @error('google_client_id')
                                    is-invalid
                                @enderror"
                                    value="{{ setting('google_client_id') }}" placeholder="GOOGLE Client ID">
                                @error('google_client_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="google_client_secret">GOOGLE Client Secret </label>
                            <div class="input-group input-group-merge">
                                <input type="text" name="google_client_secret"
                                    class="form-control
                                @error('google_client_secret')
                                    is-invalid
                                @enderror"
                                    value="{{ setting('google_client_secret') }}" placeholder="GOOGLE Client Secret">
                                @error('google_client_secret')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="google_client_redirect_url">GOOGLE Client Redirect URL</label>
                            <div class="input-group input-group-merge">
                                <input type="phone" name="google_client_redirect_url"
                                    class="form-control
                                @error('google_client_redirect_url')
                                    is-invalid
                                @enderror"
                                    value="{{ setting('google_client_redirect_url') }}" placeholder="GOOGLE Client Redirect URL">
                                @error('google_client_redirect_url')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        @can('socialite-setting-update')
                        <button type="submit" class="btn btn-primary">Send</button>
                        @endcan
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('admin_script')
@endpush
