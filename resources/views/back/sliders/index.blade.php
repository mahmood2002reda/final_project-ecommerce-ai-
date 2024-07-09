@extends('back.master')

@section('title', 'Back Home Page')
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
                        <span>Sliders list</span>
                        <div style="display: flex; align-items: center;">
                            <form method="get" action="{{ route('back.category.search') }}">
                                <div style="display: flex; align-items: center;">
                                    <input type="search" name="query" class="form-control form-control-sm rounded" placeholder="Search" aria-label="Search" aria-describedby="search-addon" style="margin-right: 4px;" />
                                    <button type="submit" class="btn btn-outline-danger btn-sm">Search</button>
                                </div>
                            </form>
                        </div>
                        <a href="{{ url('back/sliders/create') }}" class="btn btn-primary btn-sm">Add Slider</a>
                    </h4>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Image</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sliders as $slider)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $slider->title }}</td>
                                    <td>{{ $slider->description }}</td>
                                    <td>           @if ($slider->image)
                                        <img src="{{ asset($slider->image) }}" style="width: 90px; height: 90px;" alt="">
                                    @else
                                        <img src="{{ asset('uploads/slider/image-not-found.png') }}" style="width: 70px; height: 70px;" alt="Image Not Found">
                                    @endif</td>
                                    <td>{{ $slider->active == '1' ? 'visible' : 'hidden' }}</td>
                                    <td>
                                        <div class="btn-group">
                                        <a href="{{ url('back/sliders/'.$slider->id.'/edit') }}" class="btn btn-success btn-sm" style="margin-right:5px; ">Edit</a>
                                        <a href="{{ url('back/sliders/'.$slider->id.'/delete') }}" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this data?')">Delete</a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                  </div>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    .btn-group a + a {
        margin-left: 5px;
    }
</style>

@endsection
