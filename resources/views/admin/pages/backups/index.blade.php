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
                    <h5 class="card-header">Backups Index / List Page</h5>
                    @can('create-backup')
                        <button type="button" class="btn btn-primary me-4" onclick="event.preventDefault();
                        document.getElementById('new-backup-form').submit();">Create Backup</button>
                        <form action="{{ route('backup.store') }}" method="POST"
                        class="d-none" id="new-backup-form">
                            @csrf
                        </form>
                    @endcan

                </div>
                <div class="table-responsive text-nowrap">
                    <table id="dataTable" class="table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Last Updated</th>
                                <th>File Name</th>
                                <th>File Size</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @forelse ($backups as $backup)
                                <tr>
                                    <td>
                                        <strong>{{ $loop->index+1 }}</strong>
                                    </td>
                                    <td>{{ $backup['created_at'] }}</td>
                                    <td>{{ $backup['file_name'] }}</td>
                                    <td>{{ $backup['file_size'] }}</td>
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                data-bs-toggle="dropdown">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                @can('download-backup')
                                                    <a class="dropdown-item"
                                                        href="{{ route('backup.download', $backup['file_name']) }}">
                                                        <i class='bx bx-download'></i>
                                                        Download</a>
                                                @endcan
                                                @can('delete-backup')
                                                    <form
                                                        action="{{ route('backup.destroy', $backup['file_name']) }}"
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
