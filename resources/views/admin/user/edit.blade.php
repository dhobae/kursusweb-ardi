@extends('admin.layouts.index')

@section('content')
    <section class="content">
        <form action="{{ route('user-update', $data->id) }}" enctype="multipart/form-data" method="POST">
            @csrf
            @method('PUT')
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-xl-8 order-xl-1">
                        <div class="card">
                            <div class="card-header">
                                <div class="row align-items-center">
                                    <div class="col-8">
                                        <h3 class="mb-0">Edit profile </h3>
                                    </div>
                                    <div class="col-4 text-right">
                                        <a href="{{ route('user-list') }}" class="btn btn-secondary" title="Back/Cancel">
                                            <i class="fas fa-arrow-left"></i>
                                        </a>
                                        <button type="submit" title="Save Changes" class="btn btn-primary"><span
                                                class="fas fa-save"></span></button>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <h6 class="heading-small text-muted mb-4">User information</h6>
                                <div class="pl-lg-4">
                                    {{-- row --}}
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="Name">Name
                                                </label>
                                                <input type="text" class="form-control" id="Name"
                                                    {{ $data->hasRole('admin') ? 'disabled' : '' }} placeholder="Name User"
                                                    name="name" value="{{ $data->name }}">
                                                @error('name')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="email">Email address
                                                </label>
                                                <input type="email" class="form-control" id="email"
                                                    {{ $data->hasRole('admin') ? 'disabled' : '' }} placeholder="Email"
                                                    name="email" value="{{ $data->email }}">
                                                @error('email')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        {{-- 
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="old_Password">Current Password
                                                </label>
                                                <input type="password" class="form-control" id="old_Password"
                                                    placeholder="Ur Current Password" name="old_password"
                                                    value="{{ old('old_password') }}">
                                                @error('old_password')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div> --}}
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="new_Password">New Password
                                                </label>
                                                <input type="password" class="form-control" id="new_Password"
                                                    placeholder="New Password" name="new_password"
                                                    value="{{ old('new_password') }}">
                                                @error('new_password')
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
