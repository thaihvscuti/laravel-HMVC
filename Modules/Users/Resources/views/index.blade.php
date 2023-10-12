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
                <form action="{{ route('user.index') }}" method="GET" class="row justify-content-end mb-2">
                    <div class="col-auto d-flex">
                        <input type="search" name="search" id="search" class="form-control" value="{{ request()->get('search') }}">
                        <button class="btn btn-primary" type="submit">Search</button>
                    </div>
                    <div class="col-auto btn-add-new text-end">
                        <a href="{{ route('user.create') }}" class="btn btn-primary">Add new</a>
                    </div>
                </form>
                <div class="pagination__container">
                    {!! $users->links() !!}
                </div>
                <div class="table-responsive-md">
                    <table class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">@sortablelink('name', 'Name')</th>
                            <th scope="col">@sortablelink('email', 'Email')</th>
                            <th scope="col">@sortablelink('created_at', 'Created at')</th>
                            <td></td>
                        </tr>
                        </thead>
                        <tbody>
                        @if(!$users->isEmpty())
                            @foreach($users as $key => $user)
                                <tr>
                                    <th scope="row">{{ ++$key }}</th>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ date('Y-m-d H:i', strtotime($user->created_at)) }}</td>
                                    <td class="text-center">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-outline-primary dropdown-toggle" data-coreui-toggle="dropdown" aria-expanded="false">
                                                Action
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item" href="{{ route('user.edit', $user->id) }}">Edit</a></li>
                                                <li>
                                                    <form action="{{ route('user.destroy', $user->id) }}" method="POST">
                                                        @csrf
                                                        {{ method_field('DELETE') }}
                                                        <button class="dropdown-item" type="submit">Delete</button>
                                                    </form>
                                                </li>
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
                    {!! $users->appends(\Request::except('page'))->render() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
