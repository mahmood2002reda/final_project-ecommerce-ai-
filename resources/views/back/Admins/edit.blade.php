@extends('back.master')

@section('title', 'Edit Vendor')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Edit user   <a href="{{url('back/Admins')}}" class="btn btn-danger text-white float-end">Back</a></h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('back.Admin.update', $admin->id) }}" method="post">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" name="name" id="name" value="{{ $admin->name }}" class="form-control">
                                @error('name')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" name="email" id="email" value="{{ $admin->email }}" class="form-control">
                                @error('email')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div >

                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" name="password" id="password" class="form-control">
                                @error('password')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="role">Role</label>
                                <select name="role_id" id="role"  class="form-control">
                                    @foreach($roles as $role)
                                        <option value="{{ $role->id }}" {{ $admin->role_id == $role->id ? 'selected' : '' }}>{{ $role->name }}</option>
                                    @endforeach
                                </select>
                                @error('role_id')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <br> <br>
                            <button type="submit" class="btn btn-primary btn-sm">Update user</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
