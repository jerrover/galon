@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Pengisian Absensi</h1>
    
    <form action="{{ route('absensi.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="pegawai_id" class="form-label">Select Employe</label>
            <select class="form-control" id="pegawai_id" name="pegawai_id" required>
                @foreach($pegawais as $pegawai)
                    <option value="{{ $pegawai->id }}">{{ $pegawai->nama }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="tanggal" class="form-label">Tanggal Absensi</label>
            <input type="date" class="form-control" id="tanggal" name="tanggal" required>
        </div>
        <button type="submit" class="btn btn-primary">Save</button>
    </form>
</div>
@endsection