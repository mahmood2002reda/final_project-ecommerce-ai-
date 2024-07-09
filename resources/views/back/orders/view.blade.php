@extends('back.master')

@section('title','Order details page')
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
                     <h4>Order items

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
        <div class="shaddow bg-white p-3">
                   <h4 class="text-primary">
                    <i class="fa fa-shopping-cart text-dark"></i> Order details
                    <a href="{{url('/back/orders/')}}" class="btn btn-danger btn-sm float-end mx-1">Back</a>
                    <a href="{{url('/back/invoice/'.$order->id.'/generate')}}" class="btn btn-primary btn-sm float-end mx-1">Download Invoice</a>
                    <a href="{{url('/back/invoice/'.$order->id)}}" target="_blank" class="btn btn-warning btn-sm float-end mx-1">View Invoice</a>
                   </h4>
                   <hr>
              <div class="row">
                <div class="col-md-6">
                    <h5>Order Details</h5>
                    <hr>
                    <h6>Order Id:{{$order->id}}</h6>
                    <h6>Tracking Id/No:{{$order->tracking_no}}</h6>
                    <h6>Order Created Date:{{$order->created_at}} </h6>
                    <h6>Payment Mode:{{$order->payment_mode}}</h6>
                  <h6 class="border p-2 text-success">Order Status Message: <span class="text-uppercase">{{$order->status_message}}</span></h6>
                </div>
                  <div class="col-md-6">
                        <h5>User Details</h5>
                        <hr>
                        <h6>Full Name:{{$order->fullname}}</h6>
                        <h6>Email Id:{{$order->email}}</h6>
                        <h6>Phone:{{$order->phone}}</h6>
                        <h6 >Address:{{$order->address}}</h6>
                        <h6>Pin code:{{$order->pincode}}</h6>
                  </div>
              </div>
              <br/>
              <h5>Order Items</h5>
              <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                       <tr>
                       <th>Item ID</th>
                       <th>Image</th>
                       <th>Product</th>
                       <th>Price</th>
                       <th>Quantity</th>
                       <th>Total</th>
                       </tr>
                    </thead>
                    <tbody>
                        @php
                            $totalPrice=0;
                        @endphp
                       @foreach ($order->orderItems as $orderItem )
                       <tr>
                       <td width="10%">{{$orderItem->id}}</td>
                       <td width="10%">
                        @if ($orderItem->product && !$orderItem->product->productImages->isEmpty())
                        <img src="{{ asset($orderItem->product->productImages[0]->image) }}" style="width:50px; height:50px" alt="">
                         @else
                          <img src="" style="width:50px; height:50px" alt="">
                         @endif

                       </td>
                       <td>
                        {{ $orderItem->product->name ?? '' }}
                         @if ($orderItem->productOption && $orderItem->productOption->color)
                         <span>- Color: {{ $orderItem->productOption->color->name ?? '' }}</span>
                         @endif
                         @if ($orderItem->productOption && $orderItem->productOption->size)
                         <span>- Size: {{ $orderItem->productOption->size->name ?? '' }}</span>
                         @endif
                       </td>
                       <td width="10%">{{$orderItem->price ?? ''}}</td>
                       <td width="10%">{{$orderItem->quantity ?? ''}}</td>
                       <td width="10%" class="fw-bold">{{$orderItem->quantity * $orderItem->price ?? ''}}L.E</td>
                       @php
                           $totalPrice +=$orderItem->quantity * $orderItem->price;
                       @endphp
                    </tr>
                       @endforeach
                       <tr>
                        <td colspan="5">Total Amount</td>
                        <td colspan="1" class="fw-bold">{{$totalPrice}}L.E</td>
                       </tr>
                    </tbody>
               </table>

          <div>
        </div>
    </div>
  </div>
</div>
<div class="card border mt-3">
  <div class="card-body">
      <h4>Order process(Order Status Updates)</h4>
      <hr>
    <div class="row">
        <div class="col-md-5">
            <form action="{{url('back/orders/'.$order->id)}}" method="post">
               @csrf
               @method('PUT')
               <label for="">Update your order status</label>
               <div class="input-group">
                 <select name="order_status" id="" class="form-select">
                    <option value="">Select Order status</option>
                    <option value="in progress" {{Request::get('status')=='in progress' ? 'selected':''}}>In progress</option>
                    <option value="completed" {{Request::get('status')=='completed'? 'selected':''}}>Completed</option>
                    <option value="pending"{{Request::get('status')=='pending'? 'selected':''}}>Pending</option>
                    <option value="cancalled"{{Request::get('status')=='cancalled'? 'selected':''}}>Cancalled</option>
                    <option value="out-for-delivery"{{Request::get('status')=='out-for-delivery'? 'selected':''}}>Out for delivery</option>
                 </select>
                 <button type="submit" class="btn btn-primary text-white">Update</button>
               </div>
              </form>
            </div>
            <div class="col-md-7">
                <br/>
                <h4 class="mt-3">Current order status: <span class="text-uppercase">{{$order->status_message}}</span></h4>
            </div>
         </div>
     </div>
    </div>
</div>



@endsection
