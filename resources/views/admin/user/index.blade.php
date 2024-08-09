@extends('admin.layouts.index')

@section('style')
@endsection

@section('content')
    <section class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div id="header-container" class="d-flex justify-content-between align-items-center flex-wrap"
                            style="gap: 3px">
                            <h3 class="card-title">User List</h3>
                            <div id="main"></div>
                        </div>

                    </div>
                    <div class="card-body">
                        <div id="top-function" class="d-flex justify-content-between align-items-center flex-wrap">
                        </div>
                        <div id="2ndfooter-function" class="d-flex justify-content-between align-items-center flex-wrap"
                            style="gap: 3px">
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-sm btn-primary" data-toggle="modal"
                                data-target="#tambahUser">
                                Tambah User
                            </button>
                        </div>
                        <div class="table-responsive">
                            <table id="usertable" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th class="fixed-width">#</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th style="width:8%;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $row)
                                        <tr>
                                            <td class="text-center fixed-width">
                                                {{ $loop->iteration }}
                                            </td>
                                            <td>
                                                {{ $row->name }}
                                            </td>
                                            <td>
                                                {{ $row->email }}
                                            </td>
                                            <td>
                                                @foreach ($row->roles as $role)
                                                    {{ $role->name }}
                                                @endforeach
                                            </td>
                                            <td>
                                                <div class="d-flex justify-content-center align-items-center"
                                                    style="gap: 3px">
                                                    <a href="{{ route('user-edit', $row->id) }}"
                                                        title="Edit User {{ $row->name }}"
                                                        class="btn btn-sm btn-warning">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    {{-- <a href="{{ route('user-destroy', $row->id) }}"
                                                            class="btn btn-sm btn-danger">
                                                            <i class="fas fa-trash"></i>
                                                        </a> --}}
                                                    @unless ($row->hasRole('admin'))
                                                        <a href="#" user-data-id="{{ $row->id }}"
                                                            class="btn btn-sm btn-danger delete-button"
                                                            title="Delete User {{ $row->name }}">
                                                            <i class="fas fa-trash"></i>
                                                        </a>
                                                    @endunless
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div id="footer-function" class="mt-3 d-flex justify-content-between align-items-center flex-wrap">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Modal -->
    <form action="{{ route('user-store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="modal fade" id="tambahUser" data-backdrop="static" tabindex="-1" role="dialog"
            aria-labelledby="tambahUserLabel" aria-hidden="true">
            <script>
                $(document).ready(function() {
                    @if ($errors->any())
                        $('#tambahUser').modal('show');
                    @endif
                });
            </script>
            <div class="modal-dialog modal-xl " role="document">
                {{-- modal-dialog-centered --}}
                <div class="modal-content">

                    <div class="modal-header">
                        <h5 class="modal-title" id="tambahUserLabel">Tambah User</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid">

                            <div class="form-group">
                                <label for="Name">Name
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control" id="Name" placeholder="Name User"
                                    name="name" value="{{ old('name') }}">
                                @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="email">Email address
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="email" class="form-control" id="email" placeholder="Email" name="email"
                                    value="{{ old('email') }}">
                                @error('email')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="Password">Password
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="password" class="form-control" id="Password" placeholder="Password"
                                    name="password" value="{{ old('password') }}">
                                @error('password')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Tambah</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <script>
        $(document).ready(function() {
            // table
            var table = $("#usertable").DataTable({
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": false,
                columnDefs: [{
                    orderable: false,
                    targets: 4
                }],
                // "dom": 'Bfrtip', // Include buttons in the DOM
                // "buttons": ["excel", "pdf", "print"]
                buttons: [{
                        extend: 'excel',
                        text: '<i class="fas fa-file-excel mr-2"></i> Excel',
                        titleAttr: 'Export to Excel',
                        className: 'btn btn-success',
                        exportOptions: {
                            columns: ':not(:eq(4))' // Exclude the 4th column
                        }
                    },
                    {
                        extend: 'pdf',
                        text: '<i class="fas fa-file-pdf mr-2"></i> PDF',
                        titleAttr: 'Export to PDF',
                        className: 'btn btn-danger',
                        exportOptions: {
                            columns: ':not(:eq(4))' // Exclude the 4th column
                        }
                    },
                    {
                        extend: 'print',
                        text: '<i class="fas fa-print mr-2"></i> Print',
                        titleAttr: 'Print Table',
                        exportOptions: {
                            columns: ':not(:eq(4))' // Exclude the 4th column
                        }
                    }
                ]
            });

            // Move the buttons container to #container-function
            table.buttons().container().appendTo('#header-container #main');
            // Move the search box to #container-function
            $('#usertable_length').appendTo('#top-function');
            $('#usertable_filter').appendTo('#top-function');

            $('#usertable_info').appendTo('#footer-function');
            $('#usertable_paginate').appendTo('#footer-function');
            $('#usertable_paginate').clone().appendTo('#2ndfooter-function');
            $('.dataTables_paginate .pagination').css('margin-bottom', '0', '!important');

            // Hapus User
            $('.delete-button').on('click', function(e) {
                e.preventDefault();
                var id = $(this).attr('user-data-id');
                var token = $('meta[name="csrf-token"]').attr('content');
                var url = "{{ route('user-destroy', ':id') }}";
                url = url.replace(':id', id);
                // console.log(url);

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: url,
                            type: 'POST',
                            data: {
                                _token: token,
                                _method: 'DELETE'
                            },
                            success: function(response) {
                                Swal.fire(
                                    'Deleted!',
                                    'The user has been deleted.',
                                    'success'
                                ).then(() => {
                                    location.reload();
                                });
                            },
                            error: function(xhr) {
                                Swal.fire(
                                    'Failed!',
                                    'There was an error deleting the user.',
                                    'error'
                                );
                            }
                        });
                    }
                });
            });
        });
    </script>
@endsection
