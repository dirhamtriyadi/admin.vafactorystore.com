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
            'transaction-list',
            'transaction-create',
            'transaction-edit',
            'transaction-delete',
            'transaction-report-list',
            'transaction-report-create',
            'transaction-report-edit',
            'transaction-report-delete',
            'product-list',
            'product-create',
            'product-edit',
            'product-delete',
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
            'cashflow-list',
            'cashflow-create',
            'cashflow-edit',
            'cashflow-delete',
            'cashflow-report-list',
            'cashflow-report-create',
            'cashflow-report-edit',
            'cashflow-report-delete',
            'payment-method-list',
            'payment-method-create',
            'payment-method-edit',
            'payment-method-delete',
            'print-type-list',
            'print-type-create',
            'print-type-edit',
            'print-type-delete',
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
