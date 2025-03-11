<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Produk>
 */
class ProdukFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $data = DB::table('kategori')
            ->inRandomOrder()
            ->select('id')
            ->first();

        $supplier = DB::table('supplier')
            ->inRandomOrder()
            ->select('id')
            ->first();

        $user = DB::table('users')
            ->inRandomOrder()
            ->select('user_id')
            ->first();

        return [
            'user_id' => $user->user_id,
            'kategori_id' => $data->id,
            'supplier_id' => $supplier->id,
            'kode' => "BG" . sprintf('%08d', fake()->unique()->numberBetween(1, 999999)),
            'nama' => fake()->randomElement(['kaos hitam', 'kaos putih', 'kaos biru', 'kaos merah']),

        ];
    }
}
