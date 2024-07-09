@extends('back.master')

@section('title', 'Edit Vendor')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Edit Vendor   <a href="{{url('back/vendor')}}" class="btn btn-danger text-white float-end">Back</a></h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('back.vendor.update', $vendor->id) }}" method="post">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" name="name" value="{{ $vendor->name }}" required>
                                @error('name')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" name="email" value="{{ $vendor->email }}" required>
                                @error('email')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" name="password" required>
                                @error('password')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <br> <br>
                            <button type="submit" class="btn btn-primary btn-sm">Update Vendor</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
