@extends('backend.admin.layouts.master')
@section('content')
    @php
    $user_details = DB::table('users')
        ->where('id', $master_card->user_id)
        ->first();
        $card_type = DB::table('pack_invoices')
        ->where('user_id', $master_card->user_id)
        ->first();

        $package = DB::table('packages')
        ->where('id', $card_type->package_id)
        ->first();


        
    @endphp
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">

                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <section class="content">

            <!-- Default box -->
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-11">
                            <h3>Mastercard Application Detail</h3>

                        </div>
                        <div class="col-1">
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                {{-- <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                  <i class="fas fa-times"></i>
                </button> --}}
                            </div>
                        </div>

                    </div>


                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-md-12 col-lg-12 order-2 order-md-1">
                            <div class="row">
                                <div class="col-12 col-sm-4">
                                    <div class="info-box bg-light">
                                        <div class="info-box-content">
                                            <span class="info-box-text text-center text-muted">Full Name</span>
                                            <span
                                                class="info-box-number text-center text-muted mb-0">{{ $master_card->first_name }}
                                                {{ $master_card->last_name }} </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-4">
                                    <div class="info-box bg-light">
                                        <div class="info-box-content">
                                            <span class="info-box-text text-center text-muted">Email</span>
                                            <span
                                                class="info-box-number text-center text-muted mb-0">{{ $master_card->email }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-2">
                                    <div class="info-box bg-light">
                                        <div class="info-box-content">
                                            <span class="info-box-text text-center text-muted">Date Of Birth</span>
                                            <span
                                                class="info-box-number text-center text-muted mb-0">{{ $master_card->birth_day }}</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 col-sm-2">
                                    <div class="info-box bg-light">
                                        <div class="info-box-content">
                                            <span class="info-box-text text-center text-muted">Country</span>
                                            <span
                                                class="info-box-number text-center text-muted mb-0">{{ $master_card->country }}</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 col-sm-2">
                                    <div class="info-box bg-light">
                                        <div class="info-box-content">
                                            <span class="info-box-text text-center text-muted">City</span>
                                            <span
                                                class="info-box-number text-center text-muted mb-0">{{ $master_card->city }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-2">
                                    <div class="info-box bg-light">
                                        <div class="info-box-content">
                                            <span class="info-box-text text-center text-muted">Postal/ZIP Code</span>
                                            <span
                                                class="info-box-number text-center text-muted mb-0">{{ $master_card->zip_code }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-3">
                                    <div class="info-box bg-light">
                                        <div class="info-box-content">
                                            <span class="info-box-text text-center text-muted">Mobile Number</span>
                                            <span
                                                class="info-box-number text-center text-muted mb-0">{{ $master_card->phone }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-5">
                                    <div class="info-box bg-light">
                                        <div class="info-box-content">
                                            <span class="info-box-text text-center text-muted">Username</span>
                                            <span
                                                class="info-box-number text-center text-muted mb-0">{{ $master_card->username }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="info-box bg-light">
                                        <div class="info-box-content">
                                            <span class="info-box-text text-center text-muted">Address</span>
                                            <span
                                                class="info-box-number text-center text-muted mb-0">{{ $master_card->address }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="info-box bg-light">
                                        <div class="info-box-content">
                                            <span class="info-box-text text-center text-muted"> Identity Card</span>
                                            <span
                                                class="info-box-number text-center text-muted mb-0">{{ $master_card->id_number }}</span>
                                            <span
                                                class="info-box-text text-center text-muted mb-0">{{ $master_card->id_country }}
                                                ({{ $master_card->id_type }})</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="info-box bg-warning">
                                        <div class="info-box-content">
                                            <span class="info-box-text text-center text-muted">Currency :
                                                {{ $master_card->currency }}</span>
                                            <span class="info-box-text text-center text-muted "> Bank :
                                                {{ $master_card->bank_name }} </span>
                                            <span class="info-box-text text-center text-muted "> Branch :
                                                {{ $master_card->brunch_name }}
                                                ({{ $master_card->bank_country }})</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 ">
                                    <div class="info-box bg-warning">
                                        <div class="info-box-content">
                                            <span class="info-box-text text-center text-muted mb-0">Account No.
                                                {{ $master_card->account_number }}</span>
                                            <span class="info-box-text text-center text-muted mb-0">Name :
                                                {{ $master_card->account_holder_name }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-4 ">
                                    <div class="info-box bg-warning">
                                        <div class="info-box-content">
                                            <span class="info-box-text text-center text-muted">Mastercard Number</span>
                                            <span
                                                class="info-box-text text-center text-muted mb-0">{{ $master_card->card_no }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-3 ">
                                    <div class="info-box bg-warning">
                                        <div class="info-box-content">
                                            <span class="info-box-text text-center text-muted">Mastercard Expire date</span>
                                            <span
                                                class="info-box-text text-center text-muted mb-0">{{ \Carbon\Carbon::parse($master_card->expire_date)->format('M-Y') }}
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 col-sm-5 ">
                                    <div class="info-box bg-warning">
                                        <div class="info-box-content">
                                            <span class="info-box-text text-center text-muted">Activation Payment
                                                Hash</span>
                                            <span class="info-box-text text-center text-muted mb-0">
                                                {{ $master_card->pay_code }}</span>
                                        </div>
                                    </div>
                                </div>


                            </div>

                        </div>

                    </div>
                </div>
                <!-- /.card-body -->
            </div>
@if($master_card->status==1)
<div class="card">
  <h4 class="card-header">
    Mastercard Activeted
  </h4>
</div>
@else

            <!-- /.card -->
            @if ($master_card->pay_code != null || $package->mastercard_type == 'Free')
                <div class="card">
                  <h4 class="card-header">
                    @if($package->mastercard_type == 'Free')
                    Free Mastercard
                    @else
                      Paid Mastercard (# {{$master_card->pay_code}})
                    @endif
                  </h4>
                    <div class="card-body">
                        <button type="button" class="btn btn-block btn-info" data-toggle="modal"
                            data-target="#modal-info{{ $master_card->id }}"> Approve</button>

                        <a class="btn btn-block btn-warning"
                            href="{{ url('/admin/mastercard/inactive/' . $master_card->id) }}">Deny</a>
                    </div>

                    <div class="modal fade" id="modal-info{{ $master_card->id }}">
                        <div class="modal-dialog">
                            <div class="modal-content bg-info">
                                <div class="modal-header">
                                    <h4 class="modal-title">Mastercard application approve
                                        {{ $master_card->id }}</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="card ">

                                        <!-- /.card-header -->
                                        <div class="card-body" style="color: black">
                                            <form method="POST" action="/admin/mastercard/active">
                                                @csrf
                                                <div class="from-group">
                                                    <label for="hash">Card Number#</label>
                                                    <input type="text" placeholder="Please enter Card Number"
                                                        class="form-control" id="card_no" name="card_no" required>
                                                    <input type="hidden" name="hidden_id"
                                                        value="{{ $master_card->id }}">

                                                </div>

                                                <div class="from-group">
                                                    <label for="hash">Expire Date:</label>
                                                    <input type="date" required class="form-control" id="expire_date"
                                                        name="expire_date">


                                                </div>

                                        </div>
                                        <!-- /.card-body -->
                                    </div>
                                </div>
                                <div class="modal-footer justify-content-between">
                                    <button type="button" class="btn btn-outline-light"
                                        data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-outline-light">Active Mastercard</button>
                                    </form>
                                </div>
                            </div>
                            <!-- /.modal-content -->
                        </div>
                        <!-- /.modal-dialog -->
                    </div>

                </div>
            @endif
            @endif

        </section>

        <!-- Content Header (Page header) -->

        <section class="content">

            <!-- Default box -->
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-11">
                            <h3>User Details
                                @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                    <img id="preview-image-before-upload1" style="height: 50px; width: 50px"
                                        src="{{ URL::to('/') }}/{{ $user_details->profile_photo_path }}"
                                        class="img-circle elevation-2" alt="DBDT">
                                @else
                                    <img src="{{ URL::to('backuser/dist/img/user2-160x160.jpg') }}"
                                        class="img-circle elevation-2" alt="{{ Auth::user()->name }}">
                                @endif
                            </h3>
                        </div>
                        <div class="col-1">
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"
                                    title="Collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                {{-- <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                  <i class="fas fa-times"></i>
                </button> --}}
                            </div>
                        </div>

                    </div>


                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-md-12 col-lg-12 order-2 order-md-1">
                            <div class="row">
                                <div class="col-12 col-sm-4">
                                    <div class="info-box bg-light">
                                        <div class="info-box-content">
                                            <span class="info-box-text text-center text-muted">Name</span>
                                            <span
                                                class="info-box-number text-center text-muted mb-0">{{ $user_details->name }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-4">
                                    <div class="info-box bg-light">
                                        <div class="info-box-content">
                                            <span class="info-box-text text-center text-muted">Username</span>
                                            <span
                                                class="info-box-number text-center text-muted mb-0">{{ $user_details->username }}</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 col-sm-4">
                                    <div class="info-box bg-light">
                                        <div class="info-box-content">
                                            <span class="info-box-text text-center text-muted">Email</span>
                                            <span
                                                class="info-box-number text-center text-muted mb-0">{{ $user_details->email }}</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 col-sm-4">
                                    <div class="info-box bg-light">
                                        <div class="info-box-content">
                                            <span class="info-box-text text-center text-muted">Refferal Code</span>
                                            <span
                                                class="info-box-number text-center text-muted mb-0">{{ route('register', ['ref' => $user_details->myrefferalcode]) }}</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 col-sm-4">
                                    <div class="info-box bg-light">
                                        <div class="info-box-content">
                                            <span class="info-box-text text-center text-muted">Phone Number</span>
                                            <span
                                                class="info-box-number text-center text-muted mb-0">{{ $user_details->phone }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-4">
                                    <div class="info-box bg-light">
                                        <div class="info-box-content">
                                            <span class="info-box-text text-center text-muted">Override Level</span>
                                            <span
                                                class="info-box-number text-center text-muted mb-0">{{ $user_details->override_level }}</span>
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>

                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->

        </section>
    </div>
@endsection
