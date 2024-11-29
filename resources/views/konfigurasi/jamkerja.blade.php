@extends('layouts.admin.dashboardboostrap')
@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
      <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
      <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Laporan</li>
    </ol>
    <h6 class="font-weight-bolder mb-0">Konfigurasi Jam Kerja</h6>
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
                                    <a href="#" class="btn btn-primary" id="btnTambahJK">
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
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">KODE JK</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">NAMA JK</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">AWAL JAM MASUK</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">JAM MASUK</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">AKHIR JAM MASUK</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">JAM PULANG</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">AKSI</th>


                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($jam_kerja as $d)
                        <tr>
                            <td>{{ $loop->iteration}}</td>
                            <td>{{ $d->kode_jam_kerja}}</td>
                            <td>{{ $d->nama_jam_kerja}}</td>
                            <td>{{ $d->awal_jam_masuk}}</td>
                            <td>{{ $d->jam_masuk}}</td>
                            <td>{{ $d->akhir_jam_masuk}}</td>
                            <td>{{ $d->jam_pulang}}</td>
                            <td>
                              <div class="btn-group">
                                <a href="#" class="edit btn btn-info btn-sm " kode_jam_kerja="{{ $d->kode_jam_kerja }}" >
                                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                      <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                      <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                                    </svg>
                                  </a>
                              <form action="/konfigurasi/{{ $d->kode_jam_kerja}}/delete" method="POST" style="margin-left: 5px">
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
<div class="modal fade" id="modal_editjk" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Data Jam Kerja</h5>
        <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close" id="btnEditsiswa">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="loadeditform">

      </div>
    </div>
  </div>
</div>
  <!-- Modal Tambah -->
