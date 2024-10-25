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