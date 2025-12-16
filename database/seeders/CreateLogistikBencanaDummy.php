<?php
// database/seeders/CreateLogistikBencanaDummy.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory;
use Illuminate\Support\Str;

class CreateLogistikBencanaDummy extends Seeder
{
    public function run(): void
    {
        $faker = Factory::create('id_ID');

        // Hapus data lama
        DB::table('logistik_bencana')->delete();

        // Ambil semua ID kejadian bencana
        $kejadianIds = DB::table('kejadian_bencana')->pluck('kejadian_id')->toArray();

        if (empty($kejadianIds)) {
            $this->command->error('❌ Tidak ada data kejadian bencana. Jalankan seeder kejadian bencana terlebih dahulu!');
            return;
        }

        // Data logistik lengkap
        $logistikItems = [
            // Makanan & Minuman (30 item)
            ['Beras', 'kg'],
            ['Mie Instan', 'dus'],
            ['Air Mineral', 'galon'],
            ['Susu UHT', 'kotak'],
            ['Biskuit', 'kaleng'],
            ['Sarden Kaleng', 'kaleng'],
            ['Gula Pasir', 'kg'],
            ['Minyak Goreng', 'liter'],
            ['Kopi Bubuk', 'kg'],
            ['Teh Celup', 'kotak'],
            ['Kornet Kaleng', 'kaleng'],
            ['Abon Sapi', 'kaleng'],
            ['Margarin', 'kg'],
            ['Garam', 'kg'],
            ['Kecap Manis', 'botol'],
            ['Sambal Botol', 'botol'],
            ['Bubur Bayi', 'kaleng'],
            ['Madu', 'botol'],
            ['Coklat Batang', 'batang'],
            ['Permen', 'bungkus'],
            ['Roti Tawar', 'bungkus'],
            ['Keju', 'kg'],
            ['Telur', 'kg'],
            ['Ikan Kaleng', 'kaleng'],
            ['Sayur Kaleng', 'kaleng'],
            ['Buah Kaleng', 'kaleng'],
            ['Susu Formula', 'kaleng'],
            ['Biskuit Bayi', 'kaleng'],
            ['Minuman Isotonik', 'botol'],
            ['Air Galon', 'galon'],

            // Pakaian & Perlengkapan (25 item)
            ['Selimut Tebal', 'buah'],
            ['Matras Lipat', 'buah'],
            ['Bantal', 'buah'],
            ['Pakaian Dewasa (L)', 'set'],
            ['Pakaian Anak (M)', 'set'],
            ['Jaket Tebal', 'buah'],
            ['Sarung', 'buah'],
            ['Sandal Jepit', 'pasang'],
            ['Sepatu Boot', 'pasang'],
            ['Handuk Mandi', 'buah'],
            ['Sikat Gigi', 'buah'],
            ['Pasta Gigi', 'tube'],
            ['Sabun Mandi', 'batang'],
            ['Shampoo', 'botol'],
            ['Detergen Bubuk', 'kg'],
            ['Pembalut Wanita', 'pak'],
            ['Popok Dewasa', 'pak'],
            ['Popok Bayi', 'pak'],
            ['Tas Sampah', 'roll'],
            ['Plastik Klip', 'pak'],
            ['Kaos Kaki', 'pasang'],
            ['Topi', 'buah'],
            ['Sarung Tangan', 'pasang'],
            ['Rompi', 'buah'],
            ['Celana Panjang', 'buah'],

            // Kesehatan & Obat-obatan (20 item)
            ['Obat Demam', 'strip'],
            ['Obat Batuk', 'botol'],
            ['Obat Pusing', 'strip'],
            ['Obat Diare', 'strip'],
            ['Vitamin C', 'botol'],
            ['Masker Bedah', 'kotak'],
            ['Masker N95', 'kotak'],
            ['Hand Sanitizer', 'botol'],
            ['Sarung Tangan Latex', 'pak'],
            ['Plaster Luka', 'kotak'],
            ['Perban Gulung', 'buah'],
            ['Povidone Iodine', 'botol'],
            ['Kapas Steril', 'pak'],
            ['Termometer Digital', 'buah'],
            ['Tensimeter', 'buah'],
            ['Alkohol 70%', 'botol'],
            ['Betadine', 'botol'],
            ['Paracetamol', 'strip'],
            ['Antibiotik', 'strip'],
            ['Obat Maag', 'strip'],

            // Perlengkapan Shelter (10 item)
            ['Tenda Family', 'buah'],
            ['Tenda Dome', 'buah'],
            ['Terpal Besar', 'buah'],
            ['Karpet Plastik', 'roll'],
            ['Lampu Emergency', 'buah'],
            ['Senter LED', 'buah'],
            ['Baterai AA', 'pak'],
            ['Power Bank', 'buah'],
            ['Kabel Extension', 'roll'],
            ['Charger HP', 'buah'],

            // Perlengkapan Masak (10 item)
            ['Kompor Portable', 'buah'],
            ['Gas LPG 3kg', 'tabung'],
            ['Panci Stainless', 'buah'],
            ['Wajan', 'buah'],
            ['Piring Plastik', 'lusin'],
            ['Gelas Plastik', 'lusin'],
            ['Sendok Garpu', 'set'],
            ['Pisau Dapur', 'buah'],
            ['Talenan', 'buah'],
            ['Magic Jar', 'buah'],

            // Lain-lain (5 item)
            ['Kantong Mayat', 'buah'],
            ['Kapur Barus', 'kotak'],
            ['Semprotan Nyamuk', 'kaleng'],
            ['Obat Nyamuk Bakar', 'kotak'],
            ['Korek Api', 'kotak'],
        ];

        // Sumber donasi
        $sumberList = [
            'BNPB (Badan Nasional Penanggulangan Bencana)',
            'PMI (Palang Merah Indonesia)',
            'Dinas Sosial Provinsi',
            'Dinas Sosial Kabupaten',
            'TNI/Polri',
            'Aksi Cepat Tanggap (ACT)',
            'Dompet Dhuafa',
            'Rumah Zakat',
            'BAZNAS',
            'UNICEF',
            'World Vision',
            'CARE Indonesia',
            'Oxfam',
            'Save the Children',
            'Wahana Visi Indonesia',
            'Plan International',
            'Perusahaan Swasta',
            'Donatur Perorangan',
            'Masyarakat Umum',
            'Organisasi Keagamaan',
        ];

        $this->command->info('🚀 Memulai seeder logistik bencana...');

        // Generate 100 data logistik
        for ($i = 1; $i <= 100; $i++) {
            $item = $logistikItems[array_rand($logistikItems)];
            $namaBarang = $item[0];
            $satuan = $item[1];
            $sumber = $sumberList[array_rand($sumberList)];

            $stok = $faker->numberBetween(50, 1000);

            DB::table('logistik_bencana')->insert([
                'logistik_id' => $i, // ID auto increment
                'kejadian_id' => $faker->randomElement($kejadianIds),
                'nama_barang' => $namaBarang,
                'satuan' => $satuan,
                'stok' => $stok,
                'sumber' => $sumber,
                'created_at' => $faker->dateTimeBetween('-3 months', 'now'),
                'updated_at' => now(),
            ]);

            // Progress bar
            if ($i % 10 === 0) {
                $this->command->info("   ✅ Data ke-$i berhasil dibuat: $namaBarang ($satuan)");
            }
        }

        $this->command->info('🎉 Seeder logistik bencana selesai: 100 data');
        $this->command->info('📊 Kategori: Makanan, Pakaian, Kesehatan, Shelter, Perlengkapan');
    }
}
