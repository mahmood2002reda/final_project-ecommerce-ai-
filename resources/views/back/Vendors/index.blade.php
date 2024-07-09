@extends('back.master')

@section('title','back home page')
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
                    <h4 class="d-flex align-items-center justify-content-between">
                        <span>Vendors</span>
                        <div style="display: flex; align-items: center;">
                            <form method="get" action="{{route('back.vendors.search')}}">
                                <div style="display: flex; align-items: center;">
                                    <input type="search" name="query" class="form-control form-control-sm rounded" placeholder="Search" aria-label="Search" aria-describedby="search-addon" style="margin-right: 4px;" />
                                    <button type="submit" class="btn btn-outline-danger btn-sm">Search</button>
                                </div>
                            </form>
                        </div>
                        <a href="{{url('back/vendor/create')}}" class="btn btn-primary btn-sm">Add vendor</a>
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
                                {{-- <th>password</th> --}}
                                <th>brands</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($vendors as $vendor)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $vendor->name }}</td>
                                <td>{{ $vendor->email }}</td>


                                {{-- <td>
                                    @if (!empty($vendor->password))
                                        <a href="{{ route('back.vendor.change-password', $vendor) }}" class="btn btn-primary btn-sm">Change Password</a>
                                    @else
                                        <span>Password not set</span>
                                    @endif
                                </td> --}}


                                <td>
                                    @if ($vendor->Brands->isNotEmpty())
                                    <a href="{{ url('back/vendor/'.$vendor->id.'/brands') }}" class="btn btn-primary btn-sm">Show related Brands</a>
                                    @else
                                    <span>No brands available</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ url('back/vendor/'.$vendor->id.'/edit') }}" class="btn btn-success btn-sm">Edit</a>
                                    <a href="{{ url('back/vendor/'.$vendor->id.'/delete') }}" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this data?')">Delete</a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6">No vendors Available</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                  </div>
                  {{$vendors->links()}}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
