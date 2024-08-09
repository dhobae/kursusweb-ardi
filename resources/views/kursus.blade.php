@extends('layouts.app')

@section('content')
    <div class="container">
        @foreach ($data as $row)
            <div class="card mb-5">
                <div class="card-header">
                    <h3 class="mb-0 p-1">Kursus : {{ $row->judul_kursus }}</h3>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <img src="/storage/{{ $row->gambar_kursus }}" alt="###" class="img-fluid" height="75%">
                    </div>
                    <div class="accordion" id="accordionPanelsStayOpenExample">
                        <div class="accordion-item mb-5">
                            <h2 class="accordion-header">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#parentPanelsStayOpen-collapse{{ $loop->iteration }}"
                                    aria-expanded="true"
                                    aria-controls="parentPanelsStayOpen-collapse{{ $loop->iteration }}">
                                    Detail
                                </button>
                            </h2>
                            <div id="parentPanelsStayOpen-collapse{{ $loop->iteration }}"
                                class="accordion-collapse collapse show">
                                <div class="accordion-body">
                                    <div class="mb-3 d-flex justify-content-between gap-2 align-items-center">
                                        <div class="fw-bold">
                                            {{ $row->deskripsi_kursus }}
                                        </div>
                                        <div class="fw-bold">
                                            @php
                                                $jam = intdiv($row->durasi_kursus, 60);
                                                $menit = $row->durasi_kursus % 60;
                                            @endphp
                                            Durasi: {{ $jam }} jam {{ $menit }} menit
                                        </div>
                                    </div>
                                    @foreach ($row->materis as $materi)
                                        <div class="accordion" id="accordionPanelsStayOpenExample">
                                            <div class="accordion-item">
                                                <h2 class="accordion-header">
                                                    <button class="accordion-button fw-bold" type="button"
                                                        data-bs-toggle="collapse"
                                                        data-bs-target="#panelsStayOpen-collapse{{ $loop->iteration }}"
                                                        aria-expanded="true"
                                                        aria-controls="panelsStayOpen-collapse{{ $loop->iteration }}">
                                                        {{ $materi->judul_materi }}
                                                    </button>
                                                </h2>
                                                <div id="panelsStayOpen-collapse{{ $loop->iteration }}"
                                                    class="accordion-collapse collapse">
                                                    <div class="accordion-body">
                                                        <div
                                                            class="mb-3 d-flex justify-content-between gap-2 align-items-center">
                                                            <div class="fw-bold">
                                                                <h3 class="mb-0">{{ $materi->judul_materi }}</h3>
                                                            </div>
                                                            <div class="fw-bold">
                                                                <h6 class="mb-0"> {{ $materi->deskripsi_materi }}</h6>
                                                            </div>
                                                        </div>
                                                        <div class="mt-3">
                                                            @php
                                                                $url = $materi->link_embed_materi;
                                                                parse_str(parse_url($url, PHP_URL_QUERY), $query);
                                                                $video_id = $query['v'] ?? '';
                                                            @endphp
                                                            <iframe width="100%" class="img-fluid responsive-iframe"
                                                                src="https://www.youtube.com/embed/{{ $video_id }}"
                                                                frameborder="0"
                                                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                                                allowfullscreen></iframe>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach


        <div class="card mt-3">
            <div class="card-body">
                <ul class="pagination mb-0">
                    <li class="page-item {{ $data->onFirstPage() ? 'disabled' : '' }}">
                        <a class="page-link" href="{{ $data->previousPageUrl() }}">Previous</a>
                    </li>

                    @php
                        $currentPage = $data->currentPage();
                        $start = max($currentPage - 1, 1);
                        $end = min($start + 3, $data->lastPage());
                    @endphp

                    @for ($i = $start; $i <= $end; $i++)
                        <li class="page-item {{ $i == $data->currentPage() ? 'active' : '' }}">
                            <a class="page-link" href="{{ $data->url($i) }}">{{ $i }}</a>
                        </li>
                    @endfor

                    <li class="page-item {{ $data->hasMorePages() ? '' : 'disabled' }}">
                        <a class="page-link" href="{{ $data->nextPageUrl() }}">Next</a>
                    </li>
                </ul>
            </div>
        </div>

    </div>
@endsection
