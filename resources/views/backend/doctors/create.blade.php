<!--
 * @Author: Agung Martono
 * @Github: https://github.com/agungmartono
 * @Email: agungmartonolabs@gmail.com
-->
@extends('layouts.backend.master')

@section('title', 'Tambah Dokter')

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
                            <h3 class="card-title">Formulir Tambah Dokter</h3>
                        </div>
                        <form class="form-horizontal" action="{{ route('doctors.store') }}" method="POST" autocomplete="off">
                            @csrf
                            <div class="card-body">
                                <div class="form-group row">
                                    <label for="name" class="col-sm-3 col-form-label">
                                        Nama Dokter
                                    </label>
                                    <div class="col-sm-9">
                                        <input type="name" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Nama Dokter" name="name" value="{{ old('name') }}">

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
                                <a href="{{ route('doctors.index') }}" class="btn btn-default float-right">Cancel</a>
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
