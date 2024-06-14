@extends('layouts.template')
@section('title', 'employee-app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Daftar Karyawan</div>

                    <div class="card-body">
                        <div class="table-filter row align-items-center justify-content-between">
                            <div class="col col-btn" style="max-width: 100px;">
                                <a href="{{ route('create-user') }}" class="btn btn-sm btn-success mb-2">Tambah Data</a>
                            </div>
                            <div class="col"></div>
                        </div>
                        <table id="tbl_list" class="table table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Photo</th>
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
                        "data": "photo",
                        "render": function(data) {
                            return '<img src="' + data +
                                '" class="avatar" width="50" height="50"/>';
                        }
                    },
                    {
                        data: 'name'
                    },
                    {
                        data: 'email'
                    },
                    {
                        data: 'emp_code'
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
