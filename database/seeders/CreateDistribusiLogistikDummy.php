<?php
// database/seeders/CreateDistribusiLogistikDummy.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory;

class CreateDistribusiLogistikDummy extends Seeder
{
    public function run(): void
    {
        $faker = Factory::create('id_ID');

        // Hapus data lama
        DB::table('distribusi_logistik')->delete();

        // Ambil data logistik
        $logistikData = DB::table('logistik_bencana')->get();

        if ($logistikData->isEmpty()) {
            $this->command->error('❌ Data logistik tidak tersedia. Jalankan seeder logistik terlebih dahulu!');
            return;
        }

        // Ambil data posko
        $poskoData = DB::table('posko_bencana')->get();

        if ($poskoData->isEmpty()) {
            $this->command->error('❌ Data posko tidak tersedia. Jalankan seeder posko terlebih dahulu!');
            return;
        }

        // Nama penerima (pejabat/relawan)
        $penerimaList = [
            'Bapak Sutrisno (Ketua RT)',
            'Ibu Sri Wahyuni (Ketua PKK)',
            'Bapak Joko Widodo (Relawan)',
            'Ibu Ani Yudhoyono (Relawan)',
            'Bapak Budi Santoso (Petugas Posko)',
            'Ibu Siti Fatimah (Petugas Kesehatan)',
            'Bapak Ahmad Hidayat (Ketua RW)',
            'Ibu Maria Ulfa (Sekretaris Posko)',
            'Bapak Rudi Hartono (Koordinator Relawan)',
            'Ibu Dewi Sartika (Bendahara Posko)',
            'Bapak Eko Prasetyo (Petugas Distribusi)',
            'Ibu Ratna Sari (Petugas Logistik)',
            'Bapak Fajar Nugroho (Anggota TNI)',
            'Ibu Lina Marlina (Anggota Polri)',
            'Bapak Guntur Sukarno (Tim SAR)',
            'Ibu Maya Sari (PMI)',
            'Bapak Hendra Gunawan (BNPB)',
            'Ibu Tina Sumarni (Dinas Sosial)',
            'Bapak Irfan Maulana (ACT)',
            'Ibu Diana Putri (Dompet Dhuafa)',
        ];

        $this->command->info('🚀 Memulai seeder distribusi logistik...');

        // Generate 100 data distribusi
        for ($i = 1; $i <= 100; $i++) {
            $logistik = $logistikData->random();
            $posko = $poskoData->random();

            // Tentukan jumlah distribusi (maksimal 80% dari stok)
            $maxDistribusi = (int)($logistik->stok * 0.8);
            $jumlah = $faker->numberBetween(5, min(200, $maxDistribusi));

            // Pilih penerima
            $penerima = $penerimaList[array_rand($penerimaList)];

            DB::table('distribusi_logistik')->insert([
                'distribusi_id' => $i, // ID auto increment
                'logistik_id' => $logistik->logistik_id,
                'posko_id' => $posko->posko_id,
                'tanggal' => $faker->dateTimeBetween('-2 months', 'now'),
                'jumlah' => $jumlah,
                'penerima' => $penerima,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Update stok logistik (dikurangi jumlah yang didistribusikan)
            $newStok = max(0, $logistik->stok - $jumlah);
            DB::table('logistik_bencana')
                ->where('logistik_id', $logistik->logistik_id)
                ->update(['stok' => $newStok]);

            // Progress bar
            if ($i % 10 === 0) {
                $logistikNama = $logistik->nama_barang;
                $poskoNama = $posko->nama;
                $this->command->info("   ✅ Data ke-$i: $jumlah $logistik->satuan $logistikNama ke $poskoNama");
            }
        }

        $this->command->info('🎉 Seeder distribusi logistik selesai: 100 data');
        $this->command->info('📊 Stok logistik telah diperbarui otomatis');
    }
}
