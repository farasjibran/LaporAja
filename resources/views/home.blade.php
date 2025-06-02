@extends('layouts.guest')

@section('title', 'Home')

@section('content')
    <!-- Hero section -->
    <section class="relative overflow-hidden text-primary-color pt-[120px] md:pt-[130px] lg:pt-[160px]">
        <img src="{{ asset('images/background-hero.webp') }}" alt="Hero Background"
            class="absolute top-0 left-0 z-0 object-cover w-full !h-7/12">
        <div class="relative z-10">
            <div class="relative -mx-5 flex flex-wrap items-center">
                <div class="w-full px-5">
                    <div class="scroll-revealed mx-auto max-w-[780px] text-center">
                        <h1
                            class="mb-6 text-3xl font-bold leading-snug text-primary-color sm:text-4xl sm:leading-snug lg:text-5xl lg:leading-tight">
                            Layanan Pengaduan Masyarakat Online
                        </h1>

                        <p class="mx-auto mb-10 max-w-[600px] text-base text-primary-color sm:text-lg sm:leading-normal">
                            LaporSaja adalah platform pengaduan masyarakat online yang memudahkan masyarakat untuk
                            mengadukan pengaduan kepada pemerintah.
                        </p>
                    </div>
                </div>
                <div class="w-full px-5">
                    <div class="mx-auto max-w-[840px]">
                        {{-- Form --}}
                        <div class="relative bg-white p-8 rounded-lg mb-10 !shadow-[0px_0px_15px_1px_rgba(0,_0,_0,_0.1)]">
                            <h2 class="text-center mt-3">Sampaikan Laporan Anda</h2>

                            <div class="mt-5 flex flex-col gap-4 w-full">
                                <fieldset class="fieldset">
                                    <legend class="fieldset-legend text-lg mb-2">Judul Laporan<span
                                            class="text-red-500">*</span></legend>
                                    <input type="text"
                                        class="input input-lg text-lg !border !border-gray-300 !text-black !px-2 w-full"
                                        placeholder="Masukkan Judul Laporan Anda" />
                                </fieldset>

                                <fieldset class="fieldset">
                                    <legend class="fieldset-legend text-lg mb-2">Isi Laporan<span
                                            class="text-red-500">*</span>
                                    </legend>
                                    <textarea class="textarea textarea-lg text-lg h-24 !border !border-gray-300 !text-black !p-2 w-full"
                                        placeholder="Masukkan Isi Laporan Anda"></textarea>
                                </fieldset>

                                <fieldset class="fieldset">
                                    <legend class="fieldset-legend text-lg mb-2">Tanggal Kejadian<span
                                            class="text-red-500">*</span>
                                    </legend>

                                    <input type="text"
                                        class="input pika-single input-lg text-lg !border !border-gray-300 !text-black !px-2 w-full"
                                        id="tanggalKejadian" placeholder="Pilih Tanggal Kejadian">
                                </fieldset>

                                <fieldset class="fieldset">
                                    <legend class="fieldset-legend text-lg mb-2">Lokasi Kejadian<span
                                            class="text-red-500">*</span></legend>
                                    <input type="text"
                                        class="input input-lg text-lg !border !border-gray-300 !text-black !px-2 w-full"
                                        placeholder="Masukkan Lokasi Kejadian" />
                                </fieldset>

                                <fieldset class="fieldset">
                                    <legend class="fieldset-legend text-lg mb-2">Instansi Tujuan<span
                                            class="text-red-500">*</span></legend>
                                    <select
                                        class="select select-lg text-lg !border !border-gray-300 !text-black !px-2 w-full">
                                        <option disabled selected>Pilih Instansi</option>
                                        @foreach ($goverments as $value => $key)
                                            <option value="{{ $value }}">{{ $key }}</option>
                                        @endforeach
                                    </select>
                                </fieldset>

                                <fieldset class="fieldset">
                                    <legend class="fieldset-legend text-lg mb-2">Kategori Laporan<span
                                            class="text-red-500">*</span></legend>
                                    <select
                                        class="select select-lg text-lg !border !border-gray-300 !text-black !px-2 w-full">
                                        <option disabled selected>Pilih Kategori Laporan</option>
                                        <option value="produk_barang">Produk Barang</option>
                                        <option value="kualitas_layanan">Kualitas Layanan</option>
                                        <option value="masalah_teknis">Masalah Teknis</option>
                                        <option value="penagihan_pembayaran">Penagihan Pembayaran</option>
                                        <option value="keterlambatan_pengiriman">Keterlambatan Pengiriman</option>
                                        <option value="perilaku_staf">Perilaku Staf</option>
                                        <option value="fasilitas_sarana">Fasilitas Sarana</option>
                                        <option value="keamanan_privasi">Keamanan Privasi</option>
                                        <option value="informasi_misleading">Informasi Misleading</option>
                                        <option value="lain-lain">Lain-Lain</option>
                                    </select>
                                </fieldset>

                                <fieldset class="fieldset">
                                    <legend class="fieldset-legend text-lg mb-2">Lampiran<span class="text-red-500">*</span>
                                    </legend>

                                    <input type="file"
                                        class="file-input file-input-lg text-lg !border !border-gray-300 !text-black w-full" />
                                </fieldset>

                                <button class="!btn !btn-error !mt-5 !text-white !outline-0">Lapor</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- About Section --}}
    <section class="!mt-10 !mb-20">
        <div class="w-full">
            <div class="mx-auto max-w-[840px]">
                <ul class="timeline">
                    <li>
                        <div class="timeline-middle">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M19.3028 3.7801C18.4241 2.90142 16.9995 2.90142 16.1208 3.7801L14.3498 5.5511C14.3442 5.55633 14.3387 5.56166 14.3333 5.5671C14.3279 5.57253 14.3225 5.57803 14.3173 5.58359L5.83373 14.0672C5.57259 14.3283 5.37974 14.6497 5.27221 15.003L4.05205 19.0121C3.9714 19.2771 4.04336 19.565 4.23922 19.7608C4.43508 19.9567 4.72294 20.0287 4.98792 19.948L8.99703 18.7279C9.35035 18.6203 9.67176 18.4275 9.93291 18.1663L20.22 7.87928C21.0986 7.0006 21.0986 5.57598 20.22 4.6973L19.3028 3.7801ZM14.8639 7.15833L6.89439 15.1278C6.80735 15.2149 6.74306 15.322 6.70722 15.4398L5.8965 18.1036L8.56029 17.2928C8.67806 17.257 8.7852 17.1927 8.87225 17.1057L16.8417 9.13619L14.8639 7.15833ZM17.9024 8.07553L19.1593 6.81862C19.4522 6.52572 19.4522 6.05085 19.1593 5.75796L18.2421 4.84076C17.9492 4.54787 17.4743 4.54787 17.1814 4.84076L15.9245 6.09767L17.9024 8.07553Z"
                                    fill="#323544" />
                            </svg>

                        </div>
                        <div class="timeline-end timeline-box">Tulis Laporan</div>
                        <hr />
                    </li>
                    <li>
                        <hr />
                        <div class="timeline-middle">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M15.507 9.77587C15.7999 9.48297 15.7999 9.0081 15.507 8.71521C15.2141 8.42231 14.7393 8.42231 14.4464 8.71521L10.9648 12.1967L9.55353 10.7854C9.26063 10.4925 8.78576 10.4926 8.49287 10.7854C8.19998 11.0783 8.19998 11.5532 8.49287 11.8461L10.4345 13.7877C10.7274 14.0806 11.2023 14.0806 11.4952 13.7877L15.507 9.77587Z"
                                    fill="#323544" />
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M12.8608 2.29633C12.3094 2.06789 11.6899 2.06789 11.1385 2.29633L4.59034 5.00922C3.81392 5.33089 3.2534 6.07287 3.22752 6.95318C3.09402 11.4935 4.43153 17.7707 10.9353 21.5237C11.5955 21.9047 12.4101 21.9012 13.067 21.5139C19.4296 17.7631 20.8871 11.5013 20.7701 6.95597C20.7473 6.07313 20.1849 5.33068 19.409 5.00923L12.8608 2.29633ZM11.7126 3.68211C11.8964 3.60596 12.1029 3.60596 12.2867 3.68211L18.8349 6.39501C19.1038 6.50643 19.2642 6.74684 19.2706 6.99458C19.3795 11.223 18.0304 16.8467 12.3052 20.2218C12.1143 20.3343 11.8771 20.3354 11.685 20.2245C5.84237 16.853 4.60224 11.2358 4.72687 6.99727C4.73423 6.74708 4.89602 6.50622 5.16447 6.395L11.7126 3.68211Z"
                                    fill="#323544" />
                            </svg>

                        </div>
                        <div class="timeline-end timeline-box">Proses Verifikasi</div>
                        <hr />
                    </li>
                    <li>
                        <hr />
                        <div class="timeline-middle">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M4.5 19.75V9.75084H10.0004C11.2436 9.75084 12.2512 8.74244 12.2504 7.49924L12.2474 2H17.25C18.4926 2 19.5 3.00736 19.5 4.25V10.3558C18.5288 10.2242 17.5096 10.5316 16.7631 11.2781L11.6049 16.4363C11.0001 17.041 10.6203 17.8343 10.5283 18.6846L10.3392 20.4315C10.2786 20.9923 10.431 21.551 10.7588 22H6.75C5.50736 22 4.5 20.9926 4.5 19.75Z"
                                    fill="#323544" />
                                <path
                                    d="M10.5262 2.65951C10.5961 2.58957 10.6701 2.52471 10.7477 2.46516L10.7504 7.5003C10.7507 7.91473 10.4148 8.25084 10.0004 8.25084H4.96533C5.02455 8.1737 5.08902 8.10008 5.15851 8.03055L10.5262 2.65951Z"
                                    fill="#323544" />
                                <path
                                    d="M20.2986 12.3387C19.6152 11.6553 18.5072 11.6553 17.8237 12.3387L17.1382 13.0243L20.2254 16.1115L20.911 15.426C21.5944 14.7425 21.5944 13.6345 20.911 12.9511L20.2986 12.3387Z"
                                    fill="#323544" />
                                <path
                                    d="M19.1647 17.1722L16.0775 14.085L12.6655 17.497C12.3027 17.8598 12.0748 18.3358 12.0196 18.8459L11.8305 20.5928C11.8061 20.8186 11.8853 21.0433 12.0458 21.2038C12.2064 21.3644 12.4311 21.4436 12.6569 21.4192L14.4038 21.2301C14.9139 21.1749 15.3899 20.947 15.7527 20.5842L19.1647 17.1722Z"
                                    fill="#323544" />
                            </svg>

                        </div>
                        <div class="timeline-end timeline-box">Proses Tindak Lanjut</div>
                        <hr />
                    </li>
                    <li>
                        <hr />
                        <div class="timeline-middle">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M19.5455 6.4965C19.9848 6.93584 19.9848 7.64815 19.5455 8.08749L10.1286 17.5043C9.6893 17.9437 8.97699 17.9437 8.53765 17.5043L4.45451 13.4212C4.01517 12.9819 4.01516 12.2695 4.4545 11.8302C4.89384 11.3909 5.60616 11.3909 6.0455 11.8302L9.33315 15.1179L17.9545 6.4965C18.3938 6.05716 19.1062 6.05716 19.5455 6.4965Z"
                                    fill="#323544" />
                            </svg>

                        </div>
                        <div class="timeline-end timeline-box">Selesai</div>
                    </li>
                </ul>
            </div>
        </div>
    </section>
@endsection

@section('js')
    <script>
        // Setting Pikaday
        const today = new Date();

        var picker = new Pikaday({
            field: document.getElementById('tanggalKejadian'),
            format: 'DD-MM-YYYY',
            maxDate: today
        });
    </script>
@endsection
