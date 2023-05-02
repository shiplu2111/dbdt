@extends('backend.user.layouts.master')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h2 class="m-0">Package Detail</h2>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        {{-- <button type="button" style="float: right;" class="btn btn-outline-primary" data-toggle="modal"
                data-target="#packageModal">
                Add New Package
            </button> --}}
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <section class="content">

        <!-- Default box -->
        <div class="card">
          <div class="card-header">
            <h3 class="card-title"> {{ $master_card->first_name }}  {{ $master_card->last_name }}</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                <i class="fas fa-minus"></i>
              </button>
              {{-- <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                <i class="fas fa-times"></i>
              </button> --}}
            </div>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-12 col-md-12 col-lg-12 order-2 order-md-1">
                <div class="row">
                  <div class="col-12 col-sm-3">
                    <div class="info-box bg-light">
                      <div class="info-box-content">
                        <span class="info-box-text text-center text-muted">Full Name</span>
                        <span class="info-box-number text-center text-muted mb-0">{{ $master_card->first_name }}  {{ $master_card->last_name }} </span>
                      </div>
                    </div>
                  </div>
                  <div class="col-12 col-sm-3">
                    <div class="info-box bg-light">
                      <div class="info-box-content">
                        <span class="info-box-text text-center text-muted">Email</span>
                        <span class="info-box-number text-center text-muted mb-0">{{ $master_card->email }}</span>
                      </div>
                    </div>
                  </div>
                  <div class="col-12 col-sm-3">
                    <div class="info-box bg-light">
                      <div class="info-box-content">
                        <span class="info-box-text text-center text-muted">Date Of Birth</span>
                        <span class="info-box-number text-center text-muted mb-0">{{ $master_card->birth_day }}</span>
                      </div>
                    </div>
                  </div>

                  <div class="col-12 col-sm-3">
                    <div class="info-box bg-light">
                      <div class="info-box-content">
                        <span class="info-box-text text-center text-muted">Country</span>
                        <span class="info-box-number text-center text-muted mb-0">{{ $master_card->country }}</span>
                      </div>
                    </div>
                  </div>

                  <div class="col-12 col-sm-3">
                    <div class="info-box bg-light">
                      <div class="info-box-content">
                        <span class="info-box-text text-center text-muted">City</span>
                        <span class="info-box-number text-center text-muted mb-0">{{ $master_card->city }}</span>
                      </div>
                    </div>
                  </div>
                  <div class="col-12 col-sm-3">
                    <div class="info-box bg-light">
                      <div class="info-box-content">
                        <span class="info-box-text text-center text-muted">Postal/ZIP Code</span>
                        <span class="info-box-number text-center text-muted mb-0">{{ $master_card->zip_code }}</span>
                      </div>
                    </div>
                  </div>
                  <div class="col-12 col-sm-3">
                    <div class="info-box bg-light">
                      <div class="info-box-content">
                        <span class="info-box-text text-center text-muted">Mobile Number</span>
                        <span class="info-box-number text-center text-muted mb-0">{{ $master_card->phone }}</span>
                      </div>
                    </div>
                  </div>
                  <div class="col-12 col-sm-3">
                    <div class="info-box bg-light">
                      <div class="info-box-content">
                        <span class="info-box-text text-center text-muted">Username</span>
                        <span class="info-box-number text-center text-muted mb-0">{{ $master_card->username }}</span>
                      </div>
                    </div>
                  </div>
                  <div class="col-12 col-sm-3">
                    <div class="info-box bg-light">
                      <div class="info-box-content">
                        <span class="info-box-text text-center text-muted">Address</span>
                        <span class="info-box-number text-center text-muted mb-0">{{ $master_card->address }}</span>
                      </div>
                    </div>
                  </div>
                  <div class="col-12 col-sm-3">
                    <div class="info-box bg-light">
                      <div class="info-box-content">
                        <span class="info-box-text text-center text-muted">Identy Card </span>
                        <span class="info-box-number text-center text-muted mb-0">{{ $master_card->id_number }}</span>
                        <span class="info-box-text text-center text-muted mb-0">{{ $master_card->id_country }} ({{ $master_card->id_type }})</span>
                      </div>
                    </div>
                  </div>
                  <div class="col-12 col-sm-3">
                    <div class="info-box bg-warning">
                      <div class="info-box-content">
                        <span class="info-box-text text-center text-muted">Bank Details</span>
                        <span class="info-box-text text-center text-muted "> Bank : {{ $master_card->bank_name }} </span>
                        <span class="info-box-text text-center text-muted "> Branch : {{ $master_card->brunch_name }} ({{ $master_card->bank_country }})</span>
                      </div>
                    </div>
                  </div>
                  <div class="col-12 col-sm-3 ">
                    <div class="info-box bg-warning">
                      <div class="info-box-content">
                        <span class="info-box-text text-center text-muted">Bank Details ({{ $master_card->currency }})</span>
                        <span class="info-box-text text-center text-muted mb-0">Account No. {{ $master_card->account_number }}</span>
                        <span class="info-box-text text-center text-muted mb-0">Name : {{ $master_card->account_holder_name }}</span>
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
