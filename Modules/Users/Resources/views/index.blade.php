@extends('core::layouts.admin')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="pagination__container">
                    {!! $users->links() !!}
                </div>
                <div>
                    <form action="">

                    </form>
                    <div class="btn-add-new text-end mb-3">
                        <a href="{{ route('user.create') }}" class="btn btn-primary">Add new</a>
                    </div>
                </div>
                <div class="table-responsive-md">
                    <table class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Created at</th>
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
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>
                <div class="pagination__container">
                    {!! $users->links() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
