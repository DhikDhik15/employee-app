@extends('layouts.template')
@section('title', 'employee-app')
@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Daftar User</div>

                    <div class="card-body">
                        <div class="table-filter row align-items-center justify-content-between">
                            <div class="col col-btn" style="max-width: 100px;">
                                <a href="#" class="btn btn-sm btn-success mb-2">Tambah Data</a>
                            </div>
                            <div class="col" style="max-width: 100px;">
                                <select name="emp_id" class="form-control">
                                    <option value="1" selected>Active</option>
                                    <option value="2">Not Active</option>
                                </select>
                            </div>
                            <div class="col"></div>
                        </div>
                        <table id="tbl_list" class="table table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Employe Code</th>
                                    <th>Position</th>
                                    <th>Tanggal Bergabung</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {

            $('#tbl_list').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('users') }}',
                columns: [{
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        },
                    },
                    {
                        data: 'name'
                    },
                    {
                        data: 'email'
                    },
                    {
                        data: 'emp_id'
                    },
                    {
                        data: 'position'
                    },
                    {
                        data: 'join_date'
                    }
                ]
            });
        });
    </script>
@endpush
