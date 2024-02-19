@extends('layouts.app-mazer')
@section('content')
    <section class="section">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Dashboard</h4>
                </div>
                <div class="card-body">

<table class="table table-bordered data-table">
    <thead>
        <tr>
            <th style="width: 10%" class="sorting">ID Guru</th>
            <th>Nama Guru</th>
            <th>Email</th>
            <th>Dibuat pada</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>

</div>
</div>
</div>
</section>
<script type="text/javascript">
    $(function () {

      var table = $('.data-table').DataTable({
          processing: true,
          serverSide: true,
          ajax: "{{ route('adm.guru.index') }}",
          columns: [
            {data: 'id', name: 'id',orderable:true},
            {data: 'name', name: 'name',orderable:true},
              {data: 'email', name: 'email',orderable:true},
              {data: 'created_at', name: 'created_at',orderable:true},
              {data: 'action', name: 'action', orderable: false, searchable: false},
          ]
      });

    });
</script>
@endsection
