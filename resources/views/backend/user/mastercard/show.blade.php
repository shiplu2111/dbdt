@extends('backend.user.layouts.master')
@section('content')
@if (session('status_ok'))
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
        icon: 'success',
        title: 'Request send successfully'
    })
</script>
@endif

@if (session('status_not'))
<script>
    const Toast = Swal.mixin({
        toast: true,
        position: 'top',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    })

    Toast.fire({
        icon: 'success',
        title: 'Request send successfully'
    })
</script>
@endif

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
                            <h3>Mastercard Details</h3>

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
                                <div class="col-12 col-sm-4">
                                    <div class="info-box bg-light">
                                        <div class="info-box-content">
                                            <span class="info-box-text text-center text-muted">Address</span>
                                            <span
                                                class="info-box-number text-center text-muted mb-0">{{ $master_card->address }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-3">
                                    <div class="info-box bg-light">
                                        <div class="info-box-content">
                                            <span class="info-box-text text-center text-muted">Identy Card </span>
                                            <span
                                                class="info-box-number text-center text-muted mb-0">{{ $master_card->id_number }}</span>
                                            <span
                                                class="info-box-text text-center text-muted mb-0">{{ $master_card->id_country }}
                                                ({{ $master_card->id_type }})</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-5">
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
                                <div class="col-12 col-sm-4 ">
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
                                <div class="col-12 col-sm-4 ">
                                    <div class="info-box bg-warning">
                                        <div class="info-box-content">
                                            <span class="info-box-text text-center text-muted">Mastercard Expire date</span>
                                            <span class="info-box-text text-center text-muted mb-0">
                                                {{ $master_card->expire_date }}</span>
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
            @if ($master_card->pay_code == null)
                <div class="callout callout-info">
                    <i class="fas fa-info"></i>
                    Pay 20$ for active your Mastercard.

                   
                </div>


                <div class="callout callout-info">
                    <br>
                    <table style="table-layout: fixed; width: 100%">
                        @php
                            $deposit_methods = DB::table('deposit_methods')->get();
                        @endphp

                        @if ($deposit_methods)
                            @foreach ($deposit_methods as $deposit_method)
                                <tr>
                                    <td style="word-wrap: break-word; width:30%">
                                        <h6>{{ $deposit_method->name }}:</h6>
                                    </td>
                                    <td style="word-wrap: break-word; width:50%">
                                        <p id="{{ $deposit_method->id }}">{{ $deposit_method->address }}</p>
                                    </td>
                                    <td style="word-wrap: break-word; width:20%"><button
                                            class="btn btn-block btn-outline-success btn-sm"
                                            onclick="CopyToClipboard('{{ $deposit_method->id }}');return false;">Copy</button>
                                    </td>
                                </tr>
                            @endforeach
                        @endif

                    </table>
                </div>

 
                
                    <div class="card">
                        <div class="card-body ">
                            <form method="POST" action="/user/mastercard-payment">
                                @csrf
                    <div class="form-row">
                        <div class="form-group col-md-7">
                          <label for="pay_code">Transaction hash#</label>
                          <input type="text" name="pay_code" class="form-control" id="pay_code">
                        </div>
                        <div class="form-group col-md-5">
                          <label for="payment_method">Payment Method</label>
                          <select name="payment_method" id="payment_method" class="form-control">
                            @if ($deposit_methods)
                            @foreach ($deposit_methods as $deposit_method)
                            <option value="{{ $deposit_method->name }}">{{ $deposit_method->name }}</option>
                            @endforeach
                            @endif
                          </select>
                        </div>
                    </div>
                    <div class="offset-md-9 col-md-3 ">

                        <button type="submit"  class=" btn btn-outline-primary btn-block ">Submit</button>
                        
                    </div>
                </form> 
            </div>
            </div>  
                
            @endif
        </section>

        <!-- Content Header (Page header) -->


    </div>
    <script>
        function CopyToClipboard(id) {
            var r = document.createRange();
            r.selectNode(document.getElementById(id));
            window.getSelection().removeAllRanges();
            window.getSelection().addRange(r);
            document.execCommand('copy');
            window.getSelection().removeAllRanges();
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 1500,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            })

            Toast.fire({
                icon: 'success',
                title: 'Copy successfully'
            })
        }
    </script>
@endsection
