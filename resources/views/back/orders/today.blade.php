@extends('back.master')

@section('title','back home page')
@section('content')


<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
      <div class="col-md-12">
        <div class="shaddow bg-white p-3">
            <h4 class="mb-4">today Orders</h4>
             <hr>
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
                         <td>{{$order->created_at->format('d-m-y')}}</td>
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
