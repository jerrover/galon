@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Tambah Pegawai</h1>
    <form method="POST" action="{{ route('pegawai.store') }}">
        @csrf
        <div class="form-group">
            <label for="nama">Name:</label>
            <input type="text" class="form-control" id="nama" name="nama" required>
        </div>
        <div class="form-group">
            <label for="no_hp">Phone Number:</label>
            <input type="text" class="form-control" id="no_hp" name="no_hp" required>
        </div>
        <button type="submit" class="btn btn-primary">Save</button>
    </form>
</div>
@endsection