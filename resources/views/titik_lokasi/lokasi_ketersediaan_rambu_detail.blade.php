@extends('layouts.admin')
@section('content')
<!-- partial -->
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-4 grid-margin ">
                <div class="card">
                    <div class="card-body text-center ">
                        <h4 class="card-title">Foto Lokasi</h4>
                        <img src="/images/ketersediaan_rambu/{{$lokasi_rambu->ketersediaan_rambu->gambar}}"
                            width="100% " alt="">
                    </div>
                    @if($lokasi_rambu->ketersediaan_rambu->kondisi !== 1)
                    <a href="{{route('lokasi_rehab_cetak', ['id' => IDCrypt::Encrypt( $lokasi_rambu->id)])}}" class="btn btn-inverse-info"><i class="mdi mdi-printer"></i> Cetak Laporan Rehabilitasi</a>
                    @endif
                </div>
            </div>

            <div class="col-md-8 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body dashboard-tabs p-0">
                        <ul class="nav nav-tabs px-4" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="overview-tab" data-toggle="tab" href="#overview"
                                    role="tab" aria-controls="overview" aria-selected="true">keterangan lokasi ketersediaan Rambu</a>
                            </li>
                        </ul>
                        <div class="tab-content py-0 px-0">
                            <div class="tab-pane fade show active" id="overview" role="tabpanel"
                                aria-labelledby="overview-tab">
                                <div class="card-body">
                                    <h5>Kebutuhan Rambu : - {{$lokasi_rambu->rambu->nama_rambu}}</h5>
                                    <br>
                                    <h5>Kelurahan : - {{$lokasi_rambu->kelurahan->nama_kelurahan}}</h5>
                                    <br>
                                    <h5>Alamat : - {{$lokasi_rambu->alamat}}</h5>
                                    <br>
                                    <h5>APBN : - {{$lokasi_rambu->ketersediaan_rambu->apbn}}</h5>
                                    <br>
                                    <h5>Kondisi : - @if ($lokasi_rambu->ketersediaan_rambu->kondisi == 1)
                                        <span class="badge badge-success">Baik</span>
                                        @elseif ($lokasi_rambu->ketersediaan_rambu->kondisi == 2)
                                        <label class="badge badge-warning" for=""> Perlu Rehab</label>
                                        @else
                                        <label class="label-danger" for=""> Hilang</label>
                                        @endif
                                    </h5>
                                    <br>
                                    <h5>longitude : - {{$lokasi_rambu->longitude}}</h5>
                                    <br>
                                    <h5>latitude : - {{$lokasi_rambu->latitude}}</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body" id="map" style="width: 100%; height: 450px"></div>

    </div>
    @push('scripts')
    <script>
        var map = L.map('map').setView([{{$lokasi_rambu->latitude}}, {{$lokasi_rambu->longitude}}],{{config('leaflet.detail_zoom_level')}});
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);
        L.marker([{{$lokasi_rambu->latitude}},{{$lokasi_rambu->longitude}}]).addTo(map).bindPopup('{!! $lokasi_rambu->map_popup_content !!}');

    </script>
    @endpush
    @endsection
