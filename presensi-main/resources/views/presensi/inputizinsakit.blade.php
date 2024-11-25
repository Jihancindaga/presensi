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
                                    <a href="#" class="btn btn-primary" id="btnTambahsiswa">
                                        <i class="ni ni-fat-add"></i>
                                        Input Izin Sakit</a>
                                <!-- </div>
                                <div class="form-group"> -->
                                  <!-- Button trigger modal -->
                                  <!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-down-square" viewBox="0 0 16 16">
                                      <path fill-rule="evenodd" d="M15 2a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1zM0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm8.5 2.5a.5.5 0 0 0-1 0v5.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293z"/>
                                    </svg>
                                    Import Data
                                  </button>
                              </div> -->
                            </div>

                            <!-- Modal -->
                            <!-- <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                              <div class="modal-dialog">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Import Data Siswa</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                  </div>
                                  <form action="/siswa/importexcel" method="post" enctype="multipart/form-data">
                                    @csrf
                                  <div class="modal-body">
                                  <div class="form-group">
                                    <input type="file" name="file" required>
                                  </div>
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                  </div>
                                </div>
                              </form>
                              </div>
                            </div> -->

                            <form action="/siswa" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <input type="text" name="nama_siswa" id="nama_siswa" class="form-control" placeholder="Nama Siswa" value="{{ Request('nama_siswa')}}">
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <select name="kelas" id="kelas" class="form-select">
                                                <option value="">Kelas</option>
                                                @foreach ($kelas as $d)
                                                <option value="{{ $d->kode_kelas }}" {{ request('kelas') == $d->kode_kelas ? 'selected' : '' }}>{{ $d->nama_kelas }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-2">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary">
                                                <i class="fas fa-search" aria-hidden="true"></i>
                                                Cari
                                            </button>
                                        </div>
                                    </div>
                                    
    
                                </div>
                            </form>
                            <div class="card-header pb-0">
                                <h6>Authors table</h6>
                                </div>
                    <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                    <table class="table align-items-center mb-0">
                    <thead>
                    <tr>
                    <!-- <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">NO</th> -->
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">NIS</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">NAMA</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">TANGGAL</th>
                    <!-- <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">GENDER</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">NO HP</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">FOTO</th> -->
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">KELAS</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">KETERANGAN</th>

                    {{-- <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama</th> --}}
                    {{-- <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Kelas</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">NO.HP</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Foto</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Aksi</th> --}}
            
                    {{-- <th class="text-secondary opacity-7"></th> --}}
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($karyawan as $d)
                        @php
                            $path = Storage::url('uploads/karyawan/'.$d->foto)
                        @endphp
                            <tr>
                                <!-- <td>{{ $loop->iteration + $karyawan->first()->nik }}</td> -->
                                <!-- <td>{{ $d->nik}}</td>
                                <td>{{ $d->nama_lengkap}}</td> -->
                                <!-- <td>{{ $d->jabatan}}</td> -->
                                <!-- <td>{{ $d->no_hp}}</td> -->
                                <!-- <td>
                                    @if (empty($d->foto))
                                    <img src="{{asset('assets/img/nophoto.png')}}" class="avatar avatar-sm me-3" alt="">
                                    @else
                                    <img src="{{url($path)}}" class="avatar avatar-sm me-3" alt="">

                                    @endif
                                </td> -->
                                <!-- <td>{{ $d->kode_kelas}}</td> -->
                                <!-- <td>
                                  <div class="btn-group">
                                    <a href="#" class="edit btn btn-info btn-sm " nik="{{ $d->nik }}" >
                                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                          <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                          <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                                        </svg>
                                      </a>
                                  <form action="/siswa/{{ $d->nik}}/delete" method="POST" style="margin-left: 5px">
                                    @csrf
                                    <a class="btn btn-danger btn-sm delete-confirm">
                                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                                        <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5"/>
                                      </svg>
                                    </a>
                                  </form>
                                  </div>
                                   
                                </td> -->
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
{{ $karyawan->links('vendor.pagination.bootstrap-5')}}

{{-- modal edit --}}
<div class="modal fade" id="modal_editsiswa" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Data Siswa</h5>
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
<div class="modal fade" id="modal_inputsiswa" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Input Izin Sakit Siswa</h5>
          <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close" id="btnTambahsiswa">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="/presensi/inputizinsakit" method="POST" id="formsiswa" enctype="multipart/form-data">
            @csrf
                    <div class="p-4 bg-secondary">
                        <div class="row">
                            <div class="col-md-12">
                              <div class="form-group">
                                <select name="nik" id="nik" class="form-select">
                                    <option value="">NISN</option>
                                    @foreach ($karyawan as $d)
                                    <option value="{{ $d->nik }}" {{ request('karyawan') == $d->nik ? 'selected' : '' }}>{{ $d->nik }}</option>
                                    @endforeach
                                </select>
                              </div>
                            </div>                          
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <div class="input-group input-group-alternative mb-4">
                                  <span class="input-group-text">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar3" viewBox="0 0 16 16">
                                        <path d="M14 0H2a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2M1 3.857C1 3.384 1.448 3 2 3h12c.552 0 1 .384 1 .857v10.286c0 .473-.448.857-1 .857H2c-.552 0-1-.384-1-.857z"/>
                                        <path d="M6.5 7a1 1 0 1 0 0-2 1 1 0 0 0 0 2m3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2m3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2m-9 3a1 1 0 1 0 0-2 1 1 0 0 0 0 2m3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2m3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2m3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2m-9 3a1 1 0 1 0 0-2 1 1 0 0 0 0 2m3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2m3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2"/>
                                      </svg>
                                  </span>
                                  <input class="form-control form-control-alternative" value="{{Request('tanggal')}}" name="tanggal"  id="tanggal" placeholder="Tanggal" type="tanggal">
                                </div>
                              </div>
                        </div>
      <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <select name="nama_lengkap" id="nama_lengkap" class="form-select">
                    <option value="">Nama Lengkap</option>
                    @foreach ($karyawan as $d)
                    <option value="{{ $d->nama_lengkap }}" {{ request('karyawan') == $d->nama_lengkap ? 'selected' : '' }}>{{ $d->nama_lengkap }}</option>
                    @endforeach
                </select>
            </div>
        </div>                          
    </div>
      <div class="row">
        <div class="col-md-12">
        <div class="form-group">
            <select name="kode_kelas" id="kode_kelas" class="form-select">
                <option value="">Kode Kelas</option>
                @foreach ($kelas as $d)
                <option value="{{ $d->kode_kelas }}" {{ request('kelas') == $d->kode_kelas ? 'selected' : '' }}>{{ $d->nama_kelas }}</option>
                @endforeach
            </select>
        </div>                          
  </div>
      </div>
  <div class="row mb-3">
        <div class="col-md-12">
            <select name="keterangan" id="keterangan" class="form-select">
                <option value="">Keterangan</option>
                <option value="s">Sakit</option>
                <option value="a">Alpha</option>
            </select>
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
        $(function () {
             $("#btnTambahsiswa").click(function(){
                $("#modal_inputsiswa").modal("show");
             });

             $(".edit").click(function(){
                var nik = $(this).attr('nik');
                $.ajax({
                    type: 'POST'
                    , url: '/presensi/inpu_tizin'
                    , cache: false
                    , data: {
                      _token: "{{ csrf_token(); }}"
                      , nik: nik 
                    
                    }

                    , success: function(respond){
                      console.log('AJAX response:', respond); 
                       $("#loadeditform").html(respond);
                       $("#modal_editsiswa").modal("show");

                    }
             });
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

             $("#formsiswa").submit(function(){
                var nis = $("#nik").val();
                var tanggal = $("#tanggal").val();
                var nama_lengkap = $("#nama_lengkap").val();
                var kode_kelas = $("#formsiswa").find("#kode_kelas").val();
                var keterangan = $("#keterangan").val();
                if (nis == "") {
                    Swal.fire({
                        title: 'Warning!',
                        text: 'NIS harus di isi',
                        icon: 'warning',
                        confirmButtonText: 'OK'
                        }).then((result)=>{
                            $("#nik").focus();
                        })
                    
                    return false;
                }else if (tanggal == "") {
                    Swal.fire({
                        title: 'Warning!',
                        text: 'Tanggal harus di isi',
                        icon: 'warning',
                        confirmButtonText: 'OK'
                        }).then((result)=>{
                            $("#tanggal").focus();
                        })
                    
                    return false;
                }else if (nama_lengkap == "") {
                    Swal.fire({
                        title: 'Warning!',
                        text: 'Nama harus di isi',
                        icon: 'warning',
                        confirmButtonText: 'OK'
                        }).then((result)=>{
                            $("#nama_lengkap").focus();
                        })
                    
                    return false;
                }else if (kode_kelas== "") {
                    Swal.fire({
                        title: 'Warning!',
                        text: 'Kelas harus di isi',
                        icon: 'warning',
                        confirmButtonText: 'OK'
                        }).then((result)=>{
                            $("#kode_kelas").focus();
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

            $("#tanggal").datepicker({ 
            autoclose: true, 
            todayHighlight: true,
            format: 'yyyy-mm-dd'
            });
        });
    </script>
@endpush
