@extends('admin.layouts.master')

@section('page_title', 'Mail Setting')

@push('admin_style')
@endpush

@section('admin_content')
    <div class="row">
        <div class="col-xl">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 text-primary">Mail Setting Form</h5>
                    <a href="{{ route('home') }}" class="btn btn-info"><i class='bx bx-chevrons-left'></i>
                        Dashboard</a>
                </div>
                <div class="card-body">
                    <form action="{{ route('settings.mail.update') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label" for="mail_mailer">Mail Mailer </label>
                            <div class="input-group input-group-merge">
                                <input type="text" name="mail_mailer"
                                    class="form-control
                                @error('mail_mailer')
                                    is-invalid
                                @enderror"
                                    value="{{ setting('mail_mailer') }}" placeholder="Mail Mailer">
                                @error('mail_mailer')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="mail_host">Mail Host </label>
                            <div class="input-group input-group-merge">
                                <input type="text" name="mail_host"
                                    class="form-control
                                @error('mail_host')
                                    is-invalid
                                @enderror"
                                    value="{{ setting('mail_host') }}" placeholder="Mail Host">
                                @error('mail_host')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="mail_port">Mail Port </label>
                            <div class="input-group input-group-merge">
                                <input type="phone" name="mail_port"
                                    class="form-control
                                @error('mail_port')
                                    is-invalid
                                @enderror"
                                    value="{{ setting('mail_port') }}" placeholder="Mail Port Number">
                                @error('mail_port')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="mail_username">Mail UserName</label>
                            <div class="input-group input-group-merge">
                                <input type="text" name="mail_username"
                                    class="form-control
                                @error('mail_username')
                                    is-invalid
                                @enderror"
                                    value="{{ setting('mail_username') }}" placeholder="Mail UserName">
                                @error('mail_username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="mail_password">Mail Password</label>
                            <div class="input-group input-group-merge">
                                <input type="text" name="mail_password"
                                    class="form-control
                                @error('mail_password')
                                    is-invalid
                                @enderror"
                                    value="{{ setting('mail_password') }}" placeholder="Mail Password">
                                @error('mail_password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="mail_encryption">Mail_Encryption</label>
                            <div class="input-group input-group-merge">
                                <input type="text" name="mail_encryption"
                                    class="form-control
                                @error('mail_encryption')
                                    is-invalid
                                @enderror"
                                    value="{{ setting('mail_encryption') }}" placeholder="Mail_Encryption">
                                @error('mail_encryption')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="mail_from_address">Mail From Address</label>
                            <div class="input-group input-group-merge">
                                <input type="text" name="mail_from_address"
                                    class="form-control
                                @error('mail_from_address')
                                    is-invalid
                                @enderror"
                                    value="{{ setting('mail_from_address') }}" placeholder=">Mail From Address">
                                @error('mail_from_address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        @can('mail-setting-update')
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