<div class="modal fade" id="modal_inputjk" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Tambah Data Jam Kerja</h5>
          <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close" id="btnTambahJK">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="/konfigurasi/storejamkerja" method="POST" id="frmJK" >
            @csrf
                    <div class="p-4 bg-secondary">
                        <div class="row">
                            <div class="col-md-12">
                              <div class="form-group">
                                <div class="input-group input-group-alternative mb-4">
                                  <span class="input-group-text"><i class="ni ni-tag"></i></span>
                                  <input class="form-control form-control-alternative" name="kode_jam_kerja"  id="kode_jam_kerja" placeholder="Kode Jam Kerja" type="text">
                                </div>
                              </div>
                            </div>                          
                      </div>     
                        <div class="row">
                            <div class="col-md-12">
                              <div class="form-group">
                                <div class="input-group input-group-alternative mb-4">
                                  <span class="input-group-text">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-upc-scan" viewBox="0 0 16 16">
                                      <path d="M1.5 1a.5.5 0 0 0-.5.5v3a.5.5 0 0 1-1 0v-3A1.5 1.5 0 0 1 1.5 0h3a.5.5 0 0 1 0 1zM11 .5a.5.5 0 0 1 .5-.5h3A1.5 1.5 0 0 1 16 1.5v3a.5.5 0 0 1-1 0v-3a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 1-.5-.5M.5 11a.5.5 0 0 1 .5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 1 0 1h-3A1.5 1.5 0 0 1 0 14.5v-3a.5.5 0 0 1 .5-.5m15 0a.5.5 0 0 1 .5.5v3a1.5 1.5 0 0 1-1.5 1.5h-3a.5.5 0 0 1 0-1h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 1 .5-.5M3 4.5a.5.5 0 0 1 1 0v7a.5.5 0 0 1-1 0zm2 0a.5.5 0 0 1 1 0v7a.5.5 0 0 1-1 0zm2 0a.5.5 0 0 1 1 0v7a.5.5 0 0 1-1 0zm2 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm3 0a.5.5 0 0 1 1 0v7a.5.5 0 0 1-1 0z"/>
                                    </svg></span>
                                  <input class="form-control form-control-alternative" name="nama_jam_kerja"  id="nama_jam_kerja" placeholder="Nama Jam Kerja" type="text">
                                </div>
                              </div>
                            </div>                          
                      </div> 
                        <div class="row">
                            <div class="col-md-12">
                              <div class="form-group">
                                <div class="input-group input-group-alternative mb-4">
                                  <span class="input-group-text">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-alarm" viewBox="0 0 16 16">
                                      <path d="M8.5 5.5a.5.5 0 0 0-1 0v3.362l-1.429 2.38a.5.5 0 1 0 .858.515l1.5-2.5A.5.5 0 0 0 8.5 9z"/>
                                      <path d="M6.5 0a.5.5 0 0 0 0 1H7v1.07a7.001 7.001 0 0 0-3.273 12.474l-.602.602a.5.5 0 0 0 .707.708l.746-.746A6.97 6.97 0 0 0 8 16a6.97 6.97 0 0 0 3.422-.892l.746.746a.5.5 0 0 0 .707-.708l-.601-.602A7.001 7.001 0 0 0 9 2.07V1h.5a.5.5 0 0 0 0-1zm1.038 3.018a6 6 0 0 1 .924 0 6 6 0 1 1-.924 0M0 3.5c0 .753.333 1.429.86 1.887A8.04 8.04 0 0 1 4.387 1.86 2.5 2.5 0 0 0 0 3.5M13.5 1c-.753 0-1.429.333-1.887.86a8.04 8.04 0 0 1 3.527 3.527A2.5 2.5 0 0 0 13.5 1"/>
                                    </svg>
                                  </span>
                                  <input class="form-control form-control-alternative" name="awal_jam_masuk"  id="awal_jam_masuk" placeholder="Awal Jam Masuk" type="text">
                                </div>
                              </div>
                            </div>                          
                      </div> 
                        <div class="row">
                            <div class="col-md-12">
                              <div class="form-group">
                                <div class="input-group input-group-alternative mb-4">
                                  <span class="input-group-text">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-alarm" viewBox="0 0 16 16">
                                      <path d="M8.5 5.5a.5.5 0 0 0-1 0v3.362l-1.429 2.38a.5.5 0 1 0 .858.515l1.5-2.5A.5.5 0 0 0 8.5 9z"/>
                                      <path d="M6.5 0a.5.5 0 0 0 0 1H7v1.07a7.001 7.001 0 0 0-3.273 12.474l-.602.602a.5.5 0 0 0 .707.708l.746-.746A6.97 6.97 0 0 0 8 16a6.97 6.97 0 0 0 3.422-.892l.746.746a.5.5 0 0 0 .707-.708l-.601-.602A7.001 7.001 0 0 0 9 2.07V1h.5a.5.5 0 0 0 0-1zm1.038 3.018a6 6 0 0 1 .924 0 6 6 0 1 1-.924 0M0 3.5c0 .753.333 1.429.86 1.887A8.04 8.04 0 0 1 4.387 1.86 2.5 2.5 0 0 0 0 3.5M13.5 1c-.753 0-1.429.333-1.887.86a8.04 8.04 0 0 1 3.527 3.527A2.5 2.5 0 0 0 13.5 1"/>
                                    </svg>
                                  </span>
                                  <input class="form-control form-control-alternative" name="jam_masuk"  id="jam_masuk" placeholder="Jam Masuk" type="text">
                                </div>
                              </div>
                            </div>                          
                      </div>   
                        <div class="row">
                            <div class="col-md-12">
                              <div class="form-group">
                                <div class="input-group input-group-alternative mb-4">
                                  <span class="input-group-text">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-alarm" viewBox="0 0 16 16">
                                      <path d="M8.5 5.5a.5.5 0 0 0-1 0v3.362l-1.429 2.38a.5.5 0 1 0 .858.515l1.5-2.5A.5.5 0 0 0 8.5 9z"/>
                                      <path d="M6.5 0a.5.5 0 0 0 0 1H7v1.07a7.001 7.001 0 0 0-3.273 12.474l-.602.602a.5.5 0 0 0 .707.708l.746-.746A6.97 6.97 0 0 0 8 16a6.97 6.97 0 0 0 3.422-.892l.746.746a.5.5 0 0 0 .707-.708l-.601-.602A7.001 7.001 0 0 0 9 2.07V1h.5a.5.5 0 0 0 0-1zm1.038 3.018a6 6 0 0 1 .924 0 6 6 0 1 1-.924 0M0 3.5c0 .753.333 1.429.86 1.887A8.04 8.04 0 0 1 4.387 1.86 2.5 2.5 0 0 0 0 3.5M13.5 1c-.753 0-1.429.333-1.887.86a8.04 8.04 0 0 1 3.527 3.527A2.5 2.5 0 0 0 13.5 1"/>
                                    </svg>
                                  </span>
                                  <input class="form-control form-control-alternative" name="akhir_jam_masuk"  id="akhir_jam_masuk" placeholder="Akhir Jam Masuk" type="text">
                                </div>
                              </div>
                            </div>                          
                      </div>  
                        <div class="row">
                            <div class="col-md-12">
                              <div class="form-group">
                                <div class="input-group input-group-alternative mb-4">
                                  <span class="input-group-text">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-alarm" viewBox="0 0 16 16">
                                      <path d="M8.5 5.5a.5.5 0 0 0-1 0v3.362l-1.429 2.38a.5.5 0 1 0 .858.515l1.5-2.5A.5.5 0 0 0 8.5 9z"/>
                                      <path d="M6.5 0a.5.5 0 0 0 0 1H7v1.07a7.001 7.001 0 0 0-3.273 12.474l-.602.602a.5.5 0 0 0 .707.708l.746-.746A6.97 6.97 0 0 0 8 16a6.97 6.97 0 0 0 3.422-.892l.746.746a.5.5 0 0 0 .707-.708l-.601-.602A7.001 7.001 0 0 0 9 2.07V1h.5a.5.5 0 0 0 0-1zm1.038 3.018a6 6 0 0 1 .924 0 6 6 0 1 1-.924 0M0 3.5c0 .753.333 1.429.86 1.887A8.04 8.04 0 0 1 4.387 1.86 2.5 2.5 0 0 0 0 3.5M13.5 1c-.753 0-1.429.333-1.887.86a8.04 8.04 0 0 1 3.527 3.527A2.5 2.5 0 0 0 13.5 1"/>
                                    </svg>
                                  </span>
                                  <input class="form-control form-control-alternative" name="jam_pulang"  id="jam_pulang" placeholder="Jam Pulang" type="text">
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
            $("#btnTambahJK").click(function(){
                $("#modal_inputjk").modal("show");
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

             
             $("#frmJK").submit(function(){
                var kode_jam_kerja = $("#kode_jam_kerja").val();
                var nama_jam_kerja = $("#nama_jam_kerja").val();
                var awal_jam_masuk = $("#awal_jam_masuk").val();
                var jam_masuk = $("#jam_masuk").val();
                var akhir_jam_masuk = $("#akhir_jam_masuk").val();
                var jam_pulang = $("#jam_pulang").val();

                if (kode_jam_kerja == "") {
                    Swal.fire({
                        title: 'Warning!',
                        text: 'Kode Jam Kerja harus di isi',
                        icon: 'warning',
                        confirmButtonText: 'OK'
                        }).then((result)=>{
                            $("#kode_jam_kerja").focus();
                        })
                    
                    return false;
                }else if (nama_jam_kerja == "") {
                    Swal.fire({
                        title: 'Warning!',
                        text: 'Nama Jam Kerja harus di isi',
                        icon: 'warning',
                        confirmButtonText: 'OK'
                        }).then((result)=>{
                            $("#nama_jam_kerja").focus();
                        })
                    
                    return false;
                }else if (awal_jam_masuk== "") {
                    Swal.fire({
                        title: 'Warning!',
                        text: 'Awal Jam Masuk harus di isi',
                        icon: 'warning',
                        confirmButtonText: 'OK'
                        }).then((result)=>{
                            $("#awal_jam_masuk").focus();
                        })
                    
                    return false;
                } else  if (jam_masuk== "") {
                    Swal.fire({
                        title: 'Warning!',
                        text: 'Jam Masuk harus di isi',
                        icon: 'warning',
                        confirmButtonText: 'OK'
                        }).then((result)=>{
                            $("#jam_masuk").focus();
                        })
                    
                    return false;
                }else if (akhir_jam_masuk== "") {
                    Swal.fire({
                        title: 'Warning!',
                        text: 'Akhir Jam Masuk harus di isi',
                        icon: 'warning',
                        confirmButtonText: 'OK'
                        }).then((result)=>{
                            $("#akhir_jam_masuk").focus();
                        })
                    
                    return false;
                }else if (jam_pulang== "") {
                    Swal.fire({
                        title: 'Warning!',
                        text: 'Jam Pulang harus di isi',
                        icon: 'warning',
                        confirmButtonText: 'OK'
                        }).then((result)=>{
                            $("#jam_pulang").focus();
                        })
                    
                    return false;
                }
             });
             $(".edit").click(function(){
                var kode_jam_kerja = $(this).attr('kode_jam_kerja');
                $.ajax({
                    type: 'POST'
                    , url: '/konfigurasi/editjamkerja'
                    , cache: false
                    , data: {
                      _token: "{{ csrf_token(); }}"
                      , kode_jam_kerja: kode_jam_kerja 
                    
                    }

                    , success: function(respond){
                      console.log('AJAX response:', respond); 
                       $("#loadeditform").html(respond);
                       $("#modal_editjk").modal("show");

                    }
                });
             });
        });
    </script>
@endpush