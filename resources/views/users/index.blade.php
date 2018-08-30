@extends('layouts.master')

@section('page')
    Users
@endsection

@section('content')

    <div class="row">

        <div class="col-md-12">
            <form class="form-inline" action="{{route('user.index')}}" method="get">
                <input type="text" name="login_name" value="{{ request()->login_name }}"
                       class="form-control mb-2 mr-sm-2" id="inlineFormInputName2" placeholder="Search...">
                <select class="custom-select my-1 mr-sm-2 form-control" id="inlineFormCustomSelectPref" name="role">
                    <option value="">Role...</option>
                    @foreach (\App\Enums\UserRole::values() as $user)
                        <option value="{{$user}}" {{ $user == request()->role ? 'selected' : null }}>{{\App\Enums\UserRole::getRole($user)}}</option>
                    @endforeach
                </select>
                <button type="submit" class="btn btn-primary mb-2">Submit</button>

            </form>
            <br/>
            <a href="{{route('user.getadd')}}" class='btn btn-success btn-sm create-user'>Add User</a>
            <br/>
            <br/>
            @include('layouts.message')
            <div class="card">
                <div class="header">
                    <h4 class="title">Users</h4>
                    <p class="category">List of all registered users</p>
                </div>
                <div class="content table-responsive table-full-width">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Login Name</th>
                            <th>Role</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)

                            <tr>

                                <td>{{ $user->firstname }}</td>
                                <td>{{ $user->lastname }}</td>
                                <td>{{ $user->login_name }}</td>
                                <td>{{ $user->role ? 'Admin' : 'NormalUser' }}</td>
                                <td>
                                    <div class="row">
                                        <div class="col-md-2">
                                            <form method="POST" action="{{route('user.confirmuserdelete')}}">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $user->id }}">
                                                <button class='btn btn-success btn-sm'>Delete</button>
                                            </form>
                                        </div>
                                        <div class="col-md-2">
                                            <form method="POST" action="{{route('user.getuseredit')}}">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $user->id }}">
                                                <button class='btn btn-success btn-sm' type="submit">Edit</button>
                                            </form>
                                        </div>
                                    </div>
                                </td>

                            </tr>
                        @endforeach

                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>

@endsection