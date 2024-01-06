@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Data Booking') }}</div>

                    <div class="card-body">
                        <table id="datatable" class="table table-responsive table-striped table-hover">
                            <thead>
                                <tr>
                                    <th style="width: 10%">No</th>
                                    <th>Pemesan</th>
                                    <th>Tanggal</th>
                                    <th>Transaksi</th>
                                    <th>Bukti</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($bookings as $key => $booking)
                                    <tr>
                                        <td> {{ ++$key }} </td>
                                        <td>
                                            <span>Nama: {{ $booking->namalengkap }}</span>
                                            <br>
                                            <span>No. HP: {{ $booking->nohp }}</span>
                                        </td>
                                        <td>
                                            <span>Tgl Booking:
                                                {{ date('d F Y', strtotime($booking->tanggal_booking)) }}</span>
                                            <br>
                                            <span>Tgl Pesan: {{ date('d F Y', strtotime($booking->created_at)) }}</span>
                                        </td>
                                        <td>
                                            <span>Kode Transaksi: <b>{{ $booking->kode_transaksi }}</b></span>
                                            <br>
                                            <span>Status:
                                                @if ($booking->status == 1)
                                                    <span class="badge text-bg-success">Sudah Dibayar</span>
                                                @elseif ($booking->status == 2)
                                                    <span class="badge text-bg-danger">Belum Dibayar</span>
                                                @elseif ($booking->status == 0)
                                                    <span class="badge text-bg-warning">Sedang Proses</span>
                                                @endif
                                            </span>
                                        </td>
                                        <td>
                                            {{-- get image bukti in storage --}}
                                            @if ($booking->bukti == null)
                                                <span class="text-danger">Belum ada bukti</span>
                                            @else
                                                <a href="{{ asset('storage/bukti/' . $booking->bukti) }}" target="_blank">
                                                    <img width="100" src="{{ url('storage/bukti/' . $booking->bukti) }}"
                                                        alt="{{ $booking->bukti }}" />
                                                </a>
                                            @endif
                                        </td>
                                        <td>
                                            <button @if ($booking->status == 1) disabled @endif type="button" data-id="{{$booking->id}}" data-action="approve" class="btn btn-action btn-success">
                                                <i class="fa fa-check"></i>
                                            </button>
                                            <button @if ($booking->status == 2) disabled @endif type="button" data-id="{{$booking->id}}" data-action="reject" class="btn btn-action btn-danger">
                                                <i class="fa fa-times"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        {{-- Form Update Status --}}
                        <form id="form-update-status" action="{{ route('update-status') }}" method="post" class="hidden">
                            @csrf
                            <input type="hidden" name="id" id="id">
                            <input type="hidden" name="status" id="status">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        new DataTable('#datatable');

        const btnActions = $('.btn-action');
        btnActions.click(function() {
            const id = $(this).data('id');
            const action = $(this).data('action');

            $('#id').val(id)
            $('#status').val(action)
            $('#form-update-status').submit()
        })
    </script>
@endsection
