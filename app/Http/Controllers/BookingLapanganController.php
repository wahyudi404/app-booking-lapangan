<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Exception;
use Illuminate\Http\Request;

class BookingLapanganController extends Controller
{
    public function index()
    {
        return view('pages.booking-lapangan');
    }

    public function store(Request $request)
    {
        // validation
        $request->validate([
            "nohp" => 'required|min:12|max:13',
            "namalengkap" => 'required|max:255',
            "tanggal_booking" => 'required|date',
            "pembayaran" => 'required',
        ]);

        try {
            $isBooked = Booking::where('nohp', $request->nohp)
            ->where('namalengkap', $request->namalengkap)
            ->where('tanggal_booking', $request->tanggal_booking)
            ->first();

            if (!empty($isBooked)) {
                return redirect()->back()->with('error', 'Lapangan sudah terbooking!');
            }

            $kode_transaksi = $this->generateRandomString();

            // cek kode transaksi unique
            while (Booking::where('kode_transaksi', $kode_transaksi)->first()) {
                $kode_transaksi = $this->generateRandomString();
            }

            Booking::create([
                'kode_transaksi' => strtoupper($kode_transaksi),
                'tanggal_booking' => $request->tanggal_booking,
                'nohp' => $request->nohp,
                'namalengkap' => strtoupper($request->namalengkap),
                'pembayaran' => $request->pembayaran,
            ]);

            return redirect()->route('hasil-pembayaran', ['kode' => $kode_transaksi]);
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    private function generateRandomString()
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';

        for ($i = 0; $i < 10; $i++) {
            $randomString .= $characters[random_int(0, strlen($characters) - 1)];
        }

        return $randomString;
    }
}
