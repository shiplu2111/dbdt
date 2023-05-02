@extends('backend.admin.layouts.master')
@section('content')
   
@php
        $user_account = DB::table('accounts')->where('user_id',$kyc_request->id)->first();
@endphp



<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h4>KYC Requests</h4>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">KYC Details</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-3">
  
              <!-- Profile Image -->
              <div class="card card-primary card-outline">
                <div class="card-body box-profile">
                  <div class="text-center">
					  @if ($kyc_request->profile_photo_path)
                    <img class="profile-user-img img-fluid img-circle"
                        style="height: 90px; width: 90px" src="{{ URL::to('/') }}/{{ $kyc_request->profile_photo_path}}"
                         alt="{{ $kyc_request->name}}">
					   @else
                                        <img id="preview-image-before-upload1" style="height: 100px;"
                                            src="https://media.istockphoto.com/vectors/vector-businessman-black-silhouette-isolated-vector-id610003972?k=20&m=610003972&s=612x612&w=0&h=-Nftbu4sDVavoJTq5REPpPpV-kXH9hXXE3xg_D3ViKE="
                                            class="profile-user-img img-fluid img-circle" alt="DBDT">
                                    @endif
                  </div>
  
                  <h3 class="profile-username text-center">{{ $kyc_request->name}}</h3>
  
                  <p class="text-muted text-center">{{ $kyc_request->email}}</p>
  
                  <ul class="list-group list-group-unbordered mb-3">
                    @if($user_account)
                    <li class="list-group-item">
                      
                      <b> Total DBDT</b> <span class="float-right">{{ number_format($user_account->dbdt_balance, 2, '.', ',') }}</span>
                    </li>
                    <li class="list-group-item">
                      <b>Staking DBDT</b> <span class="float-right">{{ number_format($user_account->repurchase_balance, 2, '.', ',') }}</span>
                    </li>
                    <li class="list-group-item">
                      <b>Withdraw DBDT</b> <span class="float-right">{{ number_format($user_account->withdraw_balance, 2, '.', ',') }}</span>
                    </li>
                    @else
                    <li class="list-group-item">User Did Not Bought Any Package Yet</li>
                    @endif
                  </ul>
  
                  <a href="{{ url('/admin/user/details/'.$kyc_request->id) }}" class="btn btn-primary btn-block"><b>Details</b></a>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
  
              <!-- About Me Box -->
              
              <!-- /.card -->
            </div>
            <!-- /.col -->
            <div class="col-md-9">
              <div class="card">
                
                <div class="card-body">
                  <div class="tab-content">
                    <div class="active tab-pane" id="activity">
                     
                      <!-- Post -->
                      <div class="post clearfix">
                        <div class="user-block">
                            @if($kyc_request->profile_photo_path)
                          <img class="img-circle img-bordered-sm" src="{{ URL::to('/') }}/{{ $kyc_request->profile_photo_path}}" alt="{{ $kyc_request->name}}">
							@else
							
                                        <img class="img-circle img-bordered-sm" 
                                            src="https://media.istockphoto.com/vectors/vector-businessman-black-silhouette-isolated-vector-id610003972?k=20&m=610003972&s=612x612&w=0&h=-Nftbu4sDVavoJTq5REPpPpV-kXH9hXXE3xg_D3ViKE="
                                            class="profile-user-img img-fluid img-circle" alt="DBDT">
                                    
                          @endif
                          <span class="username">
                            <a  style="font-size: large;" href="{{ url('/admin/user/details/'.$kyc_request->id) }}">{{ $kyc_request->name}}</a>
                             
                          </span>
                          <span class="description font-weight-bold" style="font-size: large;color: rgb(56, 41, 44)">{{ $kyc_request->email}} ({{ Carbon\Carbon::parse($kyc_request->updated_at)->diffForHumans()}})</span>
                          <span class="description font-weight-bold"  style="font-size: large;color: rgb(56, 41, 44)">{{ $kyc_request->document_type}} ({{ $kyc_request->issued_by_country}} )</span> 
                          <span class="description font-weight-bold"  style="font-size: large;color: rgb(56, 41, 44)">{{ $kyc_request->document_type}} Number - ({{ $kyc_request->document_number}} )</span>
                        </div>
                        <!-- /.user-block -->
                        
  
                        
                      </div>
                      <!-- /.post -->
  
                      <!-- Post -->
                      <div class="post" style="text-align: center">
                       
                        <!-- /.user-block -->
                        <div class="row mb-3">
                            @if ($kyc_request->document_type=='NID')
                                
                            
                          <div class="col-sm-6">
                          <h6 class="description">NID Card Front Side Image</h6>
                          <a href="{{ URL::to('/') }}/{{ $kyc_request->nid_photo_front}}">
                              
                            <img style="width: 100%; height: 200px;" class="img-fluid" src="{{ URL::to('/') }}/{{ $kyc_request->nid_photo_front}}" alt="Photo">
                          </a> </div>
                       
                          <div class="col-sm-6">
                          <h6 class="description">NID Card Back Side Image</h6>
                          <a href="{{ URL::to('/') }}/{{ $kyc_request->nid_photo_back}}">

                            <img style="width: 100%; height: 200px;" class="img-fluid" src="{{ URL::to('/') }}/{{ $kyc_request->nid_photo_back}}" alt="Photo">
                          </a> </div>
                          @else
                          <div class="offset-3 col-sm-6">
                            <h6 class="description">Passport Image</h6>
                            <a href="{{ URL::to('/') }}/{{ $kyc_request->passport_photo}}">
                                
                              <img style="width: 100%; height: 200px;" class="img-fluid" src="{{ URL::to('/') }}/{{ $kyc_request->passport_photo}}" alt="Photo">
                            </a> </div>
                          @endif
                          <!-- /.col -->
                          
                          <!-- /.col -->
                        </div>
                        <!-- /.row -->
  
                        
  
                      </div>
                      <div class="post">
                       
                        <!-- /.user-block -->
                        <div class="row mb-3">
                            
                                
                            
                          <div class=" col-sm-6" style="text-align: center">
                          <h6 class="description">Selfie With Document</h6>
                              <a href="{{ URL::to('/') }}/{{ $kyc_request->selfie}}">
                            <img style="width: 100%; height: 200px;" class="img-fluid" src="{{ URL::to('/') }}/{{ $kyc_request->selfie}}" alt="Photo">
                          </a> </div>

                          <div class=" col-sm-6" style="text-align: center">
                            <h6 class="description">Address Proof</h6>
                                <a href="{{ URL::to('/') }}/{{ $kyc_request->address_proof}}">
                              <img style="width: 100%; height: 200px;" class="img-fluid" src="{{ URL::to('/') }}/{{ $kyc_request->address_proof}}" alt="Photo">
                            </a> </div>
                          
                          <!-- /.col -->
                          
                          <!-- /.col -->
                        </div>
                        <!-- /.row -->
  
                        
  
                      </div>
                      @if ($kyc_request->id_verify_status==2)
                      <div class="post">
                        <div class="row mb-3 center">
                          <div class=" col-sm-6" style="text-align: center">
                            <button data-toggle="modal" data-target="#modal-default" class="btn btn-sm btn-danger  col-sm-12"><i class="fas fa-skull-crossbones"></i> Reject</button>
                            {{-- <a href="{{ url('/admin/user/kyc/reject/'.$kyc_request->id) }}" class="btn btn-sm btn-danger  col-sm-12"><i class="fas fa-skull-crossbones"></i> Reject</a> --}}

                          </div>
                          <div class=" col-sm-6" style="text-align: center">
                          <a href="{{ url('/admin/user/kyc/accept/'.$kyc_request->id) }}" class="btn btn-sm btn-primary  col-sm-12"><i class="fas fa-check-double"></i> Verify</a>

                        </div>

                        </div>
                      </div>
                      @elseif($kyc_request->id_verify_status==1)
                      <div class="post">
                        <div class="row mb-3 center">
                          <div class=" col-sm-12" style="text-align: center">
                         <span class="btn btn-outline-success btn-block">Accepted</span>
                        </div>

                        </div>
                      </div>
                      @endif
                      
                      <!-- /.post -->
                    </div>
                    <div class="modal fade" id="modal-default" aria-hidden="true" style="display: none;">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h4 class="modal-title">Reject Reason</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">×</span>
                            </button>
                          </div>
                          <div class="modal-body">
                           <form  action="/admin/user/kyc/reject" method="POST" >
                            @csrf
                             <div class="form-group">
                               <textarea class="form-control" name="reject_reason" rows="5">
                                 Dear, {{$kyc_request->name}}, ...
                               </textarea>
                               <input type="hidden" name="user_id" value="{{$kyc_request->id}}">
                             </div>
                           
                          </div>
                          <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-danger">Send Notification & Reject</button>
                          </form>
                        </div>
                        </div>
                        <!-- /.modal-content -->
                      </div>
                      <!-- /.modal-dialog -->
                    </div>
  
                    <!-- /.tab-pane -->
                  </div>
                  <!-- /.tab-content -->
                </div><!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div><!-- /.container-fluid -->
      </section>
    <!-- /.content -->
  </div>
  



<script>
    $(function () {
      $("#packageTable").DataTable({
        "responsive": true, "lengthChange": false, "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
      }).buttons().container().appendTo('#packageTable_wrapper .col-md-6:eq(0)');
      $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
      });
    });
  </script>

@endsection



