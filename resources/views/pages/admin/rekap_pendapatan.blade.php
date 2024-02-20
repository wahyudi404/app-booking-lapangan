@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div id="data" data-bookings='{{$bookings}}' class="d-none"></div>
                    <div class="card-header">{{ __('Masukkan Tanggal') }}</div>

                    <div class="card-body">
                        <form id="form-rekap" class="row">
                            <div class="col-12 col-md-6">
                                <label for="start_date" class="form-label">Start Date</label>
                                <input type="date" class="form-control" id="start_date">
                            </div>
                            <div class="col-12 col-md-6">
                                <label for="end_date" class="form-label">End Date</label>
                                <input type="date" class="form-control" id="end_date">
                            </div>

                            <div class="col-12 mt-3 text-end">
                                <button type="submit" class="btn btn-primary px-4">Rekap</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div id="rekap-pendapatan" class="col-md-12 mt-4 d-none">
                <div class="card">
                    <div class="card-header">

                    </div>

                    <div class="card-body">
                        <div class="mb-3">
                            <button id="cetak" type="button" class="btn btn-primary">
                                <i class="fa fa-print"></i>
                                Cetak
                            </button>
                        </div>
                        <table id="datatable" cellspacing="0" border="1" cellpadding="10" class="table table-responsive table-striped w-100">
                            <thead>
                                <tr>
                                    <th style="width: 5%">No</th>
                                    <th>Pemesan</th>
                                    <th>Tanggal</th>
                                    <th>Transaksi</th>
                                    <th>Harga</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://printjs-4de6.kxcdn.com/print.min.js"></script>
    <script>

        // format date indonesia
        function formatDate(date) {
            const months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
            const day = date.getDate();
            const month = months[date.getMonth()];
            const year = date.getFullYear();
            return `${day} ${month} ${year}`;
        }

        // format uang indonesia
        function formatUang(number) {
            return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(number);
        }

        function rekap(data) {
            $startdate = $('#start_date').val()
            $enddate = $('#end_date').val()

            if($startdate && $enddate) {
                $('#rekap-pendapatan tbody').empty();
                let total_harga = 0;
                data.forEach((item, idx) => {
                    $('#rekap-pendapatan tbody').append(`
                    <tr>
                        <td style="width: 10%">${++idx}</td>
                        <td>
                            <span>Nama : ${item.namalengkap}</span>
                            <br>
                            <span>No. HP : ${item.nohp}</span>
                        </td>
                        <td>${formatDate(new Date(item.tanggal_booking))}</td>
                        <td>
                            <span>Kode : ${item.kode_transaksi}</span>
                            <br>
                            <span>Via : ${item.pembayaran}</span>
                        </td>
                        <td>${formatUang(item.harga)}</td>
                    </tr>
                    `)
                    total_harga += item.harga
                });

                $('#rekap-pendapatan tbody').append(`
                    <tr>
                        <td style="width: 10%"></td>
                        <td></td>
                        <td></td>
                        <td><b>Total</b></td>
                        <td><b>${formatUang(total_harga)}</b></td>
                    </tr>
                `)

                $('#rekap-pendapatan').removeClass('d-none');
                $('#rekap-pendapatan .card-header').text(`Rekap Pendapatan Tanggal ${formatDate(new Date($startdate))} - ${formatDate(new Date($enddate))}`);
            }
        }
        $(document).ready(function() {
            let data = $('#data').data('bookings');
            $('#form-rekap').submit(function(e) {
                e.preventDefault();
                rekap(data);
            })

            $('#cetak').click(function() {
                printJS({ printable: 'datatable', type: 'html', documentTitle: 'Rekap Pendapatan' })
            })
        })
    </script>
@endsection
