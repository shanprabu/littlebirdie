@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        @if($errors->any())
        <div class="col-md-12">
            <div class="alert alert-danger">
                <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
                </ul>
            </div>
        </div>
        @endif
        <div class="col-md-8">
            <form method="POST">
                @method("PUT")
                @csrf
                <input type="hidden" name="user_id" value="{{ $userinfo->user_id }}" />
                <div class="form-group row">
                    <div class="col-md-2">
                        <label>First Name</label>
                    </div>
                    <div class="col-md-10">
                        <input class="form-control" type="text" name="first_name" value="{{ $userinfo->first_name }}"/>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-2">
                        <label>Last Name</label>
                    </div>
                    <div class="col-md-10">
                        <input class="form-control" type="text" name="last_name" value="{{ $userinfo->last_name }}"/>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-2">
                        <label>Email</label>
                    </div>
                    <div class="col-md-10">
                        <input class="form-control" type="email" name="email" value="{{ $userinfo->user->email }}"/>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-2">
                        <label>Avatar</label>
                    </div>
                    <div class="col-md-10">
                        <input class="form-control" type="text" name="avatar" value="{{ $userinfo->avatar }}"/>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-2">
                        <label>State</label>
                    </div>
                    <div class="col-md-10">
                        <input class="form-control" type="text" name="state" value="{{ $userinfo->state }}"/>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-2">
                        <label>Post Code</label>
                    </div>
                    <div class="col-md-10">
                        <input class="form-control" type="text" name="postcode" value="{{ $userinfo->postcode }}"/>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary btn-lg">
                            Save
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
