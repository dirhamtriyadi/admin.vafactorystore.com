<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'dashboard-list',
            'dashboard-create',
            'dashboard-edit',
            'dashboard-delete',
            'customer-list',
            'customer-create',
            'customer-edit',
            'customer-delete',
            'transaction-sale-list',
            'transaction-sale-create',
            'transaction-sale-edit',
            'transaction-sale-delete',
            'report-transaction-sale-report',
            'report-transaction-sale-create',
            'report-transaction-sale-edit',
            'report-transaction-sale-delete',
            'item-list',
            'item-create',
            'item-edit',
            'item-delete',
            'order-list',
            'order-create',
            'order-edit',
            'order-delete',
            'order-transaction-list',
            'order-transaction-create',
            'order-transaction-edit',
            'order-transaction-delete',
            'order-tracking-list',
            'order-tracking-create',
            'order-tracking-edit',
            'order-tracking-delete',
            'cashflows-list',
            'cashflows-create',
            'cashflows-edit',
            'cashflows-delete',
            'report-cashflows-list',
            'report-cashflows-create',
            'report-cashflows-edit',
            'report-cashflows-delete',
            'type-payment-list',
            'type-payment-create',
            'type-payment-edit',
            'type-payment-delete',
            'category-list',
            'category-create',
            'category-edit',
            'category-delete',
            'tracking-list',
            'tracking-create',
            'tracking-edit',
            'tracking-delete',
            'user-list',
            'user-create',
            'user-edit',
            'user-delete',
            'role-list',
            'role-create',
            'role-edit',
            'role-delete',
        ];

        foreach ($permissions as $permission) {
            Permission::create([
                'name' => $permission,
            ]);
        }
    }
}
