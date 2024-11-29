@extends('layouts.admin.dashboardboostrap')
@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
      <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
      <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Data Master</li>
    </ol>
    <h6 class="font-weight-bolder mb-0">Input Izin Sakit Siswa</h6>
</nav>

<div class="page-body">
  <div class="container-fluid py-4">
    <div class="row">
      <div class="col-12">
        <div class="card mb-4">
          <div class="card">
            <div class="card-body">
              <div class="row">
                <div class="col-12">
                    @if (Session::get('success'))
                    <div class="alert alert-success">
                        {{ Session::get('success') }}
                    </div>
                    @endif

                    @if (Session::get('warning'))
                    <div class="alert alert-warning">
                        {{  Session::get('warning') }}
                    </div>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <a href="#" class="btn btn-primary" id="btnTambahizinsakit">
                        <i class="ni ni-fat-add"></i>
                        Tambah Data</a>
                </div>
            </div>
            <div class="card-header pb-0">
                <h6>Authors table</h6>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                <thead>
                <tr>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">NO</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">NISN</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">TANGGAL</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">NAMA SISWA</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">KELAS</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">STATUS</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">KETERANGAN</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">AKSI</th>


                </tr>
                </thead>
                <tbody>
                    @foreach ($inputizin as $d)
                    <tr>
                        <td>{{ $loop->iteration}}</td>
                        <td>{{ $d->nisn}}</td>
                        <td>{{ $d->tanggal_izin}}</td>
                        <td>{{ $d->nama_lengkap}}</td>
                        <td>{{ $d->nama_kelas}}</td>
                        <td>{{ $d->status}}</td>
                        <td>{{ $d->keterangan}}</td>
                        <td>
                          <div class="btn-group">
                            <a href="#" class="edit btn btn-info btn-sm " nisn="{{ $d->nisn }}" >
                              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                  <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                  <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                                </svg>
                              </a>
                          <form action="/input/{{ $d->nisn}}/delete" method="POST" style="margin-left: 5px">
                            @csrf
                            <a class="btn btn-danger btn-sm delete-confirm">
                              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                                <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5"/>
                              </svg>
                            </a>
                          </form>
                          </div>
                        </td>
                    </tr>


                    @endforeach
                </tbody>
            </div>
        </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
  {{-- modal edit --}}
  <div class="modal fade" id="modal_editizinsakit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit Data Izin/Sakit</h5>
          <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close" id="btnEditizinsakit">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" id="loadeditform">
  
        </div>
      </div>
    </div>
  </div>
    <!-- Modal Tambah -->
  <div class="modal fade" id="modal_inputizinsakit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Tambah Data Jam Kerja</h5>
            <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close" id="btnTambahizinsakit">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="/input/storeizinsakit" method="POST" id="frmizinsakit" >
              @csrf
                      <div class="p-4 bg-secondary">
                          <div class="row">
                              <div class="col-md-12">
                                <div class="form-group">
                                  <div class="input-group input-group-alternative mb-4">
                                    <span class="input-group-text"><i class="ni ni-tag"></i></span>
                                    <input class="form-control form-control-alternative" name="nisn"  id="nisn" placeholder="NISN" type="text">
                                  </div>
                                </div>
                              </div>                          
                        </div>     
                          <div class="row">
                              <div class="col-md-12">
                                <div class="form-group">
                                  <div class="input-group input-group-alternative mb-4">
                                    <span class="input-group-text">
                                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar" viewBox="0 0 16 16">
                                        <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5M1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4z"/>
                                      </svg></span>
                                    <input class="form-control form-control-alternative" name="tanggal_izin"  id="tanggal_izin" placeholder="Tanggal Izin/Sakit" type="text">
                                  </div>
                                </div>
                              </div>                          
                        </div> 
                          <div class="row">
                              <div class="col-md-12">
                                <div class="form-group">
                                  <div class="input-group input-group-alternative mb-4">
                                    <span class="input-group-text">
                                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                                        <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>
                                        <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1"/>
                                      </svg>
                                    </span>
                                    <input class="form-control form-control-alternative" name="nama_lengkap"  id="nama_lengkap" placeholder="Nama Siswa" type="text">
                                  </div>
                                </div>
                              </div>                          
                        </div> 
                        
                          <div class="row">
                              <div class="col-md-12">
                                <div class="form-group">
                                  <select name="kode_kelas" id="kode_kelas" class="form-select">
                                    <option value="">Kelas</option>
                                    @foreach ($kelas as $d)
                                    <option value="{{ $d->kode_kelas }}" {{ request('kelas') == $d->kode_kelas ? 'selected' : '' }}>{{ $d->nama_kelas }}</option>
                                    @endforeach
                                </select>
                                </div>
                              </div>                          
                        </div>   
                          <div class="row">
                              <div class="col-md-12">
                                <div class="form-group">
                                  <div class="input-group input-group-alternative mb-4">
                                    <span class="input-group-text">
                                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-person" viewBox="0 0 16 16">
                                        <path d="M11 8a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>
                                        <path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2M9.5 3A1.5 1.5 0 0 0 11 4.5h2v9.255S12 12 8 12s-5 1.755-5 1.755V2a1 1 0 0 1 1-1h5.5z"/>
                                      </svg>
                                    </span>
                                    <input class="form-control form-control-alternative" name="status"  id="status" placeholder="i/s" type="text">
                                  </div>
                                </div>
                              </div>                          
                        </div>  
                          <div class="row">
                              <div class="col-md-12">
                                <div class="form-group">
                                  <div class="input-group input-group-alternative mb-4">
                                    <span class="input-group-text">
                                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-card-text" viewBox="0 0 16 16">
                                        <path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2z"/>
                                        <path d="M3 5.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5M3 8a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9A.5.5 0 0 1 3 8m0 2.5a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5"/>
                                      </svg>
                                    </span>
                                    <input class="form-control form-control-alternative" name="keterangan"  id="keterangan" placeholder="Keterangan" type="text">
                                  </div>
                                </div>
                              </div>                          
                        </div>        
                      <div class="row mt-3">
                          <div class="col-12">
                              <div class="col-group">
                                  <button class="btn btn-primary w-100">Simpan</button>
                              </div>
                          </div>
                      </div>              
            </form>
          </div>
        </div>
      </div>
    </div>
