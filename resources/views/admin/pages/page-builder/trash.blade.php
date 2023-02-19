@extends('admin.layouts.master')

@section('page_title', 'Page Index')

@push('admin_style')
    @include('admin.pages.common.index_style')
@endpush

@section('admin_content')
    <div class="row">
        <div class="col-md-12">
            <div class="card p-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 text-primary">Page Create Form</h5>
                    <a href="{{ route('page.index') }}" class="btn btn-info"><i class='bx bx-chevrons-left'></i>
                        Index</a>
                </div>
                <div class="table-responsive text-nowrap">
                    <table id="dataTable" class="table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Last Updated</th>
                                <th>Page Title</th>
                                <th>Meta Title</th>
                                <th>Meta Keywords</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @forelse ($pages as $page)
                                <tr>
                                    <td>
                                        <strong>{{ $pages->firstItem() + $loop->index }}</strong>
                                    </td>
                                    <td>{{ $page->updated_at->format('d-M-Y') }}</td>
                                    <td>{{ $page->page_title }}</td>
                                    <td>{{ $page->meta_title }}</td>
                                    <td>{{ $page->meta_keywords }}</td>
                                    <td>
                                        <div class="form-check form-switch mb-2">
                                            <input class="form-check-input toggle-class" type="checkbox" id="{{ $page->id }}"
                                            {{ $page->is_active ? 'checked' : ''}} data-id="{{ $page->id }}">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                data-bs-toggle="dropdown">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                @can('delete-page')
                                                <a class="dropdown-item"
                                                href="{{ route('page.restore', ['page_slug' => $page->page_slug]) }}"><i class='bx bxs-direction-left me-1'></i>
                                                Restore </a>
                                                @endcan
                                                @can('delete-page')
                                                <form action="{{ route('page.forcedelete', ['page_slug' => $page->page_slug]) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="dropdown-item show_confirm"><i class="bx bx-trash me-1"></i> Force Delete</a></button>
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
                    url: '/admin/check/page/is_active/'+item_id,
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
