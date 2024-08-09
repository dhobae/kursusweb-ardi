@extends('admin.layouts.index')

@section('content')
    <section class="content">
        <form action="{{ route('kursus-update', $data->id) }}" enctype="multipart/form-data" method="POST">
            @csrf
            @method('PUT')
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-xl-10 order-xl-1">
                        <div class="card">
                            <div class="card-header">
                                <div class="row align-items-center">
                                    <div class="col-8">
                                        <h3 class="mb-0">Edit Kursus</h3>
                                    </div>
                                    <div class="col-4 text-right">
                                        <a href="{{ route('kursus-list') }}" class="btn btn-secondary" title="Back/Cancel">
                                            <i class="fas fa-arrow-left"></i>
                                        </a>
                                        <button type="submit" title="Save Changes" class="btn btn-primary"><span
                                                class="fas fa-save"></span></button>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <h6 class="heading-small text-muted mb-4">Kursus Edit</h6>
                                <div class="pl-lg-4">
                                    {{-- row --}}
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label for="judul_kursus">Judul Kursus
                                                </label>
                                                <input type="text" class="form-control" id="judul_kursus"
                                                    placeholder="judul_kursus" name="judul_kursus"
                                                    value="{{ $data->judul_kursus }}">
                                                @error('judul_kursus')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label>Durasi Kursus
                                                    <span class="text-danger">*</span>
                                                </label>
                                                @php
                                                    $jam = intdiv($data->durasi_kursus, 60);
                                                    $menit = $data->durasi_kursus % 60;
                                                @endphp

                                                <div class="form-row">
                                                    <div class="col">
                                                        <select name="durasi_jam" id="durasi_jam" class="form-control"
                                                            required>
                                                            <option value="" disabled>Jam
                                                            </option>
                                                            @for ($i = 0; $i <= 24; $i++)
                                                                <option value="{{ $i }}"
                                                                    {{ $jam == $i ? 'selected' : '' }}>
                                                                    {{ $i }}
                                                                </option>
                                                            @endfor
                                                        </select>
                                                        @error('durasi_jam')
                                                            <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="col">
                                                        <select name="durasi_menit" id="durasi_menit" class="form-control"
                                                            required>
                                                            <option value="" disabled>Menit</option>
                                                            @for ($i = 0; $i < 60; $i += 1)
                                                                <option value="{{ $i }}"
                                                                    {{ $menit == $i ? 'selected' : '' }}>
                                                                    {{ $i }}
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
                                        </div>

                                        <div class="col-lg-6">
                                            <label for="" style="font-weight: bold">Gambar Kursus</label>
                                            <img src="/storage/{{ $data->gambar_kursus }}"
                                                class="img-fluid d-block mx-auto" alt="###" style="cursor: pointer;">
                                        </div>

                                        <div class="modal fade" id="imageModal" tabindex="-1"
                                            aria-labelledby="imageModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered modal-xl">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="imageModalLabel">Gambar Kursus</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <img id="modalImage" src="" class="img-fluid"
                                                            alt="Gambar Kursus">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <script>
                                            const image = document.querySelector('.img-fluid'); // Pilih gambar utama
                                            const modal = document.getElementById('imageModal');
                                            const modalImage = document.getElementById('modalImage');

                                            image.addEventListener('click', () => {
                                                modalImage.src = image.src; // Set sumber gambar modal sama dengan gambar utama
                                                const myModal = new bootstrap.Modal(modal); // Inisialisasi modal Bootstrap
                                                myModal.show(); // Tampilkan modal
                                            });
                                        </script>

                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="customFile">Timpa Gambar Kursus Yang Baru?</label>
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="gambar_kursus"
                                                        name="gambar_kursus">
                                                    <label class="custom-file-label" for="gambar_kursus">Choose
                                                        file</label>
                                                </div>
                                                @error('gambar_kursus')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                                <span class="text-secondary ml-2" style="font-size: 12px">Max 2Mb</span>
                                            </div>

                                            <div class="form-group">
                                                <label>Deskripsi Kursus</label>
                                                <textarea class="form-control" name="deskripsi_kursus" rows="3" placeholder="Masukkan Deskripsi ..."
                                                    style="height: 92px;">{{ $data->deskripsi_kursus }}</textarea>
                                                @error('deskripsi_kursus')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    {{-- row end --}}
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </form>
    </section>
@endsection
