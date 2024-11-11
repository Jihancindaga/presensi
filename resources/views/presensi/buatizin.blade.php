@extends('layouts.presensi')
@section('header')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/css/materialize.min.css">
<style>
    .datepicker-modal {
        max-height: 430px !important;
    }
    .datepicker-date-display {
        background-color: #b5b5b5!important;
    }
</style>

<!-- {{-- App Header --}} -->
<div class="appHeader bg-primary text-light" style="background-color: #572079 !important">
    <div class="left">
        <a href="javascript:;" class="headerButton goBack">
            <ion-icon name="chevron-back-outline"></ion-icon>
        </a>
    </div>
    <div class="pageTittle">Form Izin</div>
    <div class="right"></div>
</div> 
<!-- {{-- App Header --}} -->
@endsection

@section('content')
<div class="row" style="margin-top: 70px;">
    <div class="col">
        <form method="POST" action="/presensi/storeizin" id="frmizin">
            @csrf
                    <div class="form-group">
                        <input type="text" id="tgl_izin" name="tgl_izin"  class="form-control datepicker" placeholder="Tanggal">
                    </div>
                    <div class="form-group">
                        <select name="status" id="status" class="form-control">
                            <option value="">Izin / Sakit</option>
                            <option value="i">Izin</option>
                            <option value="s">Sakit</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <textarea name="keterangan" id="keterangan" cols="30" rows="5" class="form-control" placeholder="keterangan"></textarea>
                    </div>
                    <div class="form-group">
                        <button class="btn w-100">
                            <style>
                                .btn {
                                    background-color: #572079  !important; /* Warna latar belakang 
                                    color: white !important; /* Warna teks sesuai tema, bisa diubah sesuai keinginan */
                                    border-color: #572079 !important; /* Warna garis pinggir tombol */
                                }
                                .btn:hover {
                                    background-color: #572079 !important; /* Warna latar belakang saat hover */
                                    color: white !important; /* Warna teks saat hover */
                                }
                            </style>Submit</button>
                    </div>
        </form>
    </div>
</div>
@endsection

@push('myscript')
<script>
    var currYear = (new Date()).getFullYear();

    $(document).ready(function() {
        $(".datepicker").datepicker({
            
            format: "yyyy-mm-dd"    
        });
        $('#tgl_izin').change(function(e){
            var tgl_izin = $(this).val();
            $.ajax({
                type:'POST',
                url:'/presensi/cekpengajuanizin',
                data: {
                    _token: "{{ csrf_token()}}",
                    tgl_izin: tgl_izin
                },
                cache: false,
                success: function(respond){
                    if (respond==1) {
                        Swal.fire({
                            title: 'Maaf !',
                            text: 'Anda sudah melakukan pengajuan izin untuk tanggal tersebut',
                            icon: 'warning'
                        }).then((result) => {
                           $("#tgl_izin").val(""); 
                        });
                    }
                }
            });
        });

        $("#frmizin").submit(function(){
            var tgl_izin = $("#tgl_izin").val();
            var status = $("#status").val();
            var keterangan = $("#keterangan").val();
            if(tgl_izin==""){
                Swal.fire({
                            title: 'Maaf !',
                            text: 'Tanggal harus diisi',
                            icon: 'warning'
                        });
                        return false;
            }else if(status=="") {
                Swal.fire({
                            title: 'Oops !',
                            text: 'Status harus diisi',
                            icon: 'warning'
                        });
                        return false;
            }else if(keterangan=="") {
                Swal.fire({
                            title: 'Oops !',
                            text: 'Keterangan harus diisi',
                            icon: 'warning'
                        });
                        return false;
            }
        })
    });

</script>
@endpush