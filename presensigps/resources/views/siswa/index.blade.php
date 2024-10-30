@extends('layouts.admin.dashboardboostrap')
@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
      <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
      <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Data Master</li>
    </ol>
    <h6 class="font-weight-bolder mb-0">Data Siswa</h6>
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
                                        Tambah Data</a>
                                </div>
                            </div>
                            <form action="/siswa" method="GET">
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
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">NO</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">NIS</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">NAMA</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">GENDER</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">NO HP</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">FOTO</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">KELAS</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">AKSI</th>

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
                                <td>{{ $loop->iteration + $karyawan->firstItem()-1}}</td>
                                <td>{{ $d->nik}}</td>
                                <td>{{ $d->nama_lengkap}}</td>
                                <td>{{ $d->jabatan}}</td>
                                <td>{{ $d->no_hp}}</td>
                                <td>
                                    @if (empty($d->foto))
                                    <img src="{{asset('assets/img/nophoto.png')}}" class="avatar avatar-sm me-3" alt="">
                                    @else
                                    <img src="{{url($path)}}" class="avatar avatar-sm me-3" alt="">

                                    @endif
                                </td>
                                <td>{{ $d->kode_kelas}}</td>
                                <td>
                                    <a href="#" class="edit" nik="{{ $d->nik }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                            <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                            <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                                          </svg>
                                    </a>
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
          <h5 class="modal-title" id="exampleModalLabel">Tambah Data Siswa</h5>
          <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close" id="btnTambahsiswa">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="/siswa/store" method="POST" id="formsiswa" enctype="multipart/form-data">
            @csrf
                    <div class="p-4 bg-secondary">
                        <div class="row">
                            <div class="col-md-12">
                              <div class="form-group">
                                <div class="input-group input-group-alternative mb-4">
                                  <span class="input-group-text"><i class="ni ni-tag"></i></span>
                                  <input class="form-control form-control-alternative" name="nik"  id="nik" placeholder="NIS" type="text">
                                </div>
                              </div>
                            </div>                          
                      </div>
                      <div class="row">
                        <div class="col-md-12">
                          <div class="form-group">
                            <div class="input-group input-group-alternative mb-4">
                              <span class="input-group-text"><i class="ni ni-circle-08"></i></span>
                              <input class="form-control form-control-alternative" name="nama_lengkap" id="nama_lengkap" placeholder="Nama Lengkap" type="text">
                            </div>
                          </div>
                        </div>                          
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <div class="input-group input-group-alternative mb-4">
                          <span class="input-group-text"><i class="ni ni-badge"></i></i></span>
                          <input class="form-control form-control-alternative" name="jabatan" id="jabatan" placeholder="Gender" type="text">
                        </div>
                      </div>
                    </div>                          
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <div class="input-group input-group-alternative mb-4">
                      <span class="input-group-text"><i class="ni ni-tablet-button"></i></span>
                      <input class="form-control form-control-alternative" name="no_hp" id="no_hp" placeholder="No HP" type="text">
                    </div>
                  </div>
                </div>                          
          </div>
          <div class="row mt">
            <div class="col-md-12">
                <div class="mb-4">
                    {{-- <div class="form-label">Custom File Input</div> --}}
                    <input type="file" class="form-control" id="foto" name="foto">
            </div>                          
      </div>
      <div class="row">
        <div class="col-md-12">
            <select name="kode_kelas" id="kode_kelas" class="form-select">
                <option value="">Kelas</option>
                @foreach ($kelas as $d)
                <option value="{{ $d->kode_kelas }}" {{ request('kelas') == $d->kode_kelas ? 'selected' : '' }}>{{ $d->nama_kelas }}</option>
                @endforeach
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
                    , url: '/siswa/edit'
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

             $("#formsiswa").submit(function(){
                var nis = $("#nik").val();
                var nama_lengkap = $("#nama_lengkap").val();
                var jabatan = $("#jabatan").val();
                var no_hp = $("#no_hp").val();
                var kode_kelas = $("#formsiswa").find("#kode_kelas").val();
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
                }else if (jabatan== "") {
                    Swal.fire({
                        title: 'Warning!',
                        text: 'Jabatan harus di isi',
                        icon: 'warning',
                        confirmButtonText: 'OK'
                        }).then((result)=>{
                            $("#jabatan").focus();
                        })
                    
                    return false;
                } else  if (no_hp== "") {
                    Swal.fire({
                        title: 'Warning!',
                        text: 'No HP harus di isi',
                        icon: 'warning',
                        confirmButtonText: 'OK'
                        }).then((result)=>{
                            $("#no_hp").focus();
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
                }
             });
        });
    </script>
@endpush
