<!--
 * @Author: Agung Martono
 * @Github: https://github.com/agungmartono
 * @Email: agungmartonolabs@gmail.com
-->
@extends('layouts.backend.master')

@section('title', 'Registrasi Pasien Lama')

@push('css')
<link rel="stylesheet" href="{{ asset('backend/plugins/daterangepicker/daterangepicker.css') }}">
<link rel="stylesheet" href="{{ asset('backend/plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('backend/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('backend/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
@endpush

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2"></div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Formulir Tambah Registrasi</h3>
                        </div>
                        <form class="form-horizontal" action="{{ route('registration_patients.registration_patient_old') }}" method="POST" autocomplete="off">
                            @csrf
                            <input type="hidden" value="{{ $patient_registration->id }}" name="patient">
                            <div class="card-body">
                                <div class="row">

                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="name">Nama Pasien<code>*</code></label>
                                            <input type="name" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Nama Pasien" name="name" value="{{ old('name', $patient_registration->name) }}" disabled>
    
                                            @error('name')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-4">
                                        <div class="form-group">
                                            <label>Jenis Kelamin<code>*</code></label>
                                            <select name="gender" id="gender" class="form-control @error('gender') is-invalid @enderror" disabled>
                                                <option></option>
                                                <option value="0" @if (old('gender', $patient_registration->gender) == 0) selected @endif>
                                                    Laki - laki
                                                </option>
                                                <option value="1" @if (old('gender', $patient_registration->gender) == 1) selected @endif>
                                                    Perempuan
                                                </option>
                                            </select>

                                            @error('gender')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-4">
                                        <div class="form-group">
                                            <label>Nomor Telepon/HP<code>*</code></label>
                                            <input type="number" name="phone_number" id="phone_number" class="form-control @error('phone_number') is-invalid @enderror" placeholder="08XX-XXXX-XXXX" value="{{ old('phone_number', $patient_registration->phone_number) }}" disabled>
        
                                            @error('phone_number')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-4">
                                        <div class="form-group">
                                            <label>Alamat<code>*</code></label>
                                            <textarea name="address" id="address" cols="3" rows="3" placeholder="Alamat Lengkap" class="form-control @error('address') is-invalid @enderror" disabled>{{ old('address', $patient_registration->address) }}</textarea>
        
                                            @error('address')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    {{-- date('YY-m-d', strtotime($patient_registration->dob)) --}}
                                    {{-- {{ old('dob', date('YY-m-d', strtotime($patient_registration->dob))) }} --}}
                                    {{-- ultreya->date->format('Y-m-d') --}}
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label>Tanggal Lahir<code>*</code></label>
                                            <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                                <input type="text" class="form-control datetimepicker-input" data-target="#reservationdate" name="dob" value="{{ old('dob', $patient_registration->dob->format('m/d/Y')) }}" disabled/>
                                                <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker" >
                                                    <div class="input-group-text">
                                                        <i class="fa fa-calendar"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-4">
                                        <div class="form-group">
                                            <label>Tempat Lahir<code>*</code></label>
                                            <input type="text" class="form-control @error('pob') is-invalid @enderror" id="pob" placeholder="Tempat Lahir" name="pob" value="{{ old('pob', $patient_registration->pob) }}" disabled>
        
                                            @error('pob')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>


                                </div>

                                <hr>

                                <div class="row">

                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="name">Installasi<code>*</code></label>
                                            <select name="installation_id" id="installation_id" class="select2 form-control @error('installation_id') is-invalid @enderror">
                                                <option></option>
                                                <option value="0">Installasi Rawat Jalan</option>
                                                <option value="1">Installasi Rawat Inap</option>
                                            </select>

                                            @error('installation_id')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="name">Ruangan<code>*</code></label>
                                            <select name="room_id" id="room_id" class="select2 form-control @error('room_id') is-invalid @enderror">
                                                <option></option>
                                            </select>

                                            @error('room_id')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="name">Dokter<code>*</code></label>
                                            <select name="doctor_id" id="doctor_id" class="select2 form-control @error('doctor_id') is-invalid @enderror">
                                                <option></option>
                                                @foreach ($doctors as $doctor)
                                                    <option value="{{ $doctor->id }}">
                                                        {{ $doctor->name }}
                                                    </option>
                                                @endforeach
                                            </select>

                                            @error('doctor_id')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-info">Save</button>
                                <a href="{{ route('registration_patients.index') }}" class="btn btn-default float-right">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@push('js')
<script src="{{ asset('backend/plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('backend/plugins/select2/js/select2.full.min.js') }}"></script>
<script src="{{ asset('backend/plugins/daterangepicker/daterangepicker.js') }}"></script>
<script src="{{ asset('backend/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
<script>
    $('#gender').select2({
        placeholder: "Pilih Jenis Kelamin",
    });

    $('#installation_id').select2({
        placeholder: "Pilih Installasi",
    });

    $('#room_id').select2({
        placeholder: "Pilih Ruangan",
    });

    $('#doctor_id').select2({
        placeholder: "Pilih Dokter",
    });

    $('#room_id').select2({ disabled : true });

    $('#installation_id').on('change', function() {
        var installation_id = $(this).val();
        if(installation_id) {
            $.ajax({
                url: '/rooms/installation/'+installation_id,
                type: "GET",
                dataType: "json",
                success:function(data)
                {
                    $('#room_id').empty();
                    $('#room_id').select2({
                        disabled : false,
                    });

                    $.each(data, function(key, room){
                        $('select[name="room_id"]').append('<option value="'+ room.id +'">' + room.name+ '</option>');
                    });
                }
            });
        }else{
            $('#room_id').empty();
        }
    });
</script>
<script>
    $('#reservationdate').datetimepicker({
        format: 'L'
    });
</script>
@endpush
