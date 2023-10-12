@extends('core::layouts.admin')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12 col-md-6 mb-2">
                <div class="card pt-5 pb-5 ps-4 pe-4">
                    <form method="POST" action="{{ route('setting.update', $module->id) }}">
                        {{ method_field('PUT') }}
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="col-6 form-label text-end">Name: </label>
                            <span class="col-6 ms-3">{{ $module->name }}</span>
                        </div>
                        <div class="form-check form-switch mb-4 d-flex ps-0">
                            <label class="col-6 form-check-label text-end" for="status">Status: </label>
                            <div class="col-6">
                                <input class="form-check-input ms-3" type="checkbox" name="status" id="status" @if($module->status) checked @endif>
                            </div>
                        </div>
                        <div class="action d-flex justify-content-center">
                            <a href="{{ route('setting.index') }}" class="btn btn-secondary">Back</a>
                            <button type="submit" class="btn btn-primary ms-1">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
