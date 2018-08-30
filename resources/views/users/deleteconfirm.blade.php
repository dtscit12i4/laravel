@extends('layouts.master')

@section('page')
    Delete Confirm Users
@endsection

@section('content')
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><strong>Delete Confirm</strong></h3>
                    </div>

                    <div class="panel-body">

                        <form action="{{route('user.destroy')}}" method="post">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" name="id" value="{{ $user->id }}">
                            
                            <div class="form-group">
                                <label for="email">Login Name:</label>
                                <p>{{ $user->login_name }}</p>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-outline-info col-md-2">Delete</button>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>
@endsection