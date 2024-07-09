@extends('back.master')

@section('title', 'Vendor Brands')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-md-12">
            @if(session('message'))
            <div class="alert @if(session('message_type') === 'error') alert-warning @else alert-success @endif">
               {{ session('message') }}
            </div>
         @endif

            <div class="card">
                <div class="card-header">
                    <h4>Related Brands for {{ $vendor->name }}  <a href="{{url('back/vendor')}}" class="btn btn-danger text-white float-end">Back</a></h4>
                </div>
                <div class="card-body">
                    @if ($brands->isNotEmpty())
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Slug</th>
                                    <th>active</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($brands as $brand)
                                    <tr>
                                        <td>{{ $brand->id }}</td>
                                        <td>{{ $brand->name }}</td>
                                        <td>{{ $brand->slug }}</td>
                                        <td>{{$brand->active=='1'?'visible':'hidden'}}</td>


                                        <td>

                                           <a href="{{url('back/brands/'.$brand->id.'/edit')}}" class="btn btn-success btn-sm ">Edit</a>
                                           <a href="{{url('back/vendor/'.$brand->id.'/delete-brand')}}" class="btn btn-danger btn-sm ">delete</a>



                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <h4>No brands available for this vendor</h4>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
