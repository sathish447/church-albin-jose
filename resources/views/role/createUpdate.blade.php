@extends('layouts.admin')

@section('page_title')
    {{ empty($obj->id) ? 'New Role' : 'Update Role' }}
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{ route('role.index') }}">Roles</a></li>
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
                        <a href="{{ route('role.index') }}" type="button" class="btn btn-sm btn-success"><i class="fa fa-chevron-left"></i> Back</a>
                    </div>
                </div>
                <form id="form" method="post" action="{{ route('role.create.update.post') }}" autocomplete="off"
                    novalidate="novalidate">
                    @csrf
                    <input type="hidden" name="id" value="{{ empty($obj->id) ? 0 : $obj->id }}">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">Role Name</label>
                            <input type="text" class="form-control form-control-border" id="name" name="name"
                                value="{{ old('name', $obj->name) }}" required>
                        </div>
                        <div class="form-group">
                            <label for="state_id">Permission</label>
                            <div class="select2-primary">
                                <select class="custom-select form-control-border select2 select2-danger" id="permissions" name="permissions[]"
                                    multiple="multiple">
                                    @foreach ($permissions as $permission)
                                        <option value="{{ $permission->id }}" @if(in_array($permission->id, $permissions_selected)) selected @endif>{{ $permission->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-secondary">{{ empty($obj->id) ? 'Submit' : 'Update' }}</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
@endsection

@section('style')
<link rel="stylesheet" href="{{ btheme() }}/plugins/select2/css/select2.min.css">
<link rel="stylesheet" href="{{ btheme() }}/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
@endsection

@section('head-script')
@endsection

@section('script')
<script src="{{ btheme() }}/plugins/select2/js/select2.full.min.js"></script>
    <script type="text/javascript">
        $("#permissions").select2({
            multiple: true
        });
    </script>
@endsection
