@extends('back.master')

@section('title','users list page')
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
                    <h4>Admins
                        <a href="{{url('back/Admins/create')}}" class="btn btn-primary btn-sm text-white float-end">Add Admin</a>
                    </h4>
                </div>
                <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($Admins as $Admin)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $Admin->name }}</td>
                                <td>{{ $Admin->email }}</td>
                                <td>{{ $Admin->role->name }}</td>


                                {{-- <td>
                                    @if (!empty($Admin->password))
                                        <a href="{{ route('back.Admin.change-password', $Admin) }}" class="btn btn-primary btn-sm">Change Password</a>
                                    @else
                                        <span>Password not set</span>
                                    @endif
                                </td> --}}

{{--
                                <td>
                                    @if ($Admin->Brands->isNotEmpty())
                                    <a href="{{ url('back/Admin/'.$Admin->id.'/brands') }}" class="btn btn-primary btn-sm">Show related Brands</a>
                                    @else
                                    <span>No brands available</span>
                                    @endif
                                </td> --}}
                                <td>
                                    <a href="{{ url('back/Admins/'.$Admin->id.'/edit') }}" class="btn btn-success btn-sm">Edit</a>
                                    <a href="{{ url('back/Admins/'.$Admin->id.'/delete') }}" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this data?')">Delete</a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6">No Admins Available</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                  </div>
                  {{$Admins->links()}}
                </div>
            </div>
        </div>
    </div>

@endsection
