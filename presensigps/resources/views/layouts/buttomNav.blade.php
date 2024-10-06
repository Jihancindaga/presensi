 <!-- App Bottom Menu -->
 <div class="appBottomMenu">
    <a href="/dashboard" class="item {{ request()->is('dashboard') ? 'active' : ''}}">
        <div class="col">
            <ion-icon name="home-outline"></ion-icon>
            <strong>Home</strong>
        </div>
    </a>
    <a href="/presensi/histori" class="item {{ request()->is('presensi/histori') ? 'active' : ''}}">
        <div class="col">
            <ion-icon name="document-text-outline" role="img" class="md hydrated"
                aria-label="document text outline"></ion-icon>
            <strong>Histori</strong>
        </div>
    </a>
    <a href="/presensi/create" class="item ">
        <div class="col">
            <div class="action-button large">
                <ion-icon name="camera" role="img" class="md hydrated" aria-label="add outline"></ion-icon>
            </div>
        </div>
    </a>
<<<<<<< HEAD
    <a href="/presensi/izin" class="item {{ request()->is('presensi/izin') ? 'active' : ''}}">
=======
    <a href="/presensi/izin" class="item">
>>>>>>> 383476d2e3d45ba5edfbd8fcf5d1c0ff40f8b442
        <div class="col">
        <ion-icon name="calendar-outline"></ion-icon>
            <strong>Izin</strong>
        </div>
    </a>
    <a href="/editprofile" class="item {{ request()->is('editprofile') ? 'active' : ''}}">
        <div class="col">
            <ion-icon name="people-outline" role="img" class="md hydrated" aria-label="people outline"></ion-icon>
            <strong>Profile</strong>
        </div>
    </a>
</div>
<!-- * App Bottom Menu -->