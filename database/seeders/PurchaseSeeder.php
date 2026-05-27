<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Purchase;
use App\Models\PurchaseItem;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\User;
use Carbon\Carbon;

class PurchaseSeeder extends Seeder
{
    public function run(): void
    {
        $suppliers = Supplier::all();
        
        // Pilih user yang merupakan admin atau apoteker
        $users = User::whereHas('role', function($q) {
            $q->whereIn('name', ['admin', 'apoteker']);
        })->get();

        if ($users->isEmpty()) {
            $users = User::all();
        }

        $products = Product::where('is_active', true)->get();

        if ($suppliers->isEmpty() || $products->isEmpty()) {
            $this->command->info('Silakan jalankan SupplierSeeder dan ProductSeeder terlebih dahulu.');
            return;
        }

        $startDate = Carbon::now()->subMonths(3)->startOfMonth();
        $endDate = Carbon::now()->endOfMonth();

        for ($i = 0; $i < 30; $i++) {
            $date = Carbon::createFromTimestamp(
                rand($startDate->timestamp, $endDate->timestamp)
            )->setTime(rand(8, 17), rand(0, 59), rand(0, 59));

            $supplier = $suppliers->random();
            $user = $users->random();
            
            // Jumlah item yang dibeli (1 sampai 5 jenis produk berbeda)
            $numItems = rand(1, 5);
            $selectedProducts = $products->random($numItems);

            $total = 0;
            $itemsData = [];

            foreach ($selectedProducts as $product) {
                // Kuantitas pembelian (misal 50 sampai 200 unit)
                $quantity = rand(50, 200);
                $purchasePrice = $product->purchase_price;
                $subtotal = $quantity * $purchasePrice;
                $total += $subtotal;

                $itemsData[] = [
                    'product_id' => $product->id,
                    'quantity' => $quantity,
                    'purchase_price' => $purchasePrice,
                    'subtotal' => $subtotal,
                ];
            }

            $purchase = Purchase::create([
                'supplier_id' => $supplier->id,
                'user_id' => $user->id,
                'purchase_date' => $date->format('Y-m-d'),
                'total' => $total,
                'created_at' => $date,
                'updated_at' => $date,
            ]);

            foreach ($itemsData as $itemData) {
                PurchaseItem::create([
                    'purchase_id' => $purchase->id,
                    'product_id' => $itemData['product_id'],
                    'quantity' => $itemData['quantity'],
                    'purchase_price' => $itemData['purchase_price'],
                    'subtotal' => $itemData['subtotal'],
                    'created_at' => $date,
                    'updated_at' => $date,
                ]);

                // Update stok produk
                $productToUpdate = Product::find($itemData['product_id']);
                if ($productToUpdate) {
                    $productToUpdate->increment('stock', $itemData['quantity']);
                }
            }
        }

        $this->command->info('Berhasil membuat 30 transaksi pembelian barang.');
    }
}
