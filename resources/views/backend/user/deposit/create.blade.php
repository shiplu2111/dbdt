@extends('backend.user.layouts.master')
@section('title')
    DBDT-New Deposit
@endsection
@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Deposit DBDT Now</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Deposit DBDT</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Deposit DBDT Now</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">

                    <div class="row mb-2">
                        <div class="col-sm-12">
                            <h2 class="m-0">Deposit Note</h2>
                            <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
                                To recharge your account please pay the equal deposit amount and then submit the transaction
                                hash# <br>

                                <br>
                            <table>
                                @php
                                    $deposit_methods = DB::table('deposit_methods')->get();
                                @endphp

                                @if ($deposit_methods)
                                    @foreach ($deposit_methods as $deposit_method)

                                        <tr class="row">
                                            <td class="col-md-4">
                                                <h6>{{ $deposit_method->name }}:</h6>
                                            </td>
                                            <td class="col-md-6">
                                                <h6 id="{{ $deposit_method->id }}">{{ $deposit_method->address }}</h6>
                                            </td>
                                            <td class="col-md-2"><button class="btn btn-block btn-outline-success btn-sm"
                                                    onclick="CopyToClipboard('{{ $deposit_method->id }}');return false;">Copy</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif

                            </table>
                            </p>
                            <p>
                                @if (session()->has('message'))
                                    <div class="alert alert-success">
                                        {{ session()->get('message') }}
                                    </div>
                                @endif
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                            </p>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">

                            </ol>
                        </div>
                    </div>
                    <div class="card bg-info">
                        <div class="card-body">
                            <form method="POST" action="/user/new-deposit">
                                @csrf
                                <div class="row">
                                    <div class="col-md-3 form-group">
                                        <label for="">Deposit Amount</label>
                                        <input type="number" class="form-control" placeholder="Deposit Amount"
                                            name="amount">
                                    </div>
                                    <div class=" col-md-3 form-group">
                                        <label for="exampleFormControlSelect1">Select Wallet Type</label>
                                        <select class="form-control" name="type">
                                            <option value="1">Funding Balance </option>
                                            <option value="2">Staking Balance</option>

                                        </select>
                                    </div>
                                    <div class=" col-md-2 form-group">
                                        <label for="exampleFormControlSelect1">Paid By</label>
                                        <select class="form-control" name="paid_by">
                                            @foreach ($deposit_methods as $item)
                                            <option value="{{$item->name}}">{{$item->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label for="">Transaction Hash</label>
                                        <input type="text" class="form-control" name="hash" placeholder="Deposit Transaction Hash#"
                                            name="amount">
                                    </div>
                                   

                                </div>
                            
                            <div class="card-footer">
                                <button class="btn btn-primary float-right">Request For Deposit</button>
                            </div>
                        </form>
                        </div>
                    </div>
                </div>

            </div>
        </section>
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
