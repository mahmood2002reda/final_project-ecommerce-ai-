@extends('back.master')

@section('title','reset password page')
@section('content')

<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-md-12" wire:poll.10s>
            @if(session('message'))
               <div class="alert @if(session('message_type') === 'error') alert-warning @else alert-success @endif">
                  {{ session('message') }}
               </div>
            @endif

            <div class="card">
                <div class="card-header">
                    <h4>Reset password
                        <a href="{{route('back.admin.profile')}}" class="btn btn-danger text-white float-end">Back</a>
                    </h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('back.admin.password.update') }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="old_password">Old Password</label>
                            <input type="password" class="form-control" name="old_password" placeholder="Old Password">
                            @error('old_password')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <br>

                        <div class="form-group">
                            <label for="new_password">New Password</label>
                            <input type="password" class="form-control" name="new_password" placeholder="New Password">
                            @error('new_password')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="new_password">Confirm Password</label>
                            <input type="password" class="form-control" name="confirm_password" placeholder="confirm_password">
                            @error('confirm_password')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <br>

                        <button type="submit" class="btn btn-primary btn-sm">Reset Password</button>
                    </form>
                  {{-- {{$users->links()}} --}}
                </div>
            </div>
        </div>
    </div>

@endsection
