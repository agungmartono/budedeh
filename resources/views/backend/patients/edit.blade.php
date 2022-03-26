<!--
 * @Author: Agung Martono
 * @Github: https://github.com/agungmartono
 * @Email: agungmartonolabs@gmail.com
-->
@extends('layouts.backend.master')

@section('title', 'Edit Pasien')

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
                            <h3 class="card-title">Formulir Edit Pasien</h3>
                        </div>
                        <form class="form-horizontal" action="{{ route('patients.update', $patient->id) }}" method="POST" autocomplete="off">
                            @csrf
                            @method('PUT')

                            <div class="card-body">
                                <div class="row">

                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="name">Nama Pasien<code>*</code></label>
                                            <input type="name" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Nama Pasien" name="name" value="{{ old('name', $patient->name) }}">
    
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
                                            <select name="gender" id="gender" class="form-control @error('gender') is-invalid @enderror">
                                                <option></option>
                                                <option value="0" @if (old('gender', $patient->gender) == 0) selected @endif>
                                                    Laki - laki
                                                </option>
                                                <option value="1" @if (old('gender', $patient->gender) == 1) selected @endif>
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
                                            <input type="number" name="phone_number" id="phone_number" class="form-control @error('phone_number') is-invalid @enderror" placeholder="08XX-XXXX-XXXX" value="{{ old('phone_number', $patient->phone_number) }}">
        
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
                                            <textarea name="address" id="address" cols="3" rows="3" placeholder="Alamat Lengkap" class="form-control @error('address') is-invalid @enderror">{{ old('address', $patient->address) }}</textarea>
        
                                            @error('address')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                 
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label>Tanggal Lahir<code>*</code></label>
                                            <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                                <input type="text" class="form-control datetimepicker-input" data-target="#reservationdate" name="dob" value="{{ old('dob', $patient->dob->format('m/d/Y')) }}"/>
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
                                            <input type="text" class="form-control @error('pob') is-invalid @enderror" id="pob" placeholder="Tempat Lahir" name="pob" value="{{ old('pob', $patient->pob) }}">
        
                                            @error('pob')
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
                                <a href="{{ route('patients.index') }}" class="btn btn-default float-right">Cancel</a>
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
