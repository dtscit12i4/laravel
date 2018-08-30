@extends('layouts.master')

@section('page')
    Create Users
@endsection

@section('content')
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><strong>Sign In</strong></h3>
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


                        <form action="{{route('user.confirmadd')}}" method="post">

                            @csrf

                            <div class="form-group">
                                <label for="name">First Name:</label>
                                <input type="text" name="firstname" placeholder="firstname" id="firstname" value="{{ old('firstname') }}" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="name">Last Name:</label>
                                <input type="text" name="lastname" placeholder="lastname" id="lastname" value="{{ old('lastname') }}" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="email">Login Name:</label>
                                <input type="text" name="login_name" placeholder="login_name" id="login_name" value="{{ old('login_name') }}" class="form-control">
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
                                Admin <input type="radio" name="role" value="1" @if (old('role') == 1)
                                checked
                                @endif
                                >
                                NormalUser <input type="radio" name="role" value="0" @if (old('role') == 0)
                                checked
                                @endif
                                >
                            </div>

                            <div class="form-group">
                                <button class="btn btn-outline-info col-md-2"> Sign Up</button>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>
@endsection
