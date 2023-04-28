@extends('welcome')

@section('dashboards')
<!-- Earnings (Monthly) Card Example -->
<div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                       Total Pengguna</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $total_users }} Orang</div>
                </div>
                <div class="col-auto">
                    <i class="fas fa-users fa-2x text-gray-300"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Earnings (Monthly) Card Example -->
<div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-success shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                        Total Master</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $total_masters }} Master Data</div>
                </div>
                <div class="col-auto">
                    <i class="fas fa-briefcase fa-2x text-gray-300"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Pending Requests Card Example -->
<div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-warning shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                        Total Koleksi Koding</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $total_koleksi }} Koleksi</div>
                </div>
                <div class="col-auto">
                    <i class="fas fa-book fa-2x text-gray-300"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-lg-6 mb-4">

    <!-- Illustrations -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Apakah itu <b>Code Collection</b> ?</h6>
        </div>
        <div class="card-body">
            <div class="text-center">
                <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 25rem;" src="{{ asset('templates') }}/img/undraw_posting_photo.svg" alt="...">
            </div>
            <p>Aplikasi yang digunakan untuk menyimpan berbagai kode untuk keperluan dokumentasi,
                sehingga nantinya dapat diakses dengan mudah tanpa perlu browsing atau membuka project lagi!</p>
            <a target="_blank" rel="nofollow" href="" class="badge badge-primary">Traktir Developer...</a> <span class="badge badge-success">👈</span>
        </div>
    </div>

</div>
@endsection
