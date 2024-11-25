@extends('layouts.admin.dashboardboostrap')
@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
      <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
      <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Data Master</li>
    </ol>
    <h6 class="font-weight-bolder mb-0">Monitoring Presensi</h6>
  </nav>

  <div class="page-body">
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-md-4">
                                    <div class="form-group">
                                        {{-- <form action="presensi/monitoring" method="GET"> --}}
                                        <div class="input-group input-group-alternative mb-4">
                                        <span class="input-group-text">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar-event" viewBox="0 0 16 16">
                                            <path d="M11 6.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5z"/>
                                            <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5M1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4z"/>
                                        </svg>
                                        </i></span>
                                        <input class="form-control form-control-alternative" value="{{ date("Y-m-d") }}" name="tanggal" id="tanggal" placeholder="Tanggal Presensi" type="text" autocomplete="off">
                                        </div>
                                    </div>
                       
                                    
                                    {{-- <form action="presensi/monitoring" method="POST">
                                    
                                        <!-- Select Dropdown for Kelas -->
                                        <div class="form-group">
                                            <label for="kelas">Kelas:</label>
                                            <select name="kelas" id="kelas" class="form-select">
                                                <option value="">Pilih Kelas</option>
                                                @foreach ($kelas as $d)
                                                    <option value="{{ $d->kode_kelas }}" {{ request('kelas') == $d->kode_kelas ? 'selected' : '' }}>
                                                        {{ $d->nama_kelas }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary">
                                                <i class="fas fa-search" aria-hidden="true"></i> Cari
                                            </button>
                                        </div>
                                    </form> --}}
                                    
                                    <div class="row">
                                        <div class="col-12">
                                            <table class="table table-striped table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>No.</th>
                                                        <th>Nik</th>
                                                        <th>Nama Siswa</th>
                                                        <th>Kelas</th>
                                                        <th>Jam Masuk</th>
                                                        <th>Foto</th>
                                                        <th>Jam Pulang</th>
                                                        <th>Foto</th>
                                                        <th>Keterangan</th>
                                                        <th> </th>
                                                    </tr>
                                                </thead>
                                                <tbody id="loadpresensi"></tbody>
                                            </table>
                                        </div>
                                    </div>                         
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </div>
  <div class="modal fade" id="modal-tampilkanpeta" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Lokasi Presensi User</h5>
        <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close" id="btnEditsiswa">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="loadmap">

      </div>
    </div>
  </div>
</div>
@endsection
@push ('myscript')
<script>
     $(function () {
        $("#tanggal").datepicker({ 
        autoclose: true, 
        todayHighlight: true,
        format: 'yyyy-mm-dd'
        });

        
        function loadpresensi() {
            var tanggal = $("#tanggal").val();
            var kelas = $("#kelas").val();

            $.ajax({
                type: 'POST',
                url: '/getpresensi',
                data: {
                    _token: "{{ csrf_token() }}"
                    ,tanggal: tanggal
                    ,kelas: kelas
                },
                cache:false,
                success:function(respond) {
                    $("#loadpresensi").html(respond);
                },
            });
        }

        $("#tanggal").change(function(e) {
           loadpresensi();
        });

        $("#kelas").change(function(e) {
            loadpresensi();
        });

        loadpresensi();

        


     });

</script>
@endpush
