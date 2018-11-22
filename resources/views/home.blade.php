@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>
                @hasrole('worker')
                    <h1>i am a worker</h1>
                    @else
                    <h1>i am not a worker</h1>
                @endhasrole
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>

                @hasrole('manager')
                <form action="{{ route('createMember') }}" method="POST">
                    {{ csrf_field() }}
                    <div class="form-group">
                      <label for="name">name</label>
                      <input type="text" name="name" class="form-control" id="name"  placeholder="Enter name">
                     </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Email address</label>
                      <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                     </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Password</label>
                      <input type="password" name="password"   class="form-control" id="exampleInputPassword1" placeholder="Password">
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">select user role</label>
                        <select name="role" class="form-control" id="exampleFormControlSelect1">
                          @foreach ($allRoles as $role)
                            <option value="{{ $role->name }}">{{ $role->name }}</option>
                          @endforeach
                        </select>
                      </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </form>
            @else
                <h1>i am not a manager... only manager can create users</h1>
            @endhasrole






            </div>
        </div>
    </div>
</div>
@endsection
