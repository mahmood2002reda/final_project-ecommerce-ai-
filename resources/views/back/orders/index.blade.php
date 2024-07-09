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
            {{-- @if(session('message'))
            <div class="alert alert-success">



                {{session('message')}}




            </div>

          @endif --}}

          <div class="card">

              <div class="card-header">

                     <h4>Orders

                        <a href="{{url('/back/orders/')}}" class="btn btn-danger btn-sm float-end">Back</a>

                     </h4>
                     {{-- <div style="display: flex; align-items: center;">
                        <form method="get" action="{{route('back.product.search')}}">
                            <div style="display: flex; align-items: center;">
                                <input type="search" name="query" class="form-control form-control-sm rounded" placeholder="Search" aria-label="Search" aria-describedby="search-addon" style="margin-right: 4px;" />
                                <button type="submit" class="btn btn-outline-danger btn-sm">Search</button>
                        </form>
                     </div> --}}



              </div>

              <div class="card-body">
                 <form action="" method="get">
                    @csrf
                <div class="row">
                           <div class="col-md-3">
                            <label for="">Filter by Date</label>
                            <input type="date" name="date" value="{{Request::get('date') ?? date('Y-m-d')}}" class="form-control">
                           </div>

                        <div class="col-md-3">
                         <label for="">Filter by Status</label>
                         <select name="status" class="form-select">
                            <option value="">Select All status</option>
                            <option value="in progress" {{Request::get('status')=='in progress' ? 'selected':''}}>In progress</option>
                            <option value="completed" {{Request::get('status')=='completed'? 'selected':''}}>Completed</option>
                            <option value="pending"{{Request::get('status')=='pending'? 'selected':''}}>Pending</option>
                            <option value="cancalled"{{Request::get('status')=='cancalled'? 'selected':''}}>Cancalled</option>
                            <option value="out-for-delivery"{{Request::get('status')=='out-for-delivery'? 'selected':''}}>Out for delivery</option>
                         </select>
                        </div>
                        <div class="col-md-6">
                            <br/>
                            <button type="submit" class="btn btn-primary ">Filter</button>
                        </div>
                </div>

                 </form>
                <hr/>


             <div class="table-responsive">

                <table class="table table-bordered table-striped">

                    <thead>
                       <tr>
                       <th>Order ID</th>
                       <th>Tracking No</th>
                       <th>Username</th>
                       <th>Payment Mode</th>
                       <th>Ordered Date</th>
                       <th>Status Message</th>
                       <th>Actions</th>
                       </tr>



                    </thead>

                    <tbody>


                          <?php  $i=0;?>

                         @forelse ($orders as $order )
                         <?php $i++?>
                         <tr>
                                   <td>{{$i}}</td>
                         <td>{{$order->tracking_no}}</td>
                         <td>{{$order->fullname}}</td>
                         <td>{{$order->payment_mode}}</td>
                         <td>{{$order->created_at->format('d-m-Y')}}</td>
                         <td>{{$order->status_message}}</td>
                         <td><a href="{{url('/back/orders/'.$order->id)}}" class="btn btn-primary btn-sm">View</a></td>
                        </tr>
                         @empty
                         <tr>
                            <td colspan="7">No Orders Available</td>
                         </tr>

                         @endforelse
































                    </tbody>





               </table>

               <div>
                 {{$orders->links()}}
               </div>










            </div>













        </div>









      </div>






    </div>


</div>

@endsection
