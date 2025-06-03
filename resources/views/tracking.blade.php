@extends('layouts.guest')

@section('title', 'Tracking Laporan')

@section('content')
    {{-- Header --}}
    <section class="relative overflow-hidden text-primary-color pt-[120px] md:pt-[130px] lg:pt-[160px] !pb-[160px]">
        <div class="mx-auto max-w-[780px] text-center">
            <h1 class="!text-4xl mb-4">Cek Status Pengaduan</h1>
            <p class="text-gray-600 !text-lg">
                Ketahui status terkini pengaduan Anda dengan memasukkan nomor referensi di bawah.
            </p>

            <div class="mt-10 mx-auto max-w-[540px]">
                <input type="text" placeholder="Ketik Nomor Laporan Anda"
                    class="input input-xl text-lg rounded-2xl !border !border-gray-300 !text-black !px-4 w-full" />

                <button class="!btn !btn-error !outline-0 !text-white !mt-10 !bg-red-500 !rounded-2xl">Lacak
                    Pengaduan</button>
            </div>
        </div>
    </section>
@endsection
