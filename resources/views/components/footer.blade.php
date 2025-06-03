<footer class="bg-primary-dark-2 text-white">
    <div class="container py-20 lg:py-[100px]">
        <div class="row">
            <div class="col-12 order-first lg:col-4">
                <div class="w-full">
                    <a href="." class="inline-block mb-5">
                        <img src="{{ asset('images/logo_white.webp') }}" alt="LaporSaja" style="width: 150px;" />
                    </a>

                    <p class="mb-8 text-body-dark-11">
                        Aplikasi Pelaporan Digital Anda.
                    </p>
                </div>
            </div>
            <div class="col-6 lg:col-2">
                <div class="w-full">
                    <h4 class="mb-9 text-lg font-semibold text-inherit">Link Cepat</h4>
                    <ul>
                        <li>
                            <a href="{{ route('home.index') }}"
                                class="mb-3 inline-block text-body-dark-11 hover:text-primary">Home</a>
                        </li>
                        <li>
                            <a href="{{ route('tracking.index') }}"
                                class="mb-3 inline-block text-body-dark-11 hover:text-primary">Tracking
                                Laporan</a>
                        </li>
                        <li>
                            <a href="." class="mb-3 inline-block text-body-dark-11 hover:text-primary">Tentang
                                LaporSaja</a>
                        </li>
                        <li>
                            <a href="." class="mb-3 inline-block text-body-dark-11 hover:text-primary">FAQ</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-6 lg:col-2">
                {{--  --}}
            </div>
            <div class="col-12 -order-3 lg:col-4 lg:order-1">
                {{--  --}}
            </div>
        </div>
    </div>
    <div class="w-full border-t border-solid border-alpha-dark"></div>
    <div class="container py-8">
        <div class="flex flex-wrap">
            <div class="w-full md:w-1/2">
                {{--  --}}
            </div>

            <div class="w-full md:w-1/2">
                <div class="my-1 flex justify-center md:justify-end">
                    <p class="text-body-dark-11">
                        &#169; 2025 All rights reserved
                    </p>
                </div>
            </div>
        </div>
    </div>
</footer>
