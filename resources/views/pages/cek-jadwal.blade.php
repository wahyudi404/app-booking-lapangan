@extends('layouts.app-user')

@section('content')
    <div style="min-height: 100vh;display: flex;align-items: center;justify-content: center">
        <div class="card w-card my-shadow border" style="border-radius: 20px; border-top: 5px solid #181a1c !important;">
            <div class="card-body py-4">
                <div class="mb-3">
                    <h2 class="text-center"><b>Cek Jadwal</b></h2>
                </div>
                <div class="mb-3">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Pemesan</th>
                                <th>Tanggal</th>
                                <th>Jam</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($bookings) == 0)
                                <tr>
                                    <td colspan="4" class="text-center">Tidak ada data</td>
                                </tr>
                            @else
                                @foreach ($bookings as $key => $booking)
                                    <tr>
                                        <td> {{ ++$key }} </td>
                                        <td> {{ $booking->namalengkap }} </td>
                                        <td> {{ date('d F Y', strtotime($booking->tanggal_booking)) }} </td>
                                        <td> {{ date('H:i', strtotime($booking->tanggal_booking)) }} </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>

                    <a href="/" class="btn btn-outline-primary px-4 mt-4">Kembali</a>
                </div>
            </div>
        </div>
    </div>
@endsection
