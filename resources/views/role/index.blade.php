@extends('layouts.admin')

@section('page_title')
    Roles
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
    <li class="breadcrumb-item active">@yield('page_title')</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-secondary">
                <div class="card-header">
                    <h3 class="card-title">
                        @yield('page_title')
                    </h3>
                    <div class="card-tools">
                        <!-- <a href="{{ route('role.create.update') }}" type="button" class="btn btn-sm btn-success"> <i class="fas fa-plus"></i> New </a> -->
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <table id="datatable" class="table table-bordered table-striped">
                                <thead>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Action</th>
                                </thead>
                                <tbody id="reorder_row">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <span class='d-none datatable_status'>{{ route('role.action', ['ID', 'STATUS']) }}</span>    
@endsection

@section('style')
@endsection

@section('head-script')
@endsection

@section('script')
    <script type="text/javascript">
        jQuery(document).ready(function() {
            alert('vv');
            $('#datatable').DataTable({
                // responsive: true,
                processing: false,
                serverSide: true,
                ajax:{
                    url: "{{ route('role.list') }}",
                    beforeSend: function() {
                        $('#loadingModal').modal('show'); // Show loading modal before sending the request
                    },    
                },
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex' , orderable: false, searchable: false},
                    { data: 'name', name: 'name' },
                    { data: 'action', name: 'action', orderable: false, searchable: false, className: "text-center" },
                ],
                "order": [
                    [1, "asc"]
                ],
                drawCallback: function(settings) {
                    // Hide loading modal after column changes are completed
                    $('#loadingModal').modal('hide');
                },                
                paging: false
            });
        });
    </script>
@endsection
