@extends('layouts.admin')
@section('content')
<!-- partial -->
<div class="main-panel">
    <div class="content-wrapper">
        @include('layouts.errors')
        @include('layouts.alert')
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h3>Data Jenis Rambu</h3>
                        <div class="text-right">
                            <a href="" class="btn btn-sm btn-primary " data-toggle="modal"
                                data-target="#exampleModalCenter"> <i class=" mdi mdi-plus "></i> tabah data</a>
                        </div>
                        <br>
                        <div class="table-responsive">
                            <table class="table striped " id="myTable">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Jenis Rambu</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $no=1;
                                    @endphp
                                    @foreach ($jenis_rambu as $jr)
                                    <tr>
                                        <td>{{$no++}}</td>
                                        <td>Rambu {{$jr->nama_jenis}}</td>
                                        <td class="text-center">
                                            <a href="{{route('jenis_rambu_detail', ['id' => IDCrypt::Encrypt( $jr->id)])}}"
                                                class="btn btn-inverse-success" style="padding:6px !important;"> <i
                                                    class=" mdi mdi-eye "></i></a>
                                            <a href="{{route('jenis_rambu_edit', ['id' => IDCrypt::Encrypt( $jr->id)])}}"
                                                class="btn btn-inverse-info" style="padding:6px !important;"> <i
                                                    class="mdi mdi-pencil"></i></a>
                                            <button type="button" class="btn btn-inverse-danger"
                                                style="padding:6px !important;"
                                                onclick="Hapus('{{Crypt::encryptString($jr->id)}}','{{$jr->nama_jenis}}')"><b><i
                                                        class="mdi mdi-delete"></i></b></button>
                                        </td>
                                    </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>


    <!-- Modal -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Tambah Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="forms-sample" method="post" action="">
                        <div class="form-group">
                            <label for="exampleInputUsername1">Nama Jenis</label>
                            <input type="text" class="form-control" id="nama_jenis" name="nama_jenis"
                                placeholder="Nama jenis rambu">
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-inverse-danger" data-dismiss="modal">Close</button>
                    <input class="btn btn-inverse-primary" type="submit" name="submit" value="Submit">
                    {{csrf_field() }}
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- content-wrapper ends -->
    @endsection


    <script>
        function Hapus(id, nama_jenis) {
            Swal.fire({
                title: 'apa anda yakin?',
                text: " Menghapus Kecamatan '" + nama_jenis +
                    "' juga akan menghapus data kelurahan yang berelasi",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'hapus data',
                cancelButtonText: 'batal',
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    window.location = "/jenis_rambu_hapus/" + id;
                } else if (
                    // Read more about handling dismissals
                    result.dismiss === swal.DismissReason.cancel
                ) {
                    Swal.fire(
                        'Dibatalkan',
                        'data batal dihapus',
                        'error'
                    )
                }
            })

        }

    </script>
