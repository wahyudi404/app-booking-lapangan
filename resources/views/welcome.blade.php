@extends('layouts.app')

@section('content')
<div class="container">
    <div class="text-center">
        <h1>APLIKASI PEMESANAN LAPANGAN FUTSAL</h1>
        <p>Gunakan menu dibawah ini:</p>
    </div>

    <div class="row">
        {{-- @if (Route::has('login'))
        <div class="col-md-3">
            <a href="{{route('login')}}" class="text-decoration-none card bg-warning border-0 pt-5 pb-4 my-shadow" style="border-radius: 20px">
                <div class="card-img-top text-center mb-3">
                    <div style="width: 80px; height: 80px;background: #fff;border-radius: 50%;" class="mx-auto p-2">
                        <img src="{{asset('images/icons/administrator.png')}}" class="w-100" alt="administrator">
                    </div>
                </div>
                <div class="card-body">
                    <h5 class="card-title text-center" style="font-size: 18px"><b>Login Admin</b></h5>
                </div>
            </a>
        </div>
        @endif --}}
        <div class="col-md-4">
            <a href="{{route('booking-lapangan')}}" class="text-decoration-none card bg-warning border-0 pt-5 pb-4 my-shadow" style="border-radius: 20px">
                <div class="card-img-top text-center mb-3">
                    <div style="width: 80px; height: 80px;background: #fff;border-radius: 50%;" class="mx-auto p-3">
                        <img src="{{asset('images/icons/booking.png')}}" class="w-100" alt="booking">
                    </div>
                </div>
                <div class="card-body">
                    <h5 class="card-title text-center" style="font-size: 18px"><b>Booking Lapangan</b></h5>
                </div>
            </a>
        </div>
        <div class="col-md-4">
            <a href="{{route('cek-jadwal')}}" class="text-decoration-none card bg-warning border-0 pt-5 pb-4 my-shadow" style="border-radius: 20px">
                <div class="card-img-top text-center mb-3">
                    <div style="width: 80px; height: 80px;background: #fff;border-radius: 50%;" class="mx-auto p-3">
                        <img src="{{asset('images/icons/date.png')}}" class="w-100" alt="calender">
                    </div>
                </div>
                <div class="card-body">
                    <h5 class="card-title text-center" style="font-size: 18px"><b>Cek Jadwal</b></h5>
                </div>
            </a>
        </div>
        <div class="col-md-4">
            <a href="{{route('cek-pembayaran')}}" class="text-decoration-none card bg-warning border-0 pt-5 pb-4 my-shadow" style="border-radius: 20px">
                <div class="card-img-top text-center mb-3">
                    <div style="width: 80px; height: 80px;background: #fff;border-radius: 50%;" class="mx-auto p-3">
                        <img src="{{asset('images/icons/credit-card.png')}}" class="w-100" alt="pembayaran">
                    </div>
                </div>
                <div class="card-body">
                    <h5 class="card-title text-center" style="font-size: 18px"><b>Cek Pembayaran</b></h5>
                </div>
            </a>
        </div>

    </div>
</div>
@endsection
