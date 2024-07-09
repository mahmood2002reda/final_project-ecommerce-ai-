@extends('back.master')

@section('title','sizes home page')
@section('content')


<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-md-12" wire:poll.10s>
            @if(session('message'))
               <div class="alert @if(session('message_type') === 'error') alert-warning @else alert-success @endif">
                  {{ session('message') }}
               </div>
           @endif
            {{-- @if(session('message'))
            <div class="alert alert-success">



                {{session('message')}}




            </div>

          @endif --}}

          <div class="card">

            <div class="card-header">
                <h4 class="d-flex align-items-center justify-content-between">
                    <span>Sizes</span>
                    <div style="display: flex; align-items: center;">
                        <form method="get" action="{{route('back.size.search')}}">
                            <div style="display: flex; align-items: center;">
                                <input type="search" name="query" class="form-control form-control-sm rounded" placeholder="Search" aria-label="Search" aria-describedby="search-addon" style="margin-right: 4px;" />
                                <button type="submit" class="btn btn-outline-danger btn-sm">Search</button>
                            </div>
                        </form>
                    </div>
                    <a href="{{url('back/sizes/create')}}" class="btn btn-primary btn-sm">Add size</a>
                </h4>
            </div>

              <div class="card-body">
                    <table class="table table-bordered table-striped">

                         <thead>
                            <tr>
                            <th>ID</th>
                            <th>Name</th>
                            {{-- <th>Code</th> --}}
                            <th>status</th>
                            <th>Actions</th>
                            </tr>



                         </thead>

                         <tbody>


                               <?php  $i=0;?>

                              @foreach ($sizes as $size )
                                  <?php $i++; ?>

                              <tr>
                                <td>{{$i}}</td>
                                <td>{{$size->size}}</td>
                                {{-- <td>{{$size->code}}</td> --}}
                                <td>{{$size->active == '1' ? 'visible':'hidden'}}</td>
                                <td>
                                     <a href="{{url('back/sizes/'.$size->id.'/edit')}}"class="btn btn-primary btn-sm" >Edit</a>
                                     <a href="{{url('back/sizes/'.$size->id.'/delete')}}" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure, you want to delete this data?')">Delete</a>

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

@endsection