@endsection


@push('myscript')
    <script>
        $(function(){
            $("#btnTambahizinsakit").click(function(){
                $("#modal_inputizinsakit").modal("show");
             });

             $(".delete-confirm").click(function(e){
              var form = $(this).closest('form');
              e.preventDefault();
              Swal.fire({
                  title: "Apakah anda yakin data ini akan dihapus?",
                  text: "Jika 'ya' maka data akan terhapus!",
                  icon: "warning",
                  showCancelButton: true,
                  confirmButtonColor: "#cb0c9f",
                  cancelButtonColor: "#d33",
                  confirmButtonText: "Ya, Hapus"
                }).then((result) => {
                  if (result.isConfirmed) {
                    form.submit();
                    Swal.fire({
                      title: "Terhapus!",
                      text: "Data berhasil dihapus.",
                      icon: "success"
                    });
                  }
                });
             });

             
             $("#frmizinsakit").submit(function(){
                var nisn = $("#nisn").val();
                var tanggal_izin = $("#tanggal_izin").val();
                var nama_lengkap = $("#nama_lengkap").val();
                var kode_kelas = $("#kode_kelas").val();
                var status = $("#status").val();
                var keterangan = $("#keterangan").val();

                if (nisn == "") {
                    Swal.fire({
                        title: 'Warning!',
                        text: 'NISN harus di isi',
                        icon: 'warning',
                        confirmButtonText: 'OK'
                        }).then((result)=>{
                            $("#nisn").focus();
                        })
                    
                    return false;
                }else if (tanggal_izin == "") {
                    Swal.fire({
                        title: 'Warning!',
                        text: 'Tanggal izin harus di isi',
                        icon: 'warning',
                        confirmButtonText: 'OK'
                        }).then((result)=>{
                            $("#tanggal_izin").focus();
                        })
                    
                    return false;
                }else if (nama_lengkap== "") {
                    Swal.fire({
                        title: 'Warning!',
                        text: 'Nama lengkap harus di isi',
                        icon: 'warning',
                        confirmButtonText: 'OK'
                        }).then((result)=>{
                            $("#nama_lengkap").focus();
                        })
                    
                    return false;
                } else  if (kode_kelas== "") {
                    Swal.fire({
                        title: 'Warning!',
                        text: 'Kelas harus di isi',
                        icon: 'warning',
                        confirmButtonText: 'OK'
                        }).then((result)=>{
                            $("#kode_kelas").focus();
                        })
                    
                    return false;
                }else if (status== "") {
                    Swal.fire({
                        title: 'Warning!',
                        text: 'Status harus di isi',
                        icon: 'warning',
                        confirmButtonText: 'OK'
                        }).then((result)=>{
                            $("#status").focus();
                        })
                    
                    return false;
                }else if (keterangan== "") {
                    Swal.fire({
                        title: 'Warning!',
                        text: 'Keterangan harus di isi',
                        icon: 'warning',
                        confirmButtonText: 'OK'
                        }).then((result)=>{
                            $("#keterangan").focus();
                        })
                    
                    return false;
                }
             });
             $(".edit").click(function(){
                var nisn = $(this).attr('nisn');
                $.ajax({
                    type: 'POST'
                    , url: '/input/editizinsakit'
                    , cache: false
                    , data: {
                      _token: "{{ csrf_token(); }}"
                      , nisn: nisn 
                    
                    }

                    , success: function(respond){
                      console.log('AJAX response:', respond); 
                       $("#loadeditform").html(respond);
                       $("#modal_editizinsakit").modal("show");

                    }
                });
             });
        });
    </script>
@endpush