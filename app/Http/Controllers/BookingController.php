<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Exception;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index()
    {
        // booking pagination
        $bookings = Booking::paginate(20);

        return view('pages.admin.booking', compact('bookings'));
    }

    public function updateStatus(Request $request)
    {
        if($request->status == 'approve') {
            $status = 1;
            $message = 'Booking berhasil disetujui!';
        }elseif ($request->status == 'reject') {
            $status = 2;
            $message = 'Booking berhasil ditolak!';
        }else {
            $status = 0;
            $message = 'Booking gagal diperbarui!';
        }

        try {
            Booking::where('id', $request->id)->update([
                'status' => $status
            ]);

            return back()->with('success', $message);
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function updateBookingNew($id)
    {
        try {
            $booking = Booking::find($id);
            $booking->old = 1;
            $booking->save();

            return redirect()->route('booking')->with('kode_transaksi', $booking->kode_transaksi);
        } catch (Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function rekap()
    {
        $bookings = Booking::where('status', 1)->get();
        return view('pages.admin.rekap_pendapatan', compact('bookings'));
    }
}
