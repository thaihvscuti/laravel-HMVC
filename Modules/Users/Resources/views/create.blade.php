@extends('core::layouts.admin')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 mb-2">
                <form method="post" action="{{ route('user.store') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('name')is-invalid @enderror" id="name">
                        <div class="invalid-feedback">@error('name') {{ $message }} @enderror</div>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email<span class="text-danger">*</span></label>
                        <input type="email" class="form-control" id="email">
                    </div>
                    <div class="action">
                        <a href="{{ route('user.index') }}" class="btn btn-secondary">Back</a>
                        <button type="submit" class="btn btn-primary ms-3">Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
