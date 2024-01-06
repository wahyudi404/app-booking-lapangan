@extends('layouts.app-user')

@section('content')
    <div style="min-height: 100vh;display: flex;align-items: center;justify-content: center">
        <div class="card w-card my-shadow border" style="border-radius: 20px; border-top: 5px solid #181a1c !important;">
            <div class="card-body py-4">
                <div class="mb-3">
                    <h2 class="text-center"><b>Booking Futsal</b></h2>
                </div>
                <form action="{{ route('booking-lapangan') }}" method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="nohp" class="form-label">No HP</label>
                        <input type="tel" id="nohp" name="nohp"
                            class="form-control @error('nohp') is-invalid @enderror">
                        @error('nohp')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="namalengkap" class="form-label">Nama Lengkap</label>
                        <input type="text" id="namalengkap" name="namalengkap"
                            class="form-control @error('namalengkap') is-invalid @enderror">
                        @error('namalengkap')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="tanggal_booking" class="form-label">Tanggal Booking</label>
                        <input type="date" id="tanggal_booking" name="tanggal_booking"
                            class="form-control @error('tanggal_booking') is-invalid @enderror">
                        @error('tanggal_booking')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="pembayaran" class="form-label">Metode Pembayaran</label>
                        <select id="pembayaran" name="pembayaran" class="form-select @error('pembayaran') is-invalid @enderror" aria-label="Default select example">
                            <option selected value="">-- Select One --</option>
                            <option value="Online">Online</option>
                            <option value="Offline">Offline</option>
                        </select>
                        @error('pembayaran')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div style="display: flex; justify-content: space-between;" class="mt-5">
                        <a href="/" class="btn btn-outline-primary px-4">Kembali</a>
                        <button type="submit" class="btn btn-primary px-4">Booking</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
