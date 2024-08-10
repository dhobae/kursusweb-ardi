@extends('admin.layouts.index')

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="row align-items-center">
                <div class="col-8">
                    <h3 class="mb-0">Kursus Detail</h3>
                </div>
                <div class="col-4 text-right">
                    <a href="{{ route('kursus-list') }}" class="btn btn-secondary" title="Back/Cancel">
                        <i class="fas fa-arrow-left"></i>
                    </a>
                    <a href="{{ route('kursus-edit', $data->id) }}" title="Edit {{ $data->judul_kursus }}"
                        class="btn btn-warning">
                        <i class="fas fa-edit"></i>
                    </a>
                    <a href="#" kursus-data-id="{{ $data->id }}" class="btn btn-danger delete-button-kursus"
                        title="Delete {{ $data->judul_kursus }}">
                        <i class="fas fa-trash"></i>
                    </a>
                </div>
            </div>
            {{-- <pre>{{ json_encode($data, JSON_PRETTY_PRINT) }}</pre> --}}
        </div>
        <div class="card-body">
            <div class="row justify-content-center align-items-center">

                <div class="col-md-4">
                    <dl style="font-size: 18px">
                        <dt>Judul Kursus</dt>
                        <dd>{{ $data->judul_kursus }}</dd>
                        <dt>Durasi Kursus</dt>
                        <dd>
                            @php
                                $jam = intdiv($data->durasi_kursus, 60);
                                $menit = $data->durasi_kursus % 60;
                            @endphp
                            <p>{{ $jam }} jam {{ $menit }} menit</p>
                        </dd>
                        <dt>Deskripsi Kursus</dt>
                        <dd>
                            {{ $data->deskripsi_kursus }}
                        </dd>
                    </dl>
                </div>


                <div class="col-md-6">
                    <label for="" style="font-weight: bold">Gambar Kursus</label>
                    <img src="/storage/{{ $data->gambar_kursus }}" class="img-fluid d-block mx-auto" alt="###"
                        style="cursor: pointer;">

                    <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-xl">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="imageModalLabel">Gambar Kursus</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <img id="modalImage" src="" class="img-fluid" alt="Gambar Kursus">
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
                </div>
            </div>

            <div class="row justify-content-center align-items-center mt-3">
                <div class="col-12">
                    <h4 class="card-title mb-0 d-block" style="font-weight: bold">
                        Isi Materi
                    </h4>
                </div>
                <div class="col-12">
                    @if ($materis->isEmpty())
                        <div class="alert alert-warning">
                            Tidak ada materi yang tersedia. Silakan <a
                                href="{{ route('materi-list', ['show_modal' => 'true']) }}"
                                class="btn btn-sm btn-dark mx-2">Tambahkan</a> materi.
                        </div>
                    @endif
                    {{-- start accord --}}
                    <div id="accordion">
                        @foreach ($materis as $materi)
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h4 class="card-title w-100">
                                        <a class="d-block w-100" data-toggle="collapse"
                                            href="#collapse-{{ $loop->iteration }}" aria-expanded="true">
                                            {{ $materi->judul_materi }}
                                            <i class="fas fa-angle-down float-right"></i>
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapse-{{ $loop->iteration }}" class="collapse show">
                                    <div class="card-body">
                                        <div class="card">
                                            <div class="card-header">
                                                <div class="row align-items-center">
                                                    <div class="col-8">
                                                        <h3 class="mb-0">Materi Detail</h3>
                                                    </div>
                                                    <div class="col-4 text-right">
                                                        <a href="{{ route('materi-edit', $materi->id) }}"
                                                            title="Edit User {{ $materi->judul_materi }}"
                                                            class="btn btn-warning">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-2">
                                                        <dl>
                                                            <dt>Judul Materi</dt>
                                                            <dd>{{ $materi->judul_materi }}</dd>
                                                            <dt>Deskripsi Materi</dt>
                                                            <dd>{{ $materi->deskripsi_materi }}</dd>
                                                            <dt>Masuk Ke Dalam Kursus</dt>
                                                            <dd>{{ $materi->kursus->judul_kursus }}</dd>
                                                            <dt>Link Embed</dt>
                                                            <dd>{{ $materi->link_embed_materi }}</dd>
                                                        </dl>
                                                    </div>
                                                    <div class="col-md-10">
                                                        <dl>
                                                            <dt>Video</dt>
                                                            <div class="container-fluid">
                                                                @php
                                                                    $url = $materi->link_embed_materi;
                                                                    parse_str(parse_url($url, PHP_URL_QUERY), $query);
                                                                    $video_id = $query['v'] ?? '';
                                                                @endphp
                                                                <iframe width="250px" max-height="250px"
                                                                    class="img-fluid responsive-iframe"
                                                                    src="https://www.youtube.com/embed/{{ $video_id }}"
                                                                    frameborder="0"
                                                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                                                    allowfullscreen></iframe>
                                                            </div>
                                                        </dl>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    {{-- end accord --}}

                    {{-- pagination --}}
                    <ul class="pagination mb-0">
                        <li class="page-item {{ $materis->onFirstPage() ? 'disabled' : '' }}">
                            <a class="page-link" href="{{ $materis->previousPageUrl() }}">Previous</a>
                        </li>

                        @php
                            $currentPage = $materis->currentPage();
                            $start = max($currentPage - 1, 1);
                            $end = min($start + 3, $materis->lastPage());
                        @endphp

                        @for ($i = $start; $i <= $end; $i++)
                            <li class="page-item {{ $i == $materis->currentPage() ? 'active' : '' }}">
                                <a class="page-link" href="{{ $materis->url($i) }}">{{ $i }}</a>
                            </li>
                        @endfor

                        <li class="page-item {{ $materis->hasMorePages() ? '' : 'disabled' }}">
                            <a class="page-link" href="{{ $materis->nextPageUrl() }}">Next</a>
                        </li>
                    </ul>
                </div>
            </div>

        </div>
    </div>


    <script>
        $(document).ready(function() {
            $('#accordion .collapse').on('shown.bs.collapse', function() {
                $(this).prev().find('.fas').removeClass('fa-angle-down').addClass('fa-angle-up');
            }).on('hidden.bs.collapse', function() {
                $(this).prev().find('.fas').removeClass('fa-angle-up').addClass('fa-angle-down');
            });
        });
    </script>
@endsection
