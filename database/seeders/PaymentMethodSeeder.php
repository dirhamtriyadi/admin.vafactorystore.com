<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaymentMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // \App\Models\PaymentMethod::factory(10)->create();
        $paymentMerthods = [
            [
                'name' => 'Cash',
                'description' => 'Cash payment',
                'created_by' => '1',
                'updated_by' => '1',
            ], [
                'name' => 'BCA',
                'description' => 'Ini bank BCA',
                'created_by' => '1',
                'updated_by' => '1',
            ], [
                'name' => 'Mandiri',
                'description' => 'Ini bank Mandiri',
                'created_by' => '1',
                'updated_by' => '1',
            ], [
                'name' => 'BNI',
                'description' => 'Ini bank BNI',
                'created_by' => '1',
                'updated_by' => '1',
            ], [
                'name' => 'BRI',
                'description' => 'Ini bank BRI',
                'created_by' => '1',
                'updated_by' => '1',
            ], [
                'name' => 'OVO',
                'description' => 'Ini dompet digital OVO',
                'created_by' => '1',
                'updated_by' => '1',

            ], [
                'name' => 'DANA',
                'description' => 'Ini dompet digital DANA',
                'created_by' => '1',
                'updated_by' => '1',
            ], [
                'name' => 'LinkAja',
                'description' => 'Ini dompet digital LinkAja',
                'created_by' => '1',
                'updated_by' => '1',
            ], [
                'name' => 'ShopeePay',
                'description' => 'Ini dompet digital ShopeePay',
                'created_by' => '1',
                'updated_by' => '1',
            ], [
                'name' => 'GoPay',
                'description' => 'Ini dompet digital GoPay',
                'created_by' => '1',
                'updated_by' => '1',
            ], [
                'name' => 'Doku',
                'description' => 'Ini payment gateway Doku',
                'created_by' => '1',
                'updated_by' => '1',
            ]
        ];

        foreach ($paymentMerthods as $paymentMerthod) {
            \App\Models\PaymentMethod::create($paymentMerthod);
        }
    }
}
