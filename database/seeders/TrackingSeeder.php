<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TrackingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // \App\Models\Tracking::factory(10)->create();

        $trackings = [
            [
                'name' => 'Jahit',
                'description' => 'Pesanan sedang dijahit',
                'created_by' => '1',
                'updated_by' => '1',
            ], [
                'name' => 'Sablon',
                'description' => 'Pesanan sedang disablon',
                'created_by' => '1',
                'updated_by' => '1',
            ], [
                'name' => 'Print',
                'description' => 'Pesanan sedang diprint',
                'created_by' => '1',
                'updated_by' => '1',
            ], [
                'name' => 'Press',
                'description' => 'Pesanan sedang dipress',
                'created_by' => '1',
                'updated_by' => '1',
            ], [
                'name' => 'Kemas',
                'description' => 'Pesanan sedang dikemas',
                'created_by' => '1',
                'updated_by' => '1',
            ], [
                'name' => 'Kirim',
                'description' => 'Pesanan sedang dikirim',
                'created_by' => '1',
                'updated_by' => '1',
            ]
        ];

        foreach ($trackings as $tracking) {
            \App\Models\Tracking::create($tracking);
        }
    }
}
