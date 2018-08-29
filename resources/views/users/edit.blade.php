@extends('layouts.master')

@section('page')
    Edit Users
@endsection

@section('content')
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><strong>Edit</strong></h3>
                    </div>

                    <div class="panel-body">

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        @if ( session()->has('msg') )
                            <div class="alert alert-success">{{ session()->get('msg') }}</div>
                        @endif


                        <form action="/user/editconfirm" method="post">

                            @csrf
                            <input type="hidden" name="id" value="{{ $user->id ?? old('id') }}">
                            <div class="form-group">
                                <label for="name">First Name:</label>
                                <input type="text" name="firstname" placeholder="firstname" id="firstname" value="{{ $user->firstname ?? old('firstname') }}" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="name">Last Name:</label>
                                <input type="text" name="lastname" placeholder="lastname" id="lastname" value="{{ $user->lastname ?? old('lastname') }}" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="email">Login Name:</label>
                                <input type="text" name="login_name" placeholder="login_name" id="login_name" value="{{ $user->login_name ?? old('login_name') }}" class="form-control" readonly>
                            </div>

                            <div class="form-group">
                                <label for="password">Password:</label>
                                <input type="password" name="password" placeholder="Password" id="password" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="password_confirmation">Confirm Password:</label>
                                <input type="password" name="password_confirmation" placeholder="Confirm Password" id="password_confirmation" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="address">Role:</label>
                                @php $role = isset($user->role) ? $user->role : old('role') @endphp
                                Admin <input type="radio" name="role" value="1" {{ $role ? 'checked' : null }}>
                                NormalUser <input type="radio" name="role" value="0" {{ $role ? null : 'checked' }}>
                            </div>

                            <div class="form-group">
                                <button class="btn btn-outline-info col-md-2"> Edit</button>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>
@endsection
