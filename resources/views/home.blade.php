@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        {{-- <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>
            </div>
        </div> --}}

        <div class="col-md-12">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Avatar</th>
                        <th>Firstname</th>
                        <th>Lastname</th>
                        <th>Email</th>
                        <th>State</th>
                        <th>Post Code</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($userlist as $useritem)
                    <tr>
                        <td><img src="{{ $useritem->avatar }}"/></td>
                        <td>{{ $useritem->first_name }}</td>
                        <td>{{ $useritem->last_name }}</td>
                        <td>{{ $useritem->user->email }}</td>
                        <td>{{ $useritem->state }}</td>
                        <td>{{ $useritem->postcode }}</td>
                        <td><a href="{{ url('/edit/' . $useritem->user_id ) }}">Edit</a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $userlist->links() }}
        </div>
    </div>
</div>
@endsection
