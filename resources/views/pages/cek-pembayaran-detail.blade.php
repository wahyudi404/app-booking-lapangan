@extends('layouts.app-user')

@section('content')
    <div style="min-height: 100vh;display: flex;align-items: center;justify-content: center;">
        <div class="card w-card my-shadow border" style="border-radius: 20px; border-top: 5px solid #181a1c !important;">
            <div class="card-body py-4 text-center">
                <div class="mb-3">
                    <h4 class="text-center mb-4"><b>Status Pembayaran</b></h4>
                    @if ($booking->status == 1)
                        <h1 class="text-success"><b>Sudah di Bayar</b></h1>
                    @elseif ($booking->status == 2)
                        <h1 class="text-danger"><b>Belum di Bayar</b></h1>
                    @elseif ($booking->status == 0)
                        <h1 class="text-warning"><b>Sedang Proses</b></h1>
                    @endif

                    <table style="width: 100%; text-align: left;" cellpadding="5">
                        <tr>
                            <td>Kode Transaksi</td>
                            <th>: <b>{{ $booking->kode_transaksi }}</b></th>
                        </tr>
                        <tr>
                            <td>Tanggal Booking</td>
                            <th>: {{ date('d F Y', strtotime($booking->tanggal_booking)) }}</th>
                        </tr>
                        <tr>
                            <td>Tanggal Pemesanan</td>
                            <th>: {{ date('d F Y', strtotime($booking->created_at)) }}</th>
                        </tr>
                        <tr>
                            <td>Nama Pemesan</td>
                            <th>: {{ $booking->namalengkap }}</th>
                        </tr>
                        <tr>
                            <td>Metode Pembayaran</td>
                            <th class="@if ($booking->pembayaran == 'Online') text-success @else text-danger @endif">: {{ $booking->pembayaran }}</th>
                        </tr>
                    </table>

                    @if ($booking->status == 2 && $booking->pembayaran == 'Online')
                        <div class="mt-4">
                            <a href="{{ route('hasil-pembayaran', $booking->kode_transaksi) }}"
                                class="btn btn-primary px-4">Upload
                                Bukti Transfer</a>
                        </div>
                    @endif

                    <div class="w-full text-end mt-4 d-flex justify-content-between">
                        <a href="/" class="btn btn-outline-primary px-4">Kembali</a>
                        <a href="{{ route('cek-pembayaran') }}" class="btn btn-primary px-4">Cek Ulang</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
