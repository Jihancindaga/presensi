<form action="/input/updateizinsakit" method="POST" id="frmizinsakit" >
    @csrf
            <div class="p-4 bg-secondary">
                <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <div class="input-group input-group-alternative mb-4">
                          <span class="input-group-text"><i class="ni ni-tag"></i></span>
                          <input class="form-control form-control-alternative" value="{{$input_izin->nisn}}" name="nisn"  id="nisn" placeholder="NISN" type="text">
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
                          <input class="form-control form-control-alternative" value="{{$input_izin->tanggal_izin}}" name="tanggal_izin"  id="tanggal_izin" placeholder="Tanggal Izin/Sakit" type="text">
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
                          <input class="form-control form-control-alternative" value="{{$input_izin->nama_lengkap}}" name="nama_lengkap"  id="nama_lengkap" placeholder="Nama Siswa" type="text">
                        </div>
                      </div>
                    </div>                          
              </div> 
                <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <div class="input-group input-group-alternative mb-4">
                          <span class="input-group-text">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-grid-3x3-gap" viewBox="0 0 16 16">
                              <path d="M4 2v2H2V2zm1 12v-2a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v2a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1m0-5V7a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v2a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1m0-5V2a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v2a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1m5 10v-2a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1v2a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1m0-5V7a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1v2a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1m0-5V2a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1v2a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1M9 2v2H7V2zm5 0v2h-2V2zM4 7v2H2V7zm5 0v2H7V7zm5 0h-2v2h2zM4 12v2H2v-2zm5 0v2H7v-2zm5 0v2h-2v-2zM12 1a1 1 0 0 0-1 1v2a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1zm-1 6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1h-2a1 1 0 0 1-1-1zm1 4a1 1 0 0 0-1 1v2a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1v-2a1 1 0 0 0-1-1z"/>
                            </svg>
                          </span>
                          <input class="form-control form-control-alternative" value="{{$input_izin->kode_kelas}}" name="kode_kelas"  id="kode_kelas" placeholder="Kelas" type="text">
                        </div>
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
                          <input class="form-control form-control-alternative" value="{{$input_izin->status}}" name="status"  id="status" placeholder="i/s" type="text">
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
                          <input class="form-control form-control-alternative" value="{{$input_izin->keterangan}}" name="keterangan"  id="keterangan" placeholder="Keterangan" type="text">
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