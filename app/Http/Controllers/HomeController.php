<?php

namespace App\Http\Controllers;

use App\Models\Complaints;
use App\Models\Goverments;
use App\Rules\CloudflareTurnstile;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $goverments = Goverments::pluck('name', 'id');
        $totalComplaints = Complaints::count();

        return view('home', compact('goverments', 'totalComplaints'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'title_complaint' => 'required|string|max:255',
                'description' => 'required|string',
                'incident_date' => 'required|date_format:d-m-Y',
                'incident_location' => 'required|string|max:255',
                'goverment_id' => 'required|exists:goverments,id',
                'complaint_category' => 'required|string|in:produk_barang,kualitas_layanan,masalah_teknis,penagihan_pembayaran,keterlambatan_pengiriman,perilaku_staf,fasilitas_sarana,keamanan_privasi,informasi_misleading,lain_lain',
                'file_attachment' => 'required|file|mimes:pdf|max:2048', // 2MB max
                'cf-turnstile-response' => ['required', 'string', new CloudflareTurnstile()]
            ]);

            // Generate unique tracking code
            $trackingCode = 'LAPOR-' . strtoupper(substr(md5(uniqid()), 0, 8));

            // Handle file upload
            $filePath = $request->file('file_attachment')->store('complaints');

            // Create complaint record
            $complaint = Complaints::create([
                'title_complaint' => $validated['title_complaint'],
                'description' => $validated['description'],
                'incident_date' => Carbon::createFromFormat('d-m-Y', $validated['incident_date']),
                'incident_location' => $validated['incident_location'],
                'goverment_id' => $validated['goverment_id'],
                'complaint_type' => $validated['complaint_category'],
                'attachment' => $filePath,
                'unique_code' => $trackingCode,
                'status' => 'open'
            ]);

            return response()->json([
                'success' => true,
                'tracking_code' => $trackingCode,
                'message' => 'Laporan berhasil disimpan!'
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $e->errors()
            ], 422);
        } catch (Exception $e) {
            Log::error('Complaint submission error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menyimpan laporan. Silakan coba lagi.'
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
