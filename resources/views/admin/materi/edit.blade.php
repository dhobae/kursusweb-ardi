@extends('admin.layouts.index')

@section('content')
    {{-- {{ $data->id }} --}}
    <section class="content">
        <form action="{{ route('materi-update', $data->id) }}" method="POST">
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
                                        <a href="{{ route('materi-list') }}" class="btn btn-secondary" title="Back/Cancel">
                                            <i class="fas fa-arrow-left"></i>
                                        </a>
                                        <button type="submit" title="Save Changes" class="btn btn-primary"><span
                                                class="fas fa-save"></span></button>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <h6 class="heading-small text-muted mb-4">Materi Edit</h6>
                                <div class="pl-lg-4">
                                    {{-- row --}}
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label for="judul_materi">Judul Materi
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <input type="text" class="form-control" id="judul_materi"
                                                    name="judul_materi" value="{{ $data->judul_materi }}"
                                                    placeholder="Masukkan Judul">
                                                @error('judul_materi')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="deskripsi_materi">Deskripsi Materi
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <textarea class="form-control" placeholder="Masukkan Deskripsi..." id="deskripsi_materi" name="deskripsi_materi"
                                                    rows="3">{{ $data->deskripsi_materi }}</textarea>
                                                @error('deskripsi_materi')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="kursus_id">Kursus
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <select class="form-control" id="kursus_id" name="kursus_id">
                                                    <option value="">Pilih Kursus</option>
                                                    @foreach ($data_kursus as $kursus)
                                                        <option value="{{ $kursus->id }}"
                                                            {{ $kursus->id == $data->kursus_id ? 'selected' : '' }}>
                                                            {{ $kursus->judul_kursus }}
                                                        </option>
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
                                                    rows="3">{{ $data->link_embed_materi }}</textarea>
                                                @error('link_embed_materi')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                                <div class="mt-3">
                                                    @php
                                                        $url = $data->link_embed_materi;
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
