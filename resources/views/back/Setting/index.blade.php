@extends('back.master')

@section('title','Admin Setting')
@section('content')


<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-md-12 grid-margin" >
            @if(session('message'))
               <div class="alert @if(session('message_type') === 'error') alert-warning @else alert-success @endif">
                  {{ session('message') }}
               </div>
           @endif
           <form action="{{url('/back/settings')}}" method="post">
            @csrf
            <div class="card mb-3">
                <div class="card-header bg-primary"><h3 class="text-white mb-0">App</h3></div><br>
                 <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="">Application Name</label>
                            <input type="text" name="App_name" value="{{$setting->App_name ?? ''}}" class="form-control">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="">Application url</label>
                            <input type="text" name="App_url" value="{{$setting->App_url ?? ''}}" class="form-control">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="">Page title</label>
                            <input type="text" name="page_title" value="{{$setting->page_title ?? ''}}" class="form-control">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="">Meta Keywords</label>
                            <textarea name="meta_keyword" class="form-control" id="" rows="3">{{$setting->meta_keyword ?? ''}}</textarea>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="">Meta Description</label>
                            <textarea name="meta_description" class="form-control" id="" rows="3">{{$setting->meta_description ?? ''}}</textarea>
                        </div>
                    </div>
                 </div>
                </div>





                <div class="card mb-3">
                    <div class="card-header bg-primary"><h3 class="text-white mb-0">App-information</h3></div><br>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="">Address</label>
                                <textarea name="address" class="form-control" id="" rows="3">{{$setting->address ?? ''}}</textarea>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="">phone 1 *</label>
                                <input type="text" name="phone1" value="{{$setting->phone1 ?? ''}}" class="form-control">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="">Phone No.2</label>
                                <input type="text" name="phone2" value="{{$setting->phone2 ?? ''}}" class="form-control">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="">Email Id 1</label>
                                <input type="text" name="email1" value="{{$setting->email1 ?? ''}}" class="form-control">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="">Email Id 2</label>
                                <input type="text" name="email2" value="{{$setting->email2 ?? ''}}" class="form-control">
                            </div>
                        </div>
                     </div>
                 </div>


                <div class="card mb-3">
                    <div class="card-header bg-primary"><h3 class="text-white mb-0">App-Social Media</h3></div><br>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="">Facebook(Optional)</label>
                                <input type="text" name="facebook" value="{{$setting->facebook ?? ''}}" class="form-control">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="">Twitter(Optional)</label>
                                <input type="text" name="twitter" value="{{$setting->twitter ?? ''}}" class="form-control">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="">Instagram(Optional)</label>
                                <input type="text" name="instagram" value="{{$setting->instagram ?? ''}}" class="form-control">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="">Youtube(Optional)</label>
                                <input type="text" name="youtube" value="{{$setting->youtube ?? ''}}" class="form-control">
                            </div>
                        </div>
                     </div>
                 </div>

                   <div class="text-end">
                     <button type="submit" class=" btn btn-primary text-white">save settings</button>
                   </div>






           </form>


        </div>
     </div>
</div>


@endsection

