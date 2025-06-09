<?php

namespace App\Http\Controllers;

use App\Models\Complaints;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TrackingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('tracking');
    }

    /**
     * Track a report by its reference number
     */
    public function track(Request $request)
    {
        $referenceNumber = $request->input('tracking_code');

        $complaint = Complaints::where('unique_code', $referenceNumber)->first();

        if (!$complaint) {
            return response()->json([
                'status' => 'error',
                'message' => 'Complaints not found'
            ], 404);
        }

        $data = $complaint->toArray();
        $data['file_response'] = $complaint->supporting_documents_response
            ? Storage::temporaryUrl(
                $complaint->supporting_documents_response,
                now()->addMinutes(5)
            )
            : null;

        return response()->json([
            'status' => 'success',
            'data' => $data,
        ]);
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
        //
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
