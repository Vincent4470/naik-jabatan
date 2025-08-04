<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\KriteriaPenilaian;
use App\Models\SubKriteriaPenilaian;

class SubKriteriaPenilaianSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SubKriteriaPenilaian::truncate();

        $kriteriaList = KriteriaPenilaian::all();
        $dataToInsert = [];

        foreach ($kriteriaList as $kriteria) {
            for ($nilai = 1; $nilai <= 100; $nilai++) {
                $label = '';
                if ($nilai <= 50) {
                    $label = 'Sangat Kurang';
                } elseif ($nilai <= 60) {
                    $label = 'Kurang';
                } elseif ($nilai <= 75) {
                    $label = 'Cukup';
                } elseif ($nilai <= 90) {
                    $label = 'Baik';
                } else {
                    $label = 'Sangat Baik';
                }

                $dataToInsert[] = [
                    'id_kriteria' => $kriteria->id_kriteria,
                    'nama_pilihan' => $label . ' (' . $nilai . ')',
                    'nilai' => $nilai,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }

        SubKriteriaPenilaian::insert($dataToInsert);
    }
}
