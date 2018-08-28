@extends('admin.layouts.master')

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
            <button class='btn btn-success btn-sm create-user'>Add User</button>
            <br />
            <br />
            @include('admin.layouts.message')
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
                                    {{-- <form method="POST" action="{{ route('users.destroy', $user->id) }}"> --}}
                                    {{-- @csrf --}}
                                    {{-- @method('DELETE') --}}
                                   <button class='btn btn-success btn-sm delete-user' data-id="{{ $user->id }}">Delete</button>
                                   {{-- <a href="{{ route('users.edit', $user->id) }}" class="btn btn-success btn-sm" onclick='return confirm("Ban chac chan muon sua?")'>Edit</a> --}}
                                   <a href="javascript:void(0)" data-id="{{ $user->id }}" class="btn btn-success btn-sm edit-user">Edit</a>
                                    {{-- </form> --}}
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
@section('script')
    <script type="text/javascript">
        $().ready(function(){

            // delete user

            $('.delete-user').click(function(){
                const id = $(this).data('id');
                $('#myModal .modal-body').html("");
                $('#delete-btn').off('click');
                // const token = $(this).data('token');
                $.ajax({
                    dataType : "text",
                    url : "/admin/getname/" + id,
                    success : function(result)
                    {
                        $('#myModal .modal-body').html(result);
                        $('#delete-btn').click(function(){
                            $.ajax({
                                type : "post",
                                dataType : "text",
                                url : "/admin/getname/" + id,
                                data : {_token: token},
                                success : function(result)
                                {
                                    $('#myModal').modal('toggle');
                                    location.reload();
                                }
                            });
                        });
                    }
                });
                $('#myModal').modal();
            });

            // edit user

            $('.edit-user').click(function(){
                const id = $(this).data('id');
                $('#myModal1 .modal-body').html("");
                $('#edit-btn').off('click');
                // const token = $(this).data('token');
                $.ajax({
                    dataType : "text",
                    url : "/admin/edit/" + id,
                    success : function(result)
                    {
                        $('#myModal1 .modal-body').html(result);
                        $('#myModal1').modal();
                        $('#edit-btn').click(function(){
                            $('#myModal1 #content-edit').remove();
                            const data = {
                                _token: token,
                                firstname: $('#firstname').val(),
                                lastname: $('#lastname').val(),
                                login_name: $('#login_name').val(),
                                role: $("input[name='role']:checked").val(),
                            };
                            if ($('#password').val()) {
                                data.password = $('#password').val();
                                data.password_confirmation = $('#password_confirmation').val();
                            }
                            $.ajax({
                                type : "post",
                                dataType : "json",
                                url : "/admin/edit/" + id,
                                data : data,
                                success : function(result)
                                {
                                    $('#myModal1').modal('toggle');
                                    location.reload();
                                },
                                error: function(data){
                                    var errors = data.responseJSON;
                                    if (errors) {
                                        var li = '';
                                        $.each( errors.errors, function( key, value ) {
                                            li += '<li>' + value +'</li>'
                                        });
                                        var content = `<div id="content-edit" class="alert alert-danger">
                                                <ul>
                                                    ${li}
                                                </ul>
                                            </div>`;
                                        $('#myModal1 .modal-body').prepend(content);
                                    }
                                }
                            });
                        });
                    },
                });
                // $('#myModal1').modal();
            });

            // create user
            $('.create-user').click(function(){
                $('#myModal1 .modal-body').html("");
                $('#edit-btn').off('click');
                // const token = $(this).data('token');
                $.ajax({
                    dataType : "text",
                    url : "/admin/register",
                    success : function(result)
                    {
                        $('#myModal1 .modal-body').html(result);
                        $('#myModal1').modal();
                        $('#edit-btn').click(function(){
                            $('#myModal1 #content-create').remove();
                            const data = {
                                _token: token,
                                firstname: $('#firstname').val(),
                                lastname: $('#lastname').val(),
                                password: $('#password').val(),
                                password_confirmation: $('#password_confirmation').val(),
                                login_name: $('#login_name').val(),
                                role: $("input[name='role']:checked").val(),
                            };
                            
                            $.ajax({
                                type : "post",
                                dataType : "json",
                                url : "/admin/register",
                                data : data,
                                success : function(result)
                                {
                                    $('#myModal1').modal('toggle');
                                    location.reload();
                                },
                                error: function(data){
                                    var errors = data.responseJSON;
                                    if (errors) {
                                        var li = '';
                                        $.each( errors.errors, function( key, value ) {
                                            li += '<li>' + value +'</li>'
                                        });
                                        var content = `<div id="content-create" class="alert alert-danger">
                                                <ul>
                                                    ${li}
                                                </ul>
                                            </div>`;
                                        $('#myModal1 .modal-body').prepend(content);
                                    }
                                }
                            });
                        });
                    },
                });
                // $('#myModal1').modal();
            });
        })
    </script>
@endsection