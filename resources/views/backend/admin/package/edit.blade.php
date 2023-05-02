@extends('backend.admin.layouts.master')
@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
      <div class="container">
        <div class="card">
            
            <!-- /.card-header -->
            <div class="card-body">
                <form  method="POST" action="{{ route('package.update') }}">
                @csrf
                    <input type="hidden" name="packageid" value="{{$package->id}}">
                    <div class="form-row">

                        <div class="form-group col-md-12">
                            <label for="packagename">Package Name</label>
                            <input type="text" class="form-control"  name="packagename" value="{{$package->packagename}}">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="usdtprice">USDT Price</label>
                            <input type="number" class="form-control" name="usdtprice" value="{{$package->usdtprice}}" >
                        </div>
                        <div class="form-group col-md-6">
                            <label for="dbdtprice">DBDT Price</label>
                            <input type="number" class="form-control" name="dbdtprice"  value="{{$package->dbdtprice}}">
                        </div>
                        
                       
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="withdraw_dbdt">Withdraw DBDT</label>
                            <input type="number" class="form-control" name="withdraw_dbdt"  value="{{$package->withdraw_dbdt}}">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="staking_dbdt">Staking DBDT</label>
                            <input type="number" class="form-control" name="staking_dbdt"   value="{{$package->staking_dbdt}}">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="frozen_dbdt">Frozen DBDT</label>
                            <input type="number" class="form-control" name="frozen_dbdt"  value="{{$package->frozen_dbdt}}">
                        </div>
                        
                        
                    </div>


                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="mastercard_type">Mastercard</label>
                            <select class="form-control"  name="mastercard_type" >
 
                                <option {{old('mastercard_type',$package->mastercard_type)=="Free"? 'selected':''}}  value="Free">Free</option>
                                <option {{old('mastercard_type',$package->mastercard_type)=="Paid"? 'selected':''}}  value="Paid">Paid</option>
                
                              </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="overridelevel">Override Level</label>
                            <input type="number" class="form-control" name="overridelevel" value="{{$package->overridelevel}}">
                        </div>
                    </div>
                    <div class="form-row">

                    <div class="form-group col-md-8">
                        <label for="bonus_period">Bonus Period(Months)</label>
                        <input type="number" class="form-control" name="bonus_period" value="{{$package->bonus_period}}">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="package_order">Order</label>
                        <input type="number" class="form-control" name="package_order" value="{{$package->package_order}}">
                    </div>
                        </div>
                        <div class="form-row">
    
                            <div class="form-group col-md-12">
                                <label for="description">Package Description</label>
                                <textarea class="form-control"  name="description" id="summernote" cols="30" rows="5">{{$package->description}}</textarea>
                            </div>
                        </div>
                        
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="bonus">Commission</label>
                                    <input type="number" class="form-control" name="bonus" value="{{$package->bonus}}">
                                </div>
                                
                                <div class="form-group col-md-6">
                                    <label for="status">Status</label>
                                    {{-- <input type="number" class="form-control" name="status1" /> --}}
                                    <select class="form-control" id="status" name="status" value="{{$package->status}}">
                                        <option {{old('status',$package->status)=="Active"? 'selected':''}}  value="Active">Active</option>
                                        <option {{old('status',$package->status)=="Inactive"? 'selected':''}}  value="Inactive">Inactive</option>
                                        {{-- <option value="Active">Active</option>
                                        <option value="Inactive">Inactive</option> --}}
    
                                    </select>
                                </div>
                            </div>
    
    
    
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Update changes</button>
                            </div>

                </form>
            </div>
            <!-- /.card-body -->
        </div>
    </div>
    

    
       
    </div>


    
   
    <script>
        $(document).ready(function() {
            $('#summernote').summernote();
        });
      </script>

@endsection


