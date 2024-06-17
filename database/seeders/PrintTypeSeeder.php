<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PrintTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // \App\Models\PrintType::factory(10)->create();

        $printTypes = [
            [
                'name' => 'Katun',
                'price' => '10000',
                'description' => 'Katun fabric',
                'created_by' => '1',
                'updated_by' => '1',
            ], [
                'name' => 'Sutra',
                'price' => '20000',
                'description' => 'Sutra fabric',
                'created_by' => '1',
                'updated_by' => '1',
            ], [
                'name' => 'Polyester',
                'price' => '30000',
                'description' => 'Polyester fabric',
                'created_by' => '1',
                'updated_by' => '1',
            ], [
                'name' => 'Spandex',
                'price' => '40000',
                'description' => 'Spandex fabric',
                'created_by' => '1',
                'updated_by' => '1',
            ], [
                'name' => 'Denim',
                'price' => '50000',
                'description' => 'Denim fabric',
                'created_by' => '1',
                'updated_by' => '1',
            ], [
                'name' => 'Kanvas',
                'price' => '60000',
                'description' => 'Kanvas fabric',
                'created_by' => '1',
                'updated_by' => '1',
            ], [
                'name' => 'Rayon',
                'price' => '70000',
                'description' => 'Rayon fabric',
                'created_by' => '1',
                'updated_by' => '1',
            ], [
                'name' => 'Linen',
                'price' => '80000',
                'description' => 'Linen fabric',
                'created_by' => '1',
                'updated_by' => '1',
            ], [
                'name' => 'Wool',
                'price' => '90000',
                'description' => 'Wool fabric',
                'created_by' => '1',
                'updated_by' => '1',
            ], [
                'name' => 'Cotton',
                'price' => '100000',
                'description' => 'Cotton fabric',
                'created_by' => '1',
                'updated_by' => '1',
            ], [
                'name' => 'Silk',
                'price' => '110000',
                'description' => 'Silk fabric',
                'created_by' => '1',
                'updated_by' => '1',
            ], [
                'name' => 'Nylon',
                'price' => '120000',
                'description' => 'Nylon fabric',
                'created_by' => '1',
                'updated_by' => '1',
            ], [
                'name' => 'Acrylic',
                'price' => '130000',
                'description' => 'Acrylic fabric',
                'created_by' => '1',
                'updated_by' => '1',
            ], [
                'name' => 'Polypropylene',
                'price' => '140000',
                'description' => 'Polypropylene fabric',
                'created_by' => '1',
                'updated_by' => '1',
            ], [
                'name' => 'Polyethylene',
                'price' => '150000',
                'description' => 'Polyethylene fabric',
                'created_by' => '1',
                'updated_by' => '1',
            ], [
                'name' => 'Polyurethane',
                'price' => '160000',
                'description' => 'Polyurethane fabric',
                'created_by' => '1',
                'updated_by' => '1',
            ], [
                'name' => 'Polyvinyl chloride',
                'price' => '170000',
                'description' => 'Polyvinyl chloride fabric',
                'created_by' => '1',
                'updated_by' => '1',
            ], [
                'name' => 'Polyester',
                'price' => '180000',
                'description' => 'Polyester fabric',
                'created_by' => '1',
                'updated_by' => '1',
            ], [
                'name' => 'Polyamide',
                'price' => '190000',
                'description' => 'Polyamide fabric',
                'created_by' => '1',
                'updated_by' => '1',
            ], [
                'name' => 'Polyethylene terephthalate',
                'price' => '200000',
                'description' => 'Polyethylene terephthalate fabric',
                'created_by' => '1',
                'updated_by' => '1',
            ]
        ];

        foreach ($printTypes as $printType) {
            \App\Models\PrintType::create($printType);
        }
    }
}
