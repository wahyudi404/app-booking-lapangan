@extends('layouts.app-user')

@section('content')
    <div style="min-height: 100vh;display: flex;align-items: center;justify-content: center">
        <div class="card w-card my-shadow border" style="border-radius: 20px">
            @if ($pembayaran != 'Manual')
                <div class="card-body p-4 text-center">
                    <div class="mb-3">
                        <h2><b>Pembayaran Online</b></h2>
                    </div>
                    <div <div class="mb-4 text-success">
                        <h4>BCA A/N Reza</h4>
                        <h1><b>5042910472</b></h1>
                    </div>
                    <form action="{{ route('upload-bukti') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        {{--  --}}
                        <input type="text" name="kode_transaksi" id="kode_transaksi" value="{{ $kode }}" hidden />

                        <label for="bukti">Upload Bukti Transfer</label>
                        <input type="file" name="bukti" id="bukti"
                            class="form-control @error('bukti') is-invalid @enderror" accept="image/*">
                        @error('bukti')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                        <div style="display: flex; justify-content: space-between;" class="mt-5">
                            <a href="/" class="btn btn-outline-primary px-4">Kembali</a>
                            <button type="submit" class="btn btn-primary px-4">Upload Bukti</button>
                        </div>
                    </form>
                </div>
            @elseif ($pembayaran == 'Manual')
                <div class="card-body py-4 text-center">
                    <div class="mb-3">
                        <h2 class="text-center"><b>Booking Berhasil</b></h2>
                        <h4 class="text-success">
                            Silahkan Bayar di Tempat
                            Sebelum tanggal booking
                            dipesan orang lain
                        </h4>
                        <a href="/" class="btn btn-outline-primary">Kembali</a>
                    </div>
                </div>
            @else
                <script>
                    window.location = "/";
                </script>
            @endif
        </div>
    </div>
    </div>
@endsection
