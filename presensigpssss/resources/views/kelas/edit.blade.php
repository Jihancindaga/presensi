<form action="/kelas/{{ $kelas->kode_kelas }}/update" method="POST" id="formKelas" >
            @csrf
                    <div class="p-4 bg-secondary">
                        <div class="row">
                            <div class="col-md-12">
                              <div class="form-group">
                                <div class="input-group input-group-alternative mb-4">
                                  <span class="input-group-text"><i class="ni ni-tag"></i></span>
                                  <input class="form-control form-control-alternative" value="{{ $kelas->kode_kelas }}" name="kode_kelas"  id="nik" placeholder="Kode Kelas" type="text" readonly>
                                </div>
                              </div>
                            </div>                          
                      </div>
                      <div class="row">
                        <div class="col-md-12">
                          <div class="form-group">
                            <div class="input-group input-group-alternative mb-4">
                              <span class="input-group-text"><i class="ni ni-circle-08"></i></span>
                              <input class="form-control form-control-alternative" value="{{ $kelas->nama_kelas }}" name="nama_kelas" id="nama_kelas" placeholder="Nama Kelas" type="text">
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