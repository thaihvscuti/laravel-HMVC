@extends('core::layouts.admin')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                @if (Session::has('message-success'))
                    <div class="alert alert-success alert-dismissible fade show">
                        {{ Session::get('message-success') }}
                        <button type="button" class="btn-close" data-coreui-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                @if (Session::has('message-error'))
                    <div class="alert alert-danger alert-dismissible fade show">
                        {{ Session::get('message-error') }}
                        <button type="button" class="btn-close" data-coreui-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <form action="{{ route('setting.index') }}" method="GET" class="row justify-content-end mb-2">
                    <div class="col-auto d-flex">
                        <input type="search" name="search" id="search" class="form-control" value="{{ request()->get('search') }}">
                        <button class="btn btn-primary" type="submit">Search</button>
                    </div>
                </form>
                <div class="pagination__container">
                    {!! $modules->links() !!}
                </div>
                <div class="table-responsive-md">
                    <table class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">@sortablelink('name', 'Name')</th>
                            <th scope="col">@sortablelink('status', 'Status')</th>
                            <th scope="col">@sortablelink('created_at', 'Created at')</th>
                            <td></td>
                        </tr>
                        </thead>
                        <tbody>
                        @if(!$modules->isEmpty())
                            @foreach($modules as $key => $module)
                                <tr>
                                    <th scope="row">{{ ++$key }}</th>
                                    <td>{{ $module->name }}</td>
                                    <td>{{ $module->status_text }}</td>
                                    <td>{{ date('Y-m-d H:i', strtotime($module->created_at)) }}</td>
                                    <td class="text-center">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-outline-primary dropdown-toggle" data-coreui-toggle="dropdown" aria-expanded="false">
                                                Action
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item" href="{{ route('setting.edit', $module->id) }}">Edit</a></li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="5">No data</td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                </div>
                <div class="pagination__container">
                    {!! $modules->appends(\Request::except('page'))->render() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
