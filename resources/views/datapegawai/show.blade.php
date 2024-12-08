@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Detail Employe</h1>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $pegawai->nama }}</h5>
            <p class="card-text">Phone Number: {{ $pegawai->no_hp }}</p>
        </div>
    </div>
    <a href="{{ route('pegawai.index') }}" class="btn btn-primary">Kembali ke Daftar Pegawai</a>
</div>
@endsection