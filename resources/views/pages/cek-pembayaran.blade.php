@extends('layouts.app-user')

@section('content')
    <div style="min-height: 100vh;display: flex;align-items: center;justify-content: center;">
        <div class="card w-card my-shadow border" style="border-radius: 20px; border-top: 5px solid #181a1c !important;">
            <div class="card-body py-4">
                <div class="mb-3">
                    <form action="{{ route('cek-pembayaran') }}" method="post">
                        @csrf
                        <label for="kode_transaksi" class="form-label">Kode Transaksi</label>
                        <input name="kode_transaksi" id="kode_transaksi" type="text" class="form-control @error('kode_transaksi') is-invalid @enderror"
                            id="kode_transaksi" autocomplete="off" required>
                        @error('kode_transaksi')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                        <div class="w-full text-end mt-4 d-flex justify-content-between">
                            <a href="/" class="btn btn-outline-primary px-4">Kembali</a>
                            <button type="submit" class="btn btn-primary px-4">Cek</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
