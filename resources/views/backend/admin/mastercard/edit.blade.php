@extends('backend.admin.layouts.master')
@section('content')
@php
    $user_details= DB::table('users')->where('id', $master_card->user_id)->first();
@endphp


@if (session('update_success'))
        <script>
         const Toast = Swal.mixin({
          toast: true,
          position: 'center',
          showConfirmButton: false,
          timer: 3000,
          timerProgressBar: true,
          didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
          }
        })
        
        Toast.fire({
         
          title: 'Updated Succeddfully'
        })
         </script>
        @endif
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Masterard Edit</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Mastercard Details Edit</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          
          <div class="col-md-6">
           
           
            <div class="card card-info">
             
              <!-- /.card-header -->
              <!-- form start -->
              <form method="POST" class="form-horizontal"action="{{ route('mastercard.update') }}">
              @csrf
                <div class="card-body">
                    <div class="form-group row">
                        <label for="username" class=" col-sm-4 col-form-label">Username</label>
                        <div class="col-sm-8">
                          <input type="text" class="form-control" id="username" name="username" value="{{$master_card->username}}">
                       <input type="hidden" value="{{$master_card->id}}" name="masterCardId">
                        </div>
                      </div>
                  <div class="form-group row">
                    <label for="first_name" class=" col-sm-4 col-form-label">First Name</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" id="first_name" name="first_name" value="{{$master_card->first_name}}">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="last_name" class=" col-sm-4 col-form-label">Last Name</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" id="last_name" name="last_name" value="{{$master_card->last_name}}">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="email" class=" col-sm-4 col-form-label">Email</label>
                    <div class="col-sm-8">
                      <input type="email" class="form-control" id="email" name="email" value="{{$master_card->email}}">
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="phone" class=" col-sm-4 col-form-label">Phone</label>
                    <div class="col-sm-8">
                      <input type="tel" class="form-control" id="phone" name="phone" value="{{$master_card->phone}}">
                    </div>
                  </div>
                   
                </div>
                
              
            </div>
            <div class="card card-info">
                
                <!-- /.card-header -->
                <!-- form start -->
               
                  <div class="card-body">
                    <div class="form-group row">
                      <label for="birth_day" class=" col-sm-4 col-form-label">Date Of Birth</label>
                      <div class="col-sm-8">
                        <input type="date" class="form-control" id="birth_day" name="birth_day" value="{{$master_card->birth_day}}">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="country" class=" col-sm-4 col-form-label">Country</label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control" id="country" name="country" value="{{$master_card->country}}">
                      </div>
                    </div>

                    <div class="form-group row">
                        <label for="address" class=" col-sm-4 col-form-label">Present Address</label>
                        <div class="col-sm-8">
                            <textarea name="address" id="address" class="form-control"  rows="4">{{$master_card->address}}</textarea>
                          {{-- <input type="text" class="form-control" id="address" name="address" value="{{$master_card->address}}"> --}}
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="city" class=" col-sm-4 col-form-label">City</label>
                        <div class="col-sm-8">
                          <input type="text" class="form-control" id="city" name="city" value="{{$master_card->city}}">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="zip_code" class=" col-sm-4 col-form-label">Zip Code</label>
                        <div class="col-sm-8">
                          <input type="number" class="form-control" id="zip_code" name="zip_code" value="{{$master_card->zip_code}}">
                        </div>
                      </div>

                      

                  </div>
                  <!-- /.card-body -->
                  
              </div>

          </div>
          <div class="col-md-6">
           
           
            <div class="card card-info">
             
              <!-- /.card-header -->
              <!-- form start -->
              
                <div class="card-body">
                  <div class="form-group row">
                    <label for="id_type" class=" col-sm-4 col-form-label">Identity Type</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" id="id_type" name="id_type" value="{{$master_card->id_type}}">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="id_country" class=" col-sm-4 col-form-label">{{$master_card->id_type}} Of </label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" id="id_country" name="id_country" value="{{$master_card->id_country}}">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="id_number" class=" col-sm-4 col-form-label">{{$master_card->id_type}} Number </label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" id="id_number" name="id_number" value="{{$master_card->id_number}}">
                    </div>
                  </div>
                </div>
               
            </div>
            <div class="card card-info">
               
                
                  <div class="card-body">
                    <div class="form-group row">
                      <label for="bank_country" class=" col-sm-4 col-form-label">Bank Country</label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control" id="bank_country" name="bank_country" value="{{$master_card->bank_country}}">
                      </div>
                    </div>
                    <div class="form-group row">
                        <label for="bank_name" class=" col-sm-4 col-form-label">Bank Name</label>
                        <div class="col-sm-8">
                          <input type="text" class="form-control" id="bank_name" name="bank_name" value="{{$master_card->bank_name}}">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="brunch_name" class=" col-sm-4 col-form-label">Brunch Name</label>
                        <div class="col-sm-8">
                          <input type="text" class="form-control" id="brunch_name" name="brunch_name" value="{{$master_card->brunch_name}}">
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="account_holder_name" class=" col-sm-4 col-form-label">Holder Name</label>
                        <div class="col-sm-8">
                          <input type="text" class="form-control" id="account_holder_name" name="account_holder_name" value="{{$master_card->account_holder_name}}">
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="account_number" class=" col-sm-4 col-form-label">Account No.</label>
                        <div class="col-sm-8">
                          <input type="text" class="form-control" id="account_number" name="account_number" value="{{$master_card->account_number}}">
                        </div>
                      </div>
                      
                      <div class="form-group row">
                        <label for="currency" class=" col-sm-4 col-form-label">Currency</label>
                        <div class="col-sm-8">
                          <input type="text" class="form-control" id="currency" name="currency" value="{{$master_card->currency}}">
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="expire_date" class=" col-sm-4 col-form-label">Expire Date</label>
                        <div class="col-sm-8">
                          <input type="date" class="form-control" id="expire_date" name="expire_date" value="{{$master_card->expire_date}}">
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="card_no" class=" col-sm-4 col-form-label">Card Number</label>
                        <div class="col-sm-8">
                          <input type="text" class="form-control" id="card_no" name="card_no" value="{{$master_card->card_no}}">
                        </div>
                      </div>
                     

                      

                  </div>
                  <!-- /.card-body -->
                  
                  <!-- /.card-footer -->
                
              </div>


              <div class="card">
                <div class="card-footer">
                    <button type="submit" class="btn btn-info col-sm-6 float-right"><i class="fas fa-save"></i> Update <i class="fas fa-info-circle"></i></button>
                    <button type="reset" class="btn btn-danger"> <i class="fas fa-undo"></i></button>

                   
                  </div>
              </div>
            </form>
          </div>
          
        </div>
        
      </div>
    </section>
    <!-- /.content -->
  </div>
@endsection
