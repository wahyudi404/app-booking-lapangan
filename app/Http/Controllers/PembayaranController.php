<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Exception;
use Illuminate\Http\Request;

class PembayaranController extends Controller
{
    public function index()
    {
        return view('pages.cek-pembayaran');
    }

    public function showPembayaran(Request $request)
    {
        // validation
        $request->validate([
            "kode_transaksi" => 'required',
        ]);

        try {
            $booking = Booking::where('kode_transaksi', $request->kode_transaksi)->first();

            if (empty($booking)) {
                return redirect()->back()->with('error', 'Kode transaksi tidak ditemukan!');
            }
            return redirect()->route('cek-pembayaran-detail', ['kode' => $booking?->kode_transaksi]);
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }

    }

    public function cekPembayaran($kode)
    {
        $booking = Booking::where('kode_transaksi', $kode)->first();

        return view('pages.cek-pembayaran-detail', [
            'booking' => $booking
        ]);
    }

    public function hasilPembayaran($kode)
    {
        $booking = Booking::select('bukti', 'pembayaran', 'status')->where('kode_transaksi', $kode)->first();

        if($booking->status != 2 && $booking->pembayaran == 'Online' && !empty($booking->bukti)) {
            return redirect()->route('cek-pembayaran-detail', ['kode' => $kode])->with('error', 'Pembayaran telah dibayar atau sedang diproses!');
        }
        return view('pages.hasil-pembayaran', [
            'pembayaran' => $booking?->pembayaran,
            'kode' => $kode
        ]);
    }

    public function uploadBukti(Request $request)
    {
        // validation
        $request->validate([
            "bukti" => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        try {
            $booking = Booking::select('bukti', 'pembayaran', 'status')->where('kode_transaksi', $request->kode_transaksi)->first();

            if($booking->status != 2 && $booking->pembayaran == 'Online' && !empty($booking->bukti)) {
                return redirect()
                    ->route('cek-pembayaran-detail', ['kode' => $request->kode_transaksi])
                    ->with('error', 'Pembayaran telah dibayar atau sedang diproses!');
            }

            $bukti = $request->file('bukti');
            $booking = Booking::where('kode_transaksi', $request->kode_transaksi)->first();
            $storage_path = storage_path('app/public/bukti/' . $booking?->bukti);

            // hapus bukti sebelumnya
            if (!empty($booking?->bukti) && file_exists($storage_path)) unlink($storage_path);

            // update model Booking
            Booking::where('kode_transaksi', $request->kode_transaksi)->update([
                'bukti' => $bukti->hashName(),
                'status' => 0
            ]);

            // upload bukti
            $bukti->storeAs('public/bukti', $bukti->hashName());

            return redirect()->route('cek-pembayaran-detail', ['kode' => $request->kode_transaksi])->with('success', 'Bukti Pembayaran berhasil diunggah!');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }

    }
}
