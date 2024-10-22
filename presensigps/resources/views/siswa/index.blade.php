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

                                                {{-- <option value="{{ $d->nama_kelas}}">{{ $d->kode_kelas}}</option>                                                 --}}
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
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">KELAS</th>
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
                                <td></td>
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


@endsection
