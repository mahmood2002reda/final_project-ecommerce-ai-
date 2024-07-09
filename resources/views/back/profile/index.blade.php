@extends('back.master')

@section('title','Admin profile page')
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
                    <h4>My profile

                    </h4>
                </div>
                <div class="card-body">
                <div class="table-responsive">



               <table class="table able-bordered table-striped">
                          <thead class="thead-dark">
                            <tr>
                           <th scope="col">#</th>
                            <th scope="col"> name</th>
                           <th scope="col">email </th>

                              </tr>
                         </thead>
                      <tbody>

                                @foreach ($Admin as $item)
                     <tr>
                                         <th scope="row">#</th>
                                        <td>{{$item->name}}</td>
                                         <td>{{$item->email}}</td>






                        <td>
                               <div class="container text-center">
                                    <div class="row">
                                   <div class="col">
                                  <a  class="btn btn-success btn-sm" href="{{route('back.admin.password.reset')}}"> reset password</a>
                             </div>
                                 <div class="col">
                                 <a class="btn btn-primary btn-sm" href="{{route('back.admin.info.reset')}}">  Admin information</a>
                               </div>
                               <div class="col">
                                 <form action="{{route('back.admin.info.delete')}}" method="POST">
                                      @csrf
                                      @method('delete')
                                       <input type="submit" value="delete account" class="btn btn-danger btn-sm">
                                 </form>
                                 </div>
                               </div>

                        </td>
                </tr>

                @endforeach

               </tbody>
              </table>
                  </div>
                  {{-- {{$users->links()}} --}}
                </div>
            </div>
        </div>
    </div>

@endsection




















































