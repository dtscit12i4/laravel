@extends('admin.layouts.master')

@section('page')
    Results
@endsection

@section('content')

    <div class="row">

        <div class="col-md-12">
            <div class="card">
                <div class="header">
                    <h4 class="title">Results</h4>
                    <p class="category">List of all results</p>
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
                        @foreach($result as $user)

                            <tr>

                                <td>{{ $user->firstname }}</td>
                                <td>{{ $user->lastname }}</td>
                                <td>{{ $user->login_name }}</td>
                                <td>{{ $user->role ? 'Admin' : 'NormalUser' }}</td>
                                <td>
                                    {{ Form::open(['route' => ['users.destroy', $user->id], 'method' => 'DELETE']) }}
                                   {{ Form::button('Delete', ['type'=> 'submit', 'class'=>'btn btn-success btn-sm', 'onclick' => 'return confirm("Ban chac chan muon xoa?")']) }}
                                   {{ link_to_route('users.edit', 'Edit', $user->id, ['class'=>'btn btn-success btn-sm', 'onclick' => 'return confirm("Ban chac chan muon sua?")']) }}

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