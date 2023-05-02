@extends('backend.admin.layouts.master')
@section('content')


    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h2 class="m-0">Credited List</h2>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <button type="button" style="float: right;" class="btn btn-outline-primary" data-toggle="modal"
                                data-target="#packageModal">
                                Add Credit
                            </button>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- Example single danger button -->

        <div class="card">

            <!-- /.card-header -->
            <div class="card-body">
                <table id="packageTable" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>ID</th>
                    <th>Email</th>
                    <th>Credited Amount</th>
                    <th>Credit Type</th>
                    <th>Reason</th>
                    <th>Status</th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach($credits as $item)
                  <tr>
                    <td>{{$item->id}}</td>
                    <td>{{$item->email}}</td>
                    <td>{{$item->dbdt_amount}} DBDT</td>
                    <td>{{$item->credit_type}}</td>
                    <td>{{$item->reason}}</td>
                    <td>{{$item->status}}</td>
                  </tr>
                  @endforeach
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>ID</th>
                    <th>Email</th>
                    <th>Credited Amount</th>
                    <th>Credit Type</th>
                    <th>Reason</th>
                    <th>Status</th>
                  </tr>
                  </tfoot>
                </table>
              </div>
            <!-- /.card-body -->
        </div>
    </div>


    {{-- add package model --}}

    <div class="modal" id="packageModal" tabindex="-1" aria-labelledby="packageModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="packageModalLabel">Add Credit</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="packageForm">

                        
          
                         
          
                          
          
                          <div class="input-group mb-3">
                            <div class="input-group-prepend">
                              <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                            </div>
                            <input type="email" class="form-control" autocomplete="off" name="email" id="email" placeholder="Enter receiver email" required>
    
        {{ csrf_field() }}
                         
                        </div>
                        <div id="emailList" style="z-index: 1000; position: absolute;"></div>
                          
                          <div class="input-group">
                            <div class="input-group-prepend">
                              
                                <span class="input-group-text">DBDT</span>
                              
                            </div>
                            <input type="number" class="form-control" name="dbdt_amount" id="dbdt_amount" required>
                            <div class="input-group-append">
                                <span class="input-group-text">.00</span>
                              </div>
                          </div>

                          <div class="input-group">
                            <div class="input-group-prepend">
                              
                                <span class="input-group-text">Account Type</span>
                              
                            </div>
                            <select class="form-control" name="credit_type" id="credit_type">
                                <option class="form-control" value="Stake Balance">Stake Balance</option>
                                <option class="form-control" value="Withdraw Balance">Withdraw Balance</option>
                            </select>
                          </div>

                          <div class="row">
                            <div class="col-sm-12">
                              <!-- textarea -->
                              <div class="form-group " style="margin-top: 5px">
                                <label>Grettings</label>
                                <textarea class="form-control" name="reason" id="reason" rows="3" placeholder="Enter reason for add creadit"></textarea>
                              </div>
                            </div>
                            
                          </div>
                         


                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>

                    </form>
                </div>

            </div>
        </div>
    </div>



    
    <script>
        $("#packageForm").submit(function(e) {
            e.preventDefault();
            let email = $("#email").val();
            let dbdt_amount = $("#dbdt_amount").val();
            let credit_type = $("#credit_type").val();
            let reason = $("#reason").val();
            
            let _token = $("import [name=_token]").val();

            $.ajax({

                url: "{{ route('credit.add') }}",
                type: "POST",
                data: {
                    email: email,
                    dbdt_amount: dbdt_amount,
                    credit_type: credit_type,
                    reason: reason,
                   
                    _token: '{{ csrf_token() }}'

                },
                success: function(response) {
                    if (response) {

                        $("#packageTable tbody").prepend('<tr><td>' + response.id +
                            '</td><td>' + response.email + '</td><td>' + response.dbdt_amount +
                            '</td><td>' + response.credit_type +
                            '</td><td>' + response.reason + '</td><td>' + response.status +
                            '</td></tr>');
                           
                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
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
                            title: 'Credited Successfully'
                        })
                        $("#packageForm")[0].reset();
                        $('body').removeClass('modal-open'); 
                        $('#packageModal').hide();
                        $('.modal-backdrop').remove();
                        
                    }
                }
            });
        });
    </script>


   



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
<script>
    $(document).ready(function(){
    
     $('#email').keyup(function(){ 
            var query = $(this).val();
            if(query != '')
            {
             var _token = $('input[name="_token"]').val();
             $.ajax({
              url:"{{ route('autocomplete.fetch') }}",
              method:"POST",
              data:{query:query, _token:_token},
              success:function(data){
               $('#emailList').fadeIn();  
                        $('#emailList').html(data);
              }
             });
            }
        });
    
        $(document).on('click', 'li', function(){  
            $('#email').val($(this).text());  
            $('#emailList').fadeOut();  
        });  
    
    });
    </script>
@endsection



