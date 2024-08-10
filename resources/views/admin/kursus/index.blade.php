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
                            <h3 class="card-title">Kursus List</h3>
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
                                data-target="#tambahKursus">
                                Tambah Kursus
                            </button>
                        </div>
                        <div class="table-responsive">
                            <table id="kursustable" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th class="fixed-width">#</th>
                                        <th>Judul</th>
                                        <th>Deskripsi</th>
                                        <th>Durasi</th>
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
                                                {{ $row->judul_kursus }}
                                            </td>
                                            <td>
                                                {{ $row->deskripsi_kursus }}
                                            </td>
                                            <td>
                                                @php
                                                    $jam = intdiv($row->durasi_kursus, 60);
                                                    $menit = $row->durasi_kursus % 60;
                                                @endphp

                                                <p>Durasi: {{ $jam }} jam {{ $menit }} menit</p>
                                            </td>
                                            <td>
                                                <div class="d-flex justify-content-center align-items-center"
                                                    style="gap: 3px">
                                                    <a href="{{ route('kursus-show', $row->id) }}"
                                                        class="btn btn-sm btn-info">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <a href="{{ route('kursus-edit', $row->id) }}"
                                                        title="Edit User {{ $row->judul_kursus }}"
                                                        class="btn btn-sm btn-warning">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    {{-- <a href="{{ route('user-destroy', $row->id) }}"
                                                            class="btn btn-sm btn-danger">
                                                            <i class="fas fa-trash"></i>
                                                        </a> --}}
                                                    <a href="#" kursus-data-id="{{ $row->id }}"
                                                        class="btn btn-sm btn-danger delete-button-kursus"
                                                        title="Delete User {{ $row->judul_kursus }}">
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
    <form action="{{ route('kursus-store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="modal fade" id="tambahKursus" data-backdrop="static" tabindex="-1" role="dialog"
            aria-labelledby="tambahKursusLabel" aria-hidden="true">

            <script>
                $(document).ready(function() {
                    @if ($errors->any())
                        $('#tambahKursus').modal('show');
                    @endif
                });
            </script>
            <div class="modal-dialog modal-xl " role="document">
                {{-- modal-dialog-centered --}}
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="tambahKursusLabel">Tambah Kursus</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid">

                            <div class="form-group">
                                <label for="judul_kursus">Judul Kursus
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control" id="judul_kursus" placeholder="Judul Kursus"
                                    name="judul_kursus" value="{{ old('judul_kursus') }}">
                                @error('judul_kursus')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- <input type="time" name="durasi" id="durasi" class="form-control" required> --}}
                            <div class="form-group">
                                <label>Durasi Kursus
                                    <span class="text-danger">*</span>
                                </label>

                                {{-- <div class="form-row">
                                    <div class="col">
                                        <select name="durasi_jam" id="durasi_jam" class="form-control" required>
                                            <option value="" {{ old('durasi_jam') === null ? 'selected' : '' }}>Jam
                                            </option>
                                            @for ($i = 0; $i <= 24; $i++)
                                                <option value="{{ $i }}"
                                                    {{ old('durasi_jam') == $i ? 'selected' : '' }}>{{ $i }}
                                                </option>
                                            @endfor
                                        </select>
                                        @error('durasi_jam')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col">
                                        <select name="durasi_menit" id="durasi_menit" class="form-control" required>
                                            <option value="" {{ old('durasi_menit') === null ? 'selected' : '' }}>
                                                Menit</option>
                                            @for ($i = 0; $i < 60; $i += 5)
                                                <option value="{{ $i }}"
                                                    {{ old('durasi_menit') == $i ? 'selected' : '' }}>{{ $i }}
                                                </option>
                                            @endfor
                                        </select>
                                        @error('durasi_menit')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div> --}}

                                <div class="form-row">
                                    <div class="col">
                                        <select name="durasi_jam" id="durasi_jam" class="form-control" required>
                                            <option value="" disabled>Jam
                                            </option>
                                            @for ($i = 0; $i <= 24; $i++)
                                                <option value="{{ $i }}"
                                                    {{ old('durasi_jam') == $i ? 'selected' : '' }}>{{ $i }}
                                                </option>
                                            @endfor
                                        </select>
                                        @error('durasi_jam')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col">
                                        <select name="durasi_menit" id="durasi_menit" class="form-control" required>
                                            <option value="" disabled>Menit</option>
                                            @for ($i = 0; $i < 60; $i += 1)
                                                <option value="{{ $i }}"
                                                    {{ old('durasi_menit') == $i ? 'selected' : '' }}>{{ $i }}
                                                </option>
                                            @endfor
                                        </select>
                                        @error('durasi_menit')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                @error('durasi')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Deskripsi Kursus</label>
                                <textarea class="form-control" name="deskripsi_kursus" rows="3" placeholder="Masukkan Deskripsi ..."
                                    style="height: 92px;"></textarea>
                                @error('deskripsi_kursus')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="customFile">Gambar Kursus</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="gambar_kursus"
                                        name="gambar_kursus" value="{{ old('gambar_kursus') }}">
                                    <label class="custom-file-label" for="gambar_kursus">Choose file</label>
                                </div>
                                @error('gambar_kursus')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                                <span class="text-secondary ml-2" style="font-size: 12px">Max 2Mb</span>
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


    @if ($show_modal)
        <script>
            $(document).ready(function() {
                $('#tambahKursus').modal('show');

                // Menghapus parameter dari URL setelah modal ditampilkan
                const url = new URL(window.location.href);
                url.searchParams.delete('show_modal');
                window.history.replaceState(null, null, url.toString());
            });
        </script>
    @endif

    <script>
        $(document).ready(function() {
            // table
            var table = $("#kursustable").DataTable({
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
            $('#kursustable_length').appendTo('#top-function');
            $('#kursustable_filter').appendTo('#top-function');

            $('#kursustable_info').appendTo('#footer-function');
            $('#kursustable_paginate').appendTo('#footer-function');
            $('#kursustable_paginate').clone().appendTo('#2ndfooter-function');
            $('.dataTables_paginate .pagination').css('margin-bottom', '0', '!important');
        });
    </script>
@endsection
