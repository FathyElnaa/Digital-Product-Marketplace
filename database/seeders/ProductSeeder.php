<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $vendor = User::firstOrCreate(
            ['email' => 'vendor101@gmail.com'], 
            [
                'name' => 'Vendor 101',
                'password' => Hash::make('vendor101'),
                'role' => 'vendor',
            ]
        );

        Product::factory()->count(50)->create([
            'vendor_id' => $vendor->id,
            'status' => 'approved',
        ]);
    }
}
