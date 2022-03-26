<!--
 * @Author: Agung Martono
 * @Github: https://github.com/agungmartono
 * @Email: agungmartonolabs@gmail.com
-->
@extends('layouts.backend.master')

@push('css')
<link rel="stylesheet" href="{{ asset('backend/plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('backend/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
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
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Formulir Tambah Ruangan</h3>
                        </div>
                        <form class="form-horizontal" action="{{ route('rooms.store') }}" method="POST" autocomplete="off">
                            @csrf
                            <div class="card-body">
                                <div class="form-group row">
                                    <label for="installation" class="col-sm-3 col-form-label">Instalasi</label>
                                    <div class="col-sm-9">
                                        <select name="installation" id="installation" class=" form-control select2 @error('installation') is-invalid @enderror">
                                            <option></option>
                                            <option value="0" @selected(old('installation') == '0')>Instalasi Rawat Jalan</option>
                                            <option value="1" @selected(old('installation') == '1')>Instalasi Rawat Inap</option>
                                        </select>

                                        @error('installation')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="name" class="col-sm-3 col-form-label">
                                        Nama Ruangan
                                    </label>
                                    <div class="col-sm-9">
                                        <input type="name" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Nama Ruangan" name="name" value="{{ old('name') }}">

                                        @error('name')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-info">Save</button>
                                <a href="{{ route('rooms.index') }}" class="btn btn-default float-right">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
@endsection

@push('js')
<script src="{{ asset('backend/plugins/select2/js/select2.full.min.js') }}"></script>
<script>
    $('.select2').select2({
        placeholder: "Pilih Instalasi",
        allowClear: true
    });
</script>
@endpush
