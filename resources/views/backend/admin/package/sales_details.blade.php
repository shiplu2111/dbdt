@extends('backend.admin.layouts.master')
@section('content')
<div class="content-wrapper">
 <div class="card">

            <!-- /.card-header -->
            <div class="card-body">
                <table class="table table-bordered table-striped" id="packageTable" width="100%" cellspacing="0">

                    <thead>
                        <tr>

                             <th>S/N</th>
							<th>User ID</th>
                            <th>Package Name</th>
							<th>Package Price</th>
							<th>Package tax</th>
							<th>Subtotal</th>
                            <th>Date</th>
                            <th>Transection #</th>

                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                             <th>S/N</th>
							<th>User ID</th>
                            <th>Package Name</th>
							<th>Package Price</th>
							<th>Package tax</th>
							<th>Subtotal</th>
                            <th>Date</th>
                            <th>Transection #</th>
                        </tr>
                    </tfoot>
                    <tbody>
						@php
						$i=1;
						@endphp
                        @foreach ($sales_details as $item)


                        @php
                            $packages = DB::table('packages')->where('id',$item->package_id)->first();
                            $user = DB::table('users')->where('id',$item->user_id)->first();
                        @endphp
                            <tr id="sid{{ $item->id }}">
                                <td>{{ $i}}</td>
                                <td>
                                    <a href="{{ url('/admin/user/details/'.$user->id) }}">
                                    {{ $user->name }}
                                </a></td>
                                <td>{{ $packages->packagename }}</td>
                                <td>{{ $item->price }}</td>
								<td>{{ $item->tax }}</td>
								<td>{{ $item->subtotal }}</td>
								<td>{{ Carbon\Carbon::parse($item->created_at)->format('d-m-Y') }}</td>
								<td style="max-width: 200px; ">{{ $item->pay_code }}</td>


                            </tr>
						@php
						$i++;
						@endphp
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
</div>
<script>
    $(function () {
      $("#packageTable").DataTable({
        "responsive": true, "lengthChange": false, "autoWidth": false,
        "buttons": ["excel", "pdf", "print"]
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
