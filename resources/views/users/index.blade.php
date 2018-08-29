@extends('layouts.master')

@section('page')
    Users
@endsection

@section('content')

    <div class="row">

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Delete User</h4>
      </div>
      <div class="modal-body">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="delete-btn">Delete</button>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Create/Edit user</h4>
      </div>
      <div class="modal-body">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="edit-btn">Edit</button>
      </div>
    </div>
  </div>
</div>
        <div class="col-md-12">
            <form class="form-inline" action="/user" method="get">
                <input type="text" name="login_name" class="form-control mb-2 mr-sm-2" id="inlineFormInputName2" placeholder="Search...">
                <select class="custom-select my-1 mr-sm-2" id="inlineFormCustomSelectPref" name="role">
                    <option value="">Role...</option>
                    @foreach ($userss as $user)
                        <option value="{{$user->role}}">{{$user->role == 1 ? 'Admin' : 'NormalUser'}}</option>
                    @endforeach
                </select>
                <button type="submit" class="btn btn-primary mb-2">Submit</button>

            </form>
            <br />
            <a href="/user/add" class='btn btn-success btn-sm create-user'>Add User</a>
            <br />
            <br />
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
                                            <form method="POST" action="/user/deleteconfirm">
                                            @csrf
                                                <input type="hidden" name="id" value="{{ $user->id }}">
                                                <button class='btn btn-success btn-sm'>Delete</button>
                                            </form>
                                        </div>
                                        <div class="col-md-2">
                                           <form method="POST" action="/user/edit">
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