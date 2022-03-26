<!--
 * @Author: Agung Martono
 * @Github: https://github.com/agungmartono
 * @Email: agungmartonolabs@gmail.com
-->
@extends('layouts.backend.master')

@section('title', 'Daftar Pasien')

@push('css')
<link rel="stylesheet" href="{{ asset('backend/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('backend/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('backend/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
<link rel="stylesheet" href="{{ asset('backend/plugins/toastr/toastr.min.css') }}">
@endpush

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2"></div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Data Pasien</h3>
                            <div class="card-tools">
                                <a href="{{ route('registration_patients.create') }}" class="btn btn-primary">
                                    Tambah Pasien Baru
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <table id="datarooms" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>No RM</th>
                                        <th>Nama Pasien</th>
                                        <th>JK</th>
                                        <th>Alamat</th>
                                        <th>No Telp</th>
                                        <th>TTL</th>
                                        <th class="text-center">Opsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($patiens as $patien)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $patien->norm }}</td>
                                        <td>{{ $patien->name }}</td>
                                        <td>
                                            @if ( $patien->gender === TRUE )
                                                L
                                            @else
                                                P
                                            @endif
                                        </td>
                                        <td>{{ $patien->address }}</td>
                                        <td>{{ $patien->phone_number }}</td>
                                        <td>{{ $patien->pob }}, {{ date('d-m-Y', strtotime($patien->dob)) }}</td>
                                        <td class="text-center">
                                            <a href="{{ route('patients.edit', $patien->id) }}" class="btn btn-primary btn-sm">
                                                <i class="fas fa-edit"></i>
                                            </a>

                                            <a class="btn btn-danger btn-sm destroy" data-id="{{ $patien->id }}" data-name="{{ $patien->name }}">
                                                <i class="fas fa-trash"></i>
                                            </a>

                                            <a href="{{ route('registration_patients.old_patient', $patien->id) }}" class="btn btn-primary btn-sm">
                                                <i class="fas fa-hand-pointer"></i>
                                            </a>
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
    </section>
</div>    
@endsection

@push('js')
<!-- DataTables  & Plugins -->
<script src="{{ asset('backend/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('backend/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('backend/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('backend/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('backend/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
<script src="{{ asset('backend/plugins/toastr/toastr.min.js') }}"></script>
<script>
    $('#datarooms').DataTable();
</script>
@if (session('type'))
<script>
    var Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 3000
    });
    Toast.fire({
        icon: '{{ session('type') }}',
        title: '{{ session('message') }}'
    })
</script>
@endif
<script>
    $('.destroy').on("click", (function (e) {
        e.preventDefault();
        const token = $("meta[name='csrf-token']").attr("content");
        const name = $(this).attr("data-name");
        const id = $(this).attr("data-id");
        const routeURL = '{{ route('rooms.destroy', ':id') }}';
        const URL = routeURL.replace(':id', id);
        Swal.fire({
            title: 'Konfirmasi',
            html: 'Anda yakin hapus ' + '<b class="text-danger">' + name.toUpperCase() + '</b>',
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, Hapus !'
          
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url : URL,
                    type : "POST",
                    data : {'_method' : 'DELETE', '_token' : token},
                    success : function(response){
                        Swal.fire({
                            icon: 'success',
                            title : 'Berhasil',
                            html :  '<b class="text-danger">' + name.toUpperCase() + '</b>' + ' Berhasil Dihapus',
                            customClass: {
                                confirmButton: 'btn btn-success'
                            }
                        }).then(function () {
                                location.reload();
                        });
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                        Swal.fire({
                            title: 'Terjadi kesalahan',
                            text: xhr.responseJSON.message,
                            icon: 'error',
                            customClass: {
                                confirmButton: 'btn btn-success'
                            }
                        }).then(function () {
                                location.reload();
                        });
                    }
                });
            }
        })
    }));
</script>
@endpush