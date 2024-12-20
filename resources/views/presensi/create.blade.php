@extends('layouts.presensi')
@section('header')
<!-- App Header -->
<div class="appHeader bg-primary text-light" style="background-color: #572079 !important">
    <div class="left">
        <a href="javascript:;" class="headerButton goBack">
            <ion-icon name="chevron-back-outline"></ion-icon>
        </a>
    </div>
    <div class="pageTitle">E-Presensi</div>
    <div class="right"></div>
</div>
<!-- * App Header -->
<style>
    .webcam-capture,
    .webcam-capture video{
        display: inline-block;
        width: 100% !important;
        margin: auto;
        height: auto !important;
        border-radius: 15px;

    }
    #map { 
        height: 200px; 
    }

</style>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"/>
     <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" ></script>
@endsection
@section('content')
<div class="row" style="margin-top:70px" >
   <div class="col">
    <input type="hidden" id="lokasi">
    <div class="webcam-capture"></div>
   </div>
</div>
<div class="row">
    <div class="col">
        @if ($cek > 0)
        <button id="takeabsen" class="btn btn-danger btn-block">
            <ion-icon name="camera-outline"></ion-icon>
            Absen Pulang
        </button> 
        @else
        <button id="takeabsen" class="btn btn-success btn-block">
            <ion-icon name="camera-outline"></ion-icon>
            Absen Masuk
        </button>
        @endif
        
    </div>
</div>
<div class="row mt-2">
    <div class="col">
        <div id="map"></div>
    </div>
</div>
@endsection

@push('myscript')
    <script>
        Webcam.set({
            height:480,
            width:640,
            image_format:'jpeg',
            jpeg_quality:80
        });

        Webcam.attach('.webcam-capture');

        var lokasi = document.getElementById('lokasi');
        if (navigator.geolocation){
            navigator.geolocation.getCurrentPosition(successCallback, errorCallback);
        }

        function successCallback(position){
            lokasi.value = position.coords.latitude+","+ position.coords.longitude;
            var map = L.map('map').setView([position.coords.latitude, position.coords.longitude], 18);
            var lokasi_sekolah = "{{ $lok_sekolah ->lokasi_sekolah }}"
            var lok = lokasi_sekolah.split(",");
            var lat_sekolah = lok[0];
            var long_sekolah = lok[1];
            var radius = "{{ $lok_sekolah->radius }}"
            L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
            }).addTo(map);
            var marker = L.marker([position.coords.latitude, position.coords.longitude]).addTo(map);
            var circle = L.circle([ lat_sekolah, long_sekolah ], {
                color: 'red',
                fillColor: '#f03',
                fillOpacity: 0.5,
                radius: radius
            }).addTo(map);
        }

        function errorCallback() {
            
        }

        $("#takeabsen").click(function(e){
            Webcam.snap(function(uri){
                image = uri;
            });
            var lokasi = $("#lokasi").val();
            $.ajax({
                type:'POST'
                , url:'/presensi/store'
                , data: {
                    _token:"{{ csrf_token() }}"
                    , image: image
                    , lokasi: lokasi
                }
                , cache: false
                , success: function(respond) {
                    var status = respond.split("|");
                    if(status [0]== "success") {
                        Swal.fire({
                            title: 'Berhasil !',
                            text: status[1],
                            icon: 'success'
                            // confirmButtonText: 'OK'
                        })
                        setTimeout("location.href='/dashboard'", 3000);
                    }else{
                        Swal.fire({
                            title: 'Error !',
                            text: status[1],
                            icon: 'error'
                            // confirmButtonText: 'OK'
                        })
                    }
                }
            });
        });

    </script>
@endpush