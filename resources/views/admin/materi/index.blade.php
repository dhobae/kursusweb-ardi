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
                            <h3 class="card-title">Materi List</h3>
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
                                data-target="#tambahMateri">
                                Tambah Materi
                            </button>
                        </div>
                        <div class="table-responsive">
                            <table id="materitable" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th class="fixed-width">#</th>
                                        <th>Judul</th>
                                        <th>Deskripsi</th>
                                        <th>Kursus</th>
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
                                                {{ $row->judul_materi }}
                                            </td>
                                            <td>
                                                {{ $row->deskripsi_materi }}
                                            </td>
                                            <td>
                                                {{ $row->kursus->judul_kursus }}
                                            </td>
                                            <td>
                                                <div class="d-flex justify-content-center align-items-center"
                                                    style="gap: 3px">
                                                    <a href="{{ route('materi-show', $row->id) }}"
                                                        class="btn btn-sm btn-info">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <a href="{{ route('materi-edit', $row->id) }}"
                                                        title="Edit User {{ $row->judul_materi }}"
                                                        class="btn btn-sm btn-warning">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    {{-- <a href="{{ route('user-destroy', $row->id) }}"
                                                            class="btn btn-sm btn-danger">
                                                            <i class="fas fa-trash"></i>
                                                        </a> --}}
                                                    <a href="#" materi-data-id="{{ $row->id }}"
                                                        class="btn btn-sm btn-danger delete-button-materi"
                                                        title="Delete User {{ $row->judul_materi }}">
                                                        <i class="fas fa-trash"></i>
                                                    </a>
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
    <form action="{{ route('materi-store') }}" method="POST">
        @csrf
        <div class="modal fade" id="tambahMateri" tabindex="-1" role="dialog" aria-labelledby="tambahMateriLabel"
            aria-hidden="true">
            <script>
                $(document).ready(function() {
                    @if ($errors->any())
                        $('#tambahMateri').modal('show');
                    @endif
                });
            </script>
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="tambahMateriLabel">Tambah Materi</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="judul_materi">Judul Materi
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control" id="judul_materi" name="judul_materi"
                                value="{{ old('judul_materi') }}" placeholder="Masukkan Judul">
                            @error('judul_materi')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="deskripsi_materi">Deskripsi Materi
                                <span class="text-danger">*</span>
                            </label>
                            <textarea class="form-control" placeholder="Masukkan Deskripsi..." id="deskripsi_materi" name="deskripsi_materi"
                                rows="3">{{ old('deskripsi_materi') }}</textarea>
                            @error('deskripsi_materi')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="kursus_id">Pilih Kursus Tersedia
                                <span class="text-danger">*</span>
                            </label>
                            <select class="form-control" id="kursus_id" name="kursus_id">
                                <option value="">Pilih Kursus</option>
                                @foreach ($data_kursus as $kursus)
                                    <option value="{{ $kursus->id }}">{{ $kursus->judul_kursus }}</option>
                                @endforeach
                            </select>
                            @error('kursus_id')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="link_embed_materi">Link Embed
                                <span class="text-danger">*</span>
                            </label>
                            <textarea class="form-control" placeholder="Masukkan Link Embed..." id="link_embed_materi" name="link_embed_materi"
                                rows="3">{{ old('link_embed_materi') }}</textarea>
                            @error('link_embed_materi')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Tambah</button>
                    </div>
                </div>
            </div>
        </div>
    </form>


    <script>
        $(document).ready(function() {
            // table
            var table = $("#materitable").DataTable({
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": false,
                columnDefs: [{
                    // orderable: false,
                    // targets: 4
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
            $('#materitable_length').appendTo('#top-function');
            $('#materitable_filter').appendTo('#top-function');

            $('#materitable_info').appendTo('#footer-function');
            $('#materitable_paginate').appendTo('#footer-function');
            $('#materitable_paginate').clone().appendTo('#2ndfooter-function');
            $('.dataTables_paginate .pagination').css('margin-bottom', '0', '!important');


           

        });
    </script>
@endsection
