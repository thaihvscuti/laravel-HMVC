@extends('core::layouts.admin')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12 col-md-6 mb-2">
                <div class="card pt-5 pb-5 ps-4 pe-4">
                    <form method="post" action="{{ route('user.store') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('name')is-invalid @enderror" id="name" name="name" value="{{ old('name') }}">
                            <div class="invalid-feedback">@error('name') {{ $message }} @enderror</div>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email<span class="text-danger">*</span></label>
                            <input type="email" class="form-control @error('email')is-invalid @enderror" id="email" name="email" value="{{ old('email') }}">
                            <div class="invalid-feedback">@error('email') {{ $message }} @enderror</div>
                        </div>
                        <div class="action d-flex justify-content-center">
                            <a href="{{ route('user.index') }}" class="btn btn-secondary">Back</a>
                            <button type="submit" class="btn btn-primary ms-1">Create</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
