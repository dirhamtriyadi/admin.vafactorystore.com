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
            'dashboard.index',
            'dashboard.all-data',
            'dashboard.create',
            'dashboard.edit',
            'dashboard.delete',
            'customer.index',
            'customer.all-data',
            'customer.create',
            'customer.edit',
            'customer.delete',
            'transaction.index',
            'transaction.all-data',
            'transaction.create',
            'transaction.edit',
            'transaction.delete',
            'transaction-report.index',
            'transaction-report.all-data',
            'transaction-report.create',
            'transaction-report.edit',
            'transaction-report.delete',
            'product.index',
            'product.all-data',
            'product.create',
            'product.edit',
            'product.delete',
            'order.index',
            'order.all-data',
            'order.create',
            'order.edit',
            'order.delete',
            'order-transaction.index',
            'order-transaction.all-data',
            'order-transaction.create',
            'order-transaction.edit',
            'order-transaction.delete',
            'order-tracking.index',
            'order-tracking.all-data',
            'order-tracking.create',
            'order-tracking.edit',
            'order-tracking.delete',
            'makloon.index',
            'makloon.all-data',
            'makloon.create',
            'makloon.edit',
            'makloon.delete',
            'makloon-transaction.index',
            'makloon-transaction.all-data',
            'makloon-transaction.create',
            'makloon-transaction.edit',
            'makloon-transaction.delete',
            'cashflow.index',
            'cashflow.all-data',
            'cashflow.create',
            'cashflow.edit',
            'cashflow.delete',
            'cashflow-report.index',
            'cashflow-report.all-data',
            'cashflow-report.create',
            'cashflow-report.edit',
            'cashflow-report.delete',
            'payment-method.index',
            'payment-method.all-data',
            'payment-method.create',
            'payment-method.edit',
            'payment-method.delete',
            'print-type.index',
            'print-type.all-data',
            'print-type.create',
            'print-type.edit',
            'print-type.delete',
            'tracking.index',
            'tracking.all-data',
            'tracking.create',
            'tracking.edit',
            'tracking.delete',
            'raw-material.index',
            'raw-material.all-data',
            'raw-material.create',
            'raw-material.edit',
            'raw-material.delete',
            'user.index',
            'user.all-data',
            'user.create',
            'user.edit',
            'user.delete',
            'role.index',
            'role.all-data',
            'role.create',
            'role.edit',
            'role.delete',
        ];

        foreach ($permissions as $permission) {
            Permission::create([
                'name' => $permission,
            ]);
        }
    }
}
