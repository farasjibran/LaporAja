<?php

namespace Database\Seeders;

use App\Models\Goverments;
use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Roles;
use App\Models\User;
use App\Models\UserRoles;

class GovermentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();
        $commonPassword = Hash::make('password');

        $governmentRole = Roles::firstOrCreate(
            ['name' => 'goverment']
        );

        if (!$governmentRole) {
            $this->command->error('Gagal membuat atau menemukan role "goverment". Seeder dihentikan.');
            return;
        }

        $newlyCreatedUsersCount = 0;
        $newlyCreatedGovermentsCount = 0;
        $processedUsersCount = 0;

        $createUserAndAssignRole = function ($userName, $userEmail) use ($commonPassword, $governmentRole, $now, &$newlyCreatedUsersCount, &$processedUsersCount) {
            $user = User::firstOrCreate(
                ['email' => $userEmail],
                [
                    'name' => $userName,
                    'password' => $commonPassword,
                ]
            );

            if ($user->wasRecentlyCreated) {
                $newlyCreatedUsersCount++;
                $this->command->info("User baru dibuat: {$userEmail}");
            } else {
                $this->command->info("User sudah ada: {$userEmail}");
            }
            $processedUsersCount++;

            $hasRole = UserRoles::where('user_id', $user->id)
                ->where('role_id', $governmentRole->id)
                ->exists();

            if (!$hasRole) {
                UserRoles::create([
                    'user_id' => $user->id,
                    'role_id' => $governmentRole->id,
                    'created_at' => $now,
                    'updated_at' => $now,
                ]);
                $this->command->info("Role 'goverment' di-assign ke user: {$userEmail}.");
            } else {
                $this->command->info("User {$userEmail} sudah memiliki role 'goverment'.");
            }

            return $user;
        };

        $institutions = [
            'Kementerian' => [
                ['name' => 'Kementerian Koordinator Bidang Politik, Hukum, dan Keamanan', 'short_name' => 'Kemenko Polhukam', 'address' => 'Jl. Medan Merdeka Barat No. 15, Jakarta Pusat', 'phone' => '021-3848641'],
                ['name' => 'Kementerian Koordinator Bidang Perekonomian', 'short_name' => 'Kemenko Perekonomian', 'address' => 'Jl. Lapangan Banteng Timur No. 2-4, Jakarta Pusat', 'phone' => '021-3849611'],
                ['name' => 'Kementerian Koordinator Bidang Pembangunan Manusia dan Kebudayaan', 'short_name' => 'Kemenko PMK', 'address' => 'Jl. Medan Merdeka Barat No. 3, Jakarta Pusat', 'phone' => '021-3459357'],
                ['name' => 'Kementerian Koordinator Bidang Kemaritiman dan Investasi', 'short_name' => 'Kemenko Marves', 'address' => 'Gedung BPPT I, Jl. M.H. Thamrin No. 8, Jakarta Pusat', 'phone' => '021-31935032'],
                ['name' => 'Kementerian Sekretariat Negara', 'short_name' => 'Kemensetneg', 'address' => 'Jl. Veteran No. 17-18, Jakarta Pusat', 'phone' => '021-3847561'],
                ['name' => 'Kementerian Dalam Negeri', 'short_name' => 'Kemendagri', 'address' => 'Jl. Medan Merdeka Utara No. 7, Jakarta Pusat', 'phone' => '021-3450038'],
                ['name' => 'Kementerian Luar Negeri', 'short_name' => 'Kemenlu', 'address' => 'Jl. Pejambon No. 6, Jakarta Pusat', 'phone' => '021-3441508'],
                ['name' => 'Kementerian Pertahanan', 'short_name' => 'Kemenhan', 'address' => 'Jl. Medan Merdeka Barat No. 13-14, Jakarta Pusat', 'phone' => '021-3829123'],
                ['name' => 'Kementerian Agama', 'short_name' => 'Kemenag', 'address' => 'Jl. Lapangan Banteng Barat No. 3-4, Jakarta Pusat', 'phone' => '021-3811642'],
                ['name' => 'Kementerian Hukum dan Hak Asasi Manusia', 'short_name' => 'Kemenkumham', 'address' => 'Jl. H.R. Rasuna Said Kav. 6-7, Kuningan, Jakarta Selatan', 'phone' => '021-5253004'],
                ['name' => 'Kementerian Keuangan', 'short_name' => 'Kemenkeu', 'address' => 'Jl. Dr. Wahidin Raya No. 1, Jakarta Pusat', 'phone' => '021-3449230'],
                ['name' => 'Kementerian Pendidikan, Kebudayaan, Riset, dan Teknologi', 'short_name' => 'Kemendikbudristek', 'address' => 'Jl. Jenderal Sudirman, Senayan, Jakarta Pusat', 'phone' => '021-5711144'],
                ['name' => 'Kementerian Kesehatan', 'short_name' => 'Kemenkes', 'address' => 'Jl. H.R. Rasuna Said Blok X5 Kav. 4-9, Jakarta Selatan', 'phone' => '021-5201590'],
                ['name' => 'Kementerian Sosial', 'short_name' => 'Kemensos', 'address' => 'Jl. Salemba Raya No. 28, Jakarta Pusat', 'phone' => '021-3103591'],
                ['name' => 'Kementerian Ketenagakerjaan', 'short_name' => 'Kemnaker', 'address' => 'Jl. Jenderal Gatot Subroto Kav. 51, Jakarta Selatan', 'phone' => '021-5255733'],
                ['name' => 'Kementerian Perindustrian', 'short_name' => 'Kemenperin', 'address' => 'Jl. Jenderal Gatot Subroto Kav. 52-53, Jakarta Selatan', 'phone' => '021-5255509'],
                ['name' => 'Kementerian Perdagangan', 'short_name' => 'Kemendag', 'address' => 'Jl. M.I. Ridwan Rais No. 5, Jakarta Pusat', 'phone' => '021-3858171'],
                ['name' => 'Kementerian Energi dan Sumber Daya Mineral', 'short_name' => 'Kemen ESDM', 'address' => 'Jl. Medan Merdeka Selatan No. 18, Jakarta Pusat', 'phone' => '021-3804242'],
                ['name' => 'Kementerian Pekerjaan Umum dan Perumahan Rakyat', 'short_name' => 'Kemen PUPR', 'address' => 'Jl. Pattimura No. 20, Kebayoran Baru, Jakarta Selatan', 'phone' => '021-72796000'],
                ['name' => 'Kementerian Perhubungan', 'short_name' => 'Kemenhub', 'address' => 'Jl. Medan Merdeka Barat No. 8, Jakarta Pusat', 'phone' => '021-3811308'],
                ['name' => 'Kementerian Komunikasi dan Informatika', 'short_name' => 'Kominfo', 'address' => 'Jl. Medan Merdeka Barat No. 9, Jakarta Pusat', 'phone' => '021-3452841'],
                ['name' => 'Kementerian Pertanian', 'short_name' => 'Kementan', 'address' => 'Jl. Harsono RM No. 3, Ragunan, Jakarta Selatan', 'phone' => '021-7806131'],
                ['name' => 'Kementerian Lingkungan Hidup dan Kehutanan', 'short_name' => 'Kemen LHK', 'address' => 'Gedung Manggala Wanabakti, Jl. Jenderal Gatot Subroto, Senayan, Jakarta Pusat', 'phone' => '021-5730191'],
                ['name' => 'Kementerian Kelautan dan Perikanan', 'short_name' => 'KKP', 'address' => 'Jl. Medan Merdeka Timur No. 16, Jakarta Pusat', 'phone' => '021-3519070'],
                ['name' => 'Kementerian Desa, Pembangunan Daerah Tertinggal, dan Transmigrasi', 'short_name' => 'Kemendes PDTT', 'address' => 'Jl. Abdul Muis No. 7, Jakarta Pusat', 'phone' => '021-3500334'],
                ['name' => 'Kementerian Agraria dan Tata Ruang/Badan Pertanahan Nasional', 'short_name' => 'Kementerian ATR/BPN', 'address' => 'Jl. Sisingamangaraja No. 2, Kebayoran Baru, Jakarta Selatan', 'phone' => '021-7228901'],
                ['name' => 'Kementerian Perencanaan Pembangunan Nasional/Badan Perencanaan Pembangunan Nasional', 'short_name' => 'Kementerian PPN/Bappenas', 'address' => 'Jl. Taman Suropati No. 2, Jakarta Pusat', 'phone' => '021-31936207'],
                ['name' => 'Kementerian Pendayagunaan Aparatur Negara dan Reformasi Birokrasi', 'short_name' => 'KemenPAN-RB', 'address' => 'Jl. Jenderal Sudirman Kav. 69, Jakarta Selatan', 'phone' => '021-7398381'],
                ['name' => 'Kementerian Badan Usaha Milik Negara', 'short_name' => 'Kementerian BUMN', 'address' => 'Jl. Medan Merdeka Selatan No. 13, Jakarta Pusat', 'phone' => '021-29935678'],
                ['name' => 'Kementerian Koperasi dan Usaha Kecil dan Menengah', 'short_name' => 'KemenKopUKM', 'address' => 'Jl. H.R. Rasuna Said Kav. 3-5, Kuningan, Jakarta Selatan', 'phone' => '021-5204366'],
                ['name' => 'Kementerian Pariwisata dan Ekonomi Kreatif/Badan Pariwisata dan Ekonomi Kreatif', 'short_name' => 'Kemenparekraf', 'address' => 'Gedung Sapta Pesona, Jl. Medan Merdeka Barat No. 17, Jakarta Pusat', 'phone' => '021-3838899'],
                ['name' => 'Kementerian Pemberdayaan Perempuan dan Perlindungan Anak', 'short_name' => 'KemenPPPA', 'address' => 'Jl. Medan Merdeka Barat No. 15, Jakarta Pusat', 'phone' => '021-3805563'],
                ['name' => 'Kementerian Investasi/Badan Koordinasi Penanaman Modal', 'short_name' => 'Kementerian Investasi/BKPM', 'address' => 'Jl. Jenderal Gatot Subroto No. 44, Jakarta Selatan', 'phone' => '021-5252008'],
                ['name' => 'Kementerian Pemuda dan Olahraga', 'short_name' => 'Kemenpora', 'address' => 'Jl. Gerbang Pemuda No. 3, Senayan, Jakarta Pusat', 'phone' => '021-5738318'],
            ],
            'LPNK' => [
                ['name' => 'Arsip Nasional Republik Indonesia', 'short_name' => 'ANRI', 'address' => 'Jl. Ampera Raya No. 7, Cilandak, Jakarta Selatan', 'phone' => '021-7805851'],
                ['name' => 'Badan Informasi Geospasial', 'short_name' => 'BIG', 'address' => 'Jl. Raya Jakarta-Bogor KM 46, Cibinong', 'phone' => '021-8752062'],
                ['name' => 'Badan Intelijen Negara', 'short_name' => 'BIN', 'address' => 'Jl. Seno Raya, Pejaten Timur, Pasar Minggu, Jakarta Selatan', 'phone' => '-'],
                ['name' => 'Badan Keamanan Laut Republik Indonesia', 'short_name' => 'Bakamla', 'address' => 'Jl. Dr. Sutomo No.11, Jakarta Pusat', 'phone' => '021-50200200'],
                ['name' => 'Badan Kepegawaian Negara', 'short_name' => 'BKN', 'address' => 'Jl. Mayor Jenderal Sutoyo No.12, Cililitan, Jakarta Timur', 'phone' => '021-8093008'],
                ['name' => 'Badan Kependudukan dan Keluarga Berencana Nasional', 'short_name' => 'BKKBN', 'address' => 'Jl. Permata No. 1, Halim Perdanakusuma, Jakarta Timur', 'phone' => '021-8009029'],
                ['name' => 'Badan Meteorologi, Klimatologi, dan Geofisika', 'short_name' => 'BMKG', 'address' => 'Jl. Angkasa I No.2, Kemayoran, Jakarta Pusat', 'phone' => '021-4246321'],
                ['name' => 'Badan Narkotika Nasional', 'short_name' => 'BNN', 'address' => 'Jl. M.T. Haryono No. 11, Cawang, Jakarta Timur', 'phone' => '021-80871566'],
                ['name' => 'Badan Nasional Penanggulangan Bencana', 'short_name' => 'BNPB', 'address' => 'Jl. Pramuka Kav. 38, Jakarta Timur', 'phone' => '021-29827793'],
                ['name' => 'Badan Nasional Penanggulangan Terorisme', 'short_name' => 'BNPT', 'address' => 'Jl. M.H. Thamrin No.14, Jakarta Pusat', 'phone' => '021-2301090'],
                ['name' => 'Badan Nasional Pencarian dan Pertolongan', 'short_name' => 'Basarnas', 'address' => 'Jl. Angkasa Blok B15 Kav 2-3 Kemayoran, Jakarta Pusat', 'phone' => '021-65701116'],
                ['name' => 'Badan Pangan Nasional', 'short_name' => 'Bapanas', 'address' => 'Jl. Harsono RM No.3 Gedung E Lt.V, Ragunan, Jakarta Selatan', 'phone' => '021-7816004'],
                ['name' => 'Badan Pelindungan Pekerja Migran Indonesia', 'short_name' => 'BP2MI', 'address' => 'Jl. MT Haryono Kav. 52, Pancoran, Jakarta Selatan', 'phone' => '021-7991247'],
                ['name' => 'Badan Pengawas Obat dan Makanan', 'short_name' => 'BPOM', 'address' => 'Jl. Percetakan Negara No. 23, Jakarta Pusat', 'phone' => '021-4244691'],
                ['name' => 'Badan Pengawas Tenaga Nuklir', 'short_name' => 'BAPETEN', 'address' => 'Jl. Gajah Mada No. 8, Jakarta Pusat', 'phone' => '021-6300210'],
                ['name' => 'Badan Pengawasan Keuangan dan Pembangunan', 'short_name' => 'BPKP', 'address' => 'Jl. Pramuka No. 33, Jakarta Timur', 'phone' => '021-85910031'],
                ['name' => 'Badan Pusat Statistik', 'short_name' => 'BPS', 'address' => 'Jl. Dr. Sutomo No. 6-8, Jakarta Pusat', 'phone' => '021-3841195'],
                ['name' => 'Badan Riset dan Inovasi Nasional', 'short_name' => 'BRIN', 'address' => 'Gedung B.J. Habibie, Jl. M.H. Thamrin No. 8, Jakarta Pusat', 'phone' => '021-3169000'],
                ['name' => 'Badan Siber dan Sandi Negara', 'short_name' => 'BSSN', 'address' => 'Jl. Harsono RM No.70, Ragunan, Jakarta Selatan', 'phone' => '021-7805814'],
                ['name' => 'Badan Standardisasi Nasional', 'short_name' => 'BSN', 'address' => 'Gedung BPPT I, Jl. M.H. Thamrin No. 8, Jakarta Pusat', 'phone' => '021-3927422'],
                ['name' => 'Lembaga Administrasi Negara', 'short_name' => 'LAN', 'address' => 'Jl. Veteran No. 10, Jakarta Pusat', 'phone' => '021-3455021'],
                ['name' => 'Lembaga Kebijakan Pengadaan Barang/Jasa Pemerintah', 'short_name' => 'LKPP', 'address' => 'Epiwalk Lt. 7, Jl. Epicentrum Selatan Lot 11B, Kuningan, Jakarta Selatan', 'phone' => '021-29912400'],
                ['name' => 'Lembaga Ketahanan Nasional', 'short_name' => 'Lemhannas', 'address' => 'Jl. Medan Merdeka Selatan No. 10, Jakarta Pusat', 'phone' => '021-3832101'],
                ['name' => 'Perpustakaan Nasional Republik Indonesia', 'short_name' => 'Perpusnas', 'address' => 'Jl. Medan Merdeka Selatan No. 11, Jakarta Pusat', 'phone' => '021-1500839'],
            ],
            'Lembaga Negara' => [
                ['name' => 'Majelis Permusyawaratan Rakyat Republik Indonesia', 'short_name' => 'MPR RI', 'address' => 'Jl. Jend. Gatot Subroto No.6, Jakarta Pusat', 'phone' => '021-5755000'],
                ['name' => 'Dewan Perwakilan Rakyat Republik Indonesia', 'short_name' => 'DPR RI', 'address' => 'Jl. Jend. Gatot Subroto, Jakarta Pusat', 'phone' => '021-5715518'],
                ['name' => 'Dewan Perwakilan Daerah Republik Indonesia', 'short_name' => 'DPD RI', 'address' => 'Jl. Jend. Gatot Subroto No.6, Jakarta Pusat', 'phone' => '021-57853000'],
                ['name' => 'Mahkamah Agung Republik Indonesia', 'short_name' => 'MA RI', 'address' => 'Jl. Medan Merdeka Utara No. 9-13, Jakarta Pusat', 'phone' => '021-3843348'],
                ['name' => 'Mahkamah Konstitusi Republik Indonesia', 'short_name' => 'MK RI', 'address' => 'Jl. Medan Merdeka Barat No. 6, Jakarta Pusat', 'phone' => '021-23529000'],
                ['name' => 'Komisi Yudisial Republik Indonesia', 'short_name' => 'KY RI', 'address' => 'Jl. Kramat Raya No.57, Jakarta Pusat', 'phone' => '021-3905876'],
                ['name' => 'Badan Pemeriksa Keuangan Republik Indonesia', 'short_name' => 'BPK RI', 'address' => 'Jl. Jend. Gatot Subroto No.31, Jakarta Pusat', 'phone' => '021-25549000'],
                ['name' => 'Komisi Pemilihan Umum', 'short_name' => 'KPU', 'address' => 'Jl. Imam Bonjol No.29, Jakarta Pusat', 'phone' => '021-31937223'],
                ['name' => 'Badan Pengawas Pemilihan Umum', 'short_name' => 'Bawaslu', 'address' => 'Jl. M.H. Thamrin No.14, Jakarta Pusat', 'phone' => '021-2301515'],
                ['name' => 'Komisi Pemberantasan Korupsi', 'short_name' => 'KPK', 'address' => 'Gedung Merah Putih KPK, Jl. Kuningan Persada Kav. 4, Jakarta Selatan', 'phone' => '021-25578300'],
                ['name' => 'Ombudsman Republik Indonesia', 'short_name' => 'ORI', 'address' => 'Jl. H.R. Rasuna Said Kav. C-19, Kuningan, Jakarta Selatan', 'phone' => '021-22513737'],
                ['name' => 'Komisi Nasional Hak Asasi Manusia', 'short_name' => 'Komnas HAM', 'address' => 'Jl. Latuharhary No.4B, Menteng, Jakarta Pusat', 'phone' => '021-3925230'],
                ['name' => 'Bank Indonesia', 'short_name' => 'BI', 'address' => 'Jl. M.H. Thamrin No. 2, Jakarta Pusat', 'phone' => '021-29810000'],
                ['name' => 'Otoritas Jasa Keuangan', 'short_name' => 'OJK', 'address' => 'Gedung Soemitro Djojohadikusumo, Jl. Lapangan Banteng Timur No.2-4, Jakarta Pusat', 'phone' => '157'],
            ],
            'Pemerintah Provinsi' => [
                ['name' => 'Pemerintah Provinsi DKI Jakarta', 'short_name' => 'Pemprov DKI', 'address' => 'Jl. Medan Merdeka Selatan No. 8-9, Jakarta Pusat', 'phone' => '021-3822255'],
                ['name' => 'Pemerintah Provinsi Jawa Barat', 'short_name' => 'Pemprov Jabar', 'address' => 'Gedung Sate, Jl. Diponegoro No. 22, Bandung', 'phone' => '022-4232448'],
                ['name' => 'Pemerintah Provinsi Jawa Tengah', 'short_name' => 'Pemprov Jateng', 'address' => 'Jl. Pahlawan No. 9, Semarang', 'phone' => '024-8311174'],
                ['name' => 'Pemerintah Provinsi Jawa Timur', 'short_name' => 'Pemprov Jatim', 'address' => 'Jl. Pahlawan No. 110, Surabaya', 'phone' => '031-3524001'],
                ['name' => 'Pemerintah Provinsi DI Yogyakarta', 'short_name' => 'Pemprov DIY', 'address' => 'Kompleks Kepatihan Danurejan, Yogyakarta', 'phone' => '0274-562811'],
            ],
        ];

        foreach ($institutions as $category => $list) {
            $this->command->info("\nMemproses kategori: {$category}...");
            foreach ($list as $item) {
                $userEmail = strtolower(str_replace([' ', '/'], ['.', ''], $item['short_name'])) . '@example.go.id';
                $userName = ($item['user_prefix'] ?? 'User') . ' ' . $item['short_name'];

                $user = $createUserAndAssignRole($userName, $userEmail);

                if ($user) {
                    $government = Goverments::firstOrCreate(
                        ['name' => $item['name']],
                        [
                            'user_id' => $user->id,
                            'phone' => $item['phone'] ?? 'N/A',
                            'address' => $item['address'] ?? 'N/A',
                        ]
                    );

                    if ($government->wasRecentlyCreated) {
                        $newlyCreatedGovermentsCount++;
                        $this->command->info("Instansi baru dibuat: {$item['name']}");
                    } else {
                        $this->command->info("Instansi sudah ada: {$item['name']}. Memastikan user_id terhubung...");
                        if ($government->user_id !== $user->id) {
                            $this->command->info("Memperbarui user_id untuk instansi '{$item['name']}' dari {$government->user_id} ke {$user->id}.");
                            $government->user_id = $user->id;
                            $government->save();
                        }
                    }
                }
            }
        }

        $this->command->info("\n--- Ringkasan Seeding ---");
        $this->command->info("Total User diproses (sudah ada atau baru): {$processedUsersCount}");
        $this->command->info("User baru dibuat: {$newlyCreatedUsersCount}");
        $this->command->info("Instansi Pemerintah baru dibuat: {$newlyCreatedGovermentsCount}");
        $this->command->info("Seeder Goverments selesai dijalankan.");
    }
}
