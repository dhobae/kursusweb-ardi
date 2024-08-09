@extends('admin.layouts.index')

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="row align-items-center">
                <div class="col-8">
                    <h3 class="mb-0">Materi Detail</h3>
                </div>
                <div class="col-4 text-right">
                    <a href="{{ route('materi-list') }}" class="btn btn-secondary" title="Back/Cancel">
                        <i class="fas fa-arrow-left"></i>
                    </a>
                    <a href="{{ route('materi-edit', $data->id) }}" title="Edit User {{ $data->judul_materi }}"
                        class="btn btn-warning">
                        <i class="fas fa-edit"></i>
                    </a>
                    <a href="#" materi-data-id="{{ $data->id }}" class="btn btn-danger delete-button-materi"
                        title="Delete {{ $data->judul_materi }}">
                        <i class="fas fa-trash"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-2">
                    <dl>
                        <dt>Judul Materi</dt>
                        <dd>{{ $data->judul_materi }}</dd>
                        <dt>Deskripsi Materi</dt>
                        <dd>{{ $data->deskripsi_materi }}</dd>
                        <dt>Masuk Ke Dalam Kursus</dt>
                        <dd>{{ $data->kursus->judul_kursus }}</dd>
                        <dt>Link Embed</dt>
                        <dd>{{ $data->link_embed_materi }}</dd>
                    </dl>
                </div>
                <div class="col-md-10">
                    <dl>
                        <dt>Video</dt>
                        <div class="container-fluid">
                            @php
                                $url = $data->link_embed_materi;
                                parse_str(parse_url($url, PHP_URL_QUERY), $query);
                                $video_id = $query['v'] ?? '';
                            @endphp
                            <iframe width="250px" max-height="250px" class="img-fluid responsive-iframe"
                                src="https://www.youtube.com/embed/{{ $video_id }}" frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                allowfullscreen></iframe>
                        </div>
                    </dl>
                </div>
            </div>
        </div>
    </div>
@endsection
