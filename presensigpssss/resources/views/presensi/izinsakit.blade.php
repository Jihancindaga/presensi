@extends('layouts.admin.dashboardboostrap')
@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
      <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
      <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Data Master</li>
    </ol>
    <h6 class="font-weight-bolder mb-0">Data Izin / Sakit</h6>
  </nav>

  <div class="page-body">
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Tanggal</th>
                            <th>Nik</th>
                            <th>Nama Siswa</th>
                            <th>Kelas</th>
                            <th>Status</th>
                            <th>Keterangan</th>
                            <th>Status Approve</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($izinsakit as $d)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ date('d-m-Y',strtotime($d->tgl_izin)) }}</td>
                            <td>{{ $d->nik }}</td>
                            <td>{{ $d->nama_lengkap }}</td>
                            <td>{{ $d->kode_kelas }}</td>
                            <td>{{ $d->status == "i" ? "Izin" : "Sakit" }}</td>
                            <td>{{ $d->keterangan }}</td>
                            <td>
                                @if ($d->status_approved==1)
                                    <span class="badge bg-success">Disetujui</span>
                                @elseif($d->status_approved==2)
                                    <span class="badge bg-danger">Ditolak</span>
                                @else
                                    <span class="badge bg-warning">Pending</span>
                                @endif
                            </td>
                            <td>
                                @if ($d->status_approved==0)
                                <a href="/presensi/{{ $d->id }}/batalkanizinsakit" class="btn btn-sm btn-primary" id="approve" id_izinsakit="{{ $d->id }}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-up-right" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M8.636 3.5a.5.5 0 0 0-.5-.5H1.5A1.5 1.5 0 0 0 0 4.5v10A1.5 1.5 0 0 0 1.5 16h10a1.5 1.5 0 0 0 1.5-1.5V7.864a.5.5 0 0 0-1 0V14.5a.5.5 0 0 1-.5.5h-10a.5.5 0 0 1-.5-.5v-10a.5.5 0 0 1 .5-.5h6.636a.5.5 0 0 0 .5-.5"/>
                                <path fill-rule="evenodd" d="M16 .5a.5.5 0 0 0-.5-.5h-5a.5.5 0 0 0 0 1h3.793L6.146 9.146a.5.5 0 1 0 .708.708L15 1.707V5.5a.5.5 0 0 0 1 0z"/>
                                </svg>
                                </a>
                                @else
                                <a href="#" class="btn btn-sm btn-danger">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-square" viewBox="0 0 16 16">
                                <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2z"/>
                                <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708"/>
                                </svg>
                                Batalkan 
                                </a>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
  </div>
  <div class="modal fade" id="modal-izinsakit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Izin/Sakit</h5>
        <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close" id="btnEditsiswa">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
           <form action="/presensi/approveizinsakit" method="POST">
            @csrf
            <input type="hidden" id="id_izinsakit_form" name="id_izinsakit_form">
            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <select name="status_approved" id="status_approved" class="form-select">
                            <option value="1">Disetujui</option>
                            <option value="2">Ditolak</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row mt-1">
                <div class="col-12">
                    <div class="form-group">
                        <button class="btn btn-primary w-100" type="submit">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-send" viewBox="0 0 16 16">
                        <path d="M15.854.146a.5.5 0 0 1 .11.54l-5.819 14.547a.75.75 0 0 1-1.329.124l-3.178-4.995L.643 7.184a.75.75 0 0 1 .124-1.33L15.314.037a.5.5 0 0 1 .54.11ZM6.636 10.07l2.761 4.338L14.13 2.576zm6.787-8.201L1.591 6.602l4.339 2.76z"/>
                        </svg>
                        submit
                        </button>                    
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
    $(function() {
         $("#approve").click(function(e){
            e.preventDefault();
            var id_izinsakit = $(this).attr("id_izinsakit");
            $("#id_izinsakit_form").val(id_izinsakit);
            $("#modal-izinsakit").modal("show");
         });
    });
  </script>

  @endpush