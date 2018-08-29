@extends('layouts.master')

@section('page')
    Add Confirm Users
@endsection

@section('content')
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><strong>Add Confirm</strong></h3>
                    </div>

                    <div class="panel-body">

                        <form action="/user/add" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="name">First Name:</label>
                                <input type="text" name="firstname" placeholder="firstname" id="firstname" value="{{ $user['firstname'] }}" class="form-control" readonly>
                            </div>

                            <div class="form-group">
                                <label for="name">Last Name:</label>
                                <input type="text" name="lastname" placeholder="lastname" id="lastname" value="{{ $user['lastname'] }}" class="form-control" readonly>
                            </div>

                            <div class="form-group">
                                <label for="email">Login Name:</label>
                                <input type="text" name="login_name" placeholder="login_name" id="login_name" value="{{ $user['login_name'] }}" class="form-control" readonly>
                            </div>
                            @if (isset($user['password']))
                            <div class="form-group">
                                <label for="password">Password:</label>
                                <input type="password" name="password" placeholder="Password" id="password" value="{{ $user['password'] }}" class="form-control" readonly>
                            </div>
                            @endif
                            <div class="form-group">
                                <label for="address">Role:</label>
                                Admin <input type="radio" name="role" value="1" @if ( $user['role'] == 1)
                                checked
                                @endif
                                >
                                NormalUser <input type="radio" name="role" value="0" @if ($user['role'] == 0)
                                checked
                                @endif
                                >
                            </div>

                            <div class="form-group">
                                <button class="btn btn-outline-info col-md-2">Add</button>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>
@endsection

@section('script')
    <script type="text/javascript">
        $().ready(function(){
            $(':radio:not(:checked)').attr('disabled', true);
        });
    </script>
@endsection