@extends('layouts.app-mazer')
@section('content')
    <section class="section">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Dashboard</h4>
                </div>
                <div class="card-body">

<table class="table table-bordered data-table table-stripped">
    <thead>
        <tr>
            <th style="width: 10%" class="sorting">ID Siswa</th>
            <th>Nama Siswa</th>
            <th>NIS</th>
            <th>Kelas</th>
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
          ajax: "students",
          columns: [
              {data: 'student_id', name: 'student_id',orderable:true},
              {data: 'student_name', name: 'student_name',orderable:true},
              {data: 'student_number', name: 'student_number',orderable:true},
              {data: 'classroom', name: 'classroom.classroom_name',orderable:true},
              {data: 'action', name: 'action', orderable: false, searchable: false},
          ]
      });

    });
</script>
@endsection
