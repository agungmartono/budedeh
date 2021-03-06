<!--
 * @Author: Agung Martono
 * @Github: https://github.com/agungmartono
 * @Email: agungmartonolabs@gmail.com
-->
@extends('layouts.backend.master')

@section('title', 'Daftar Registrasi Pasien')

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
                            <h3 class="card-title">Data Registrasi Pasien</h3>
                            <div class="card-tools">
                                <a href="{{ route('patients.index') }}" class="btn btn-primary">
                                    Tambah Registrasi
                                </a>
                            </div>
                        </div>

                        <div class="card-body">
                            <table id="datadoctors" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Tgl Registrasi</th>
                                        <th>No RM</th>
                                        <th>No Registrasi</th>
                                        <th>Nama Pasien</th>
                                        <th>Ruangan</th>
                                        <th>Dokter</th>
                                        <th class="text-center">Opsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($registrations as $registration)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $registration->registration_date }}</td>
                                        <td>{{ $registration->patient->norm }}</td>
                                        <td>{{ $registration->noregistration }}</td>
                                        <td>{{ $registration->patient->name }}</td>
                                        <td>{{ $registration->room->name }}</td>
                                        <td>{{ $registration->doctor->name }}</td>
                                        <td class="text-center text-nowrap">
                                            <a href="{{ route('registration_patients.edit', $registration->id) }}" class="btn btn-primary btn-sm">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a class="btn btn-danger btn-sm destroy" data-id="{{ $registration->id }}" data-name="{{ $registration->name }}">
                                                <i class="fas fa-trash"></i>
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
    $('#datadoctors').DataTable();
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
        const routeURL = '{{ route('registration_patients.destroy', ':id') }}';
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