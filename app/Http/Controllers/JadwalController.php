<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;

class JadwalController extends Controller
{
    public function index()
    {
        $now = date('Y-m-d');
        $bookings = Booking::where('tanggal_booking', '>=', $now)->get();
        return view('pages.cek-jadwal', [
            'bookings' => $bookings
        ]);
    }
}
