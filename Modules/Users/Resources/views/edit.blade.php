@extends('core::layouts.admin')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 mb-2">
                <form method="POST" action="{{ route('user.update', $user->id) }}">
                    {{ method_field('PUT') }}
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('name')is-invalid @enderror" id="name" value="{{ $user->name }}" name="name">
                        <div class="invalid-feedback">@error('name') {{ $message }} @enderror</div>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email<span class="text-danger">*</span></label>
                        <input type="email" class="form-control @error('email')is-invalid @enderror" id="email" value="{{ $user->email }}" name="email">
                        <div class="invalid-feedback">@error('email') {{ $message }} @enderror</div>
                    </div>
                    <div class="action">
                        <a href="{{ route('user.index') }}" class="btn btn-secondary">Back</a>
                        <button type="submit" class="btn btn-primary ms-1">Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
