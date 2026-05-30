<?php

namespace App\Http\Controllers\Apoteker;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class ReportController extends Controller
{
    public function index()
    {
        $transactions = Transaction::with('user')
            ->whereDate('transaction_date', today())
            ->latest()
            ->paginate(15);

        $total = Transaction::whereDate('transaction_date', today())->sum('total');

        return view('apoteker.reports.index', compact('transactions', 'total'));
    }

    public function exportPdf()
    {
        $transactions = Transaction::with('user', 'items.product')
            ->whereDate('transaction_date', today())
            ->latest()
            ->get();

        $total = $transactions->sum('total');
        $date  = today()->format('d/m/Y');

        $pdf = Pdf::loadView('apoteker.reports.pdf', compact('transactions', 'total', 'date'))
                  ->setPaper('a4', 'landscape');

        return $pdf->stream('laporan-hari-ini.pdf');
    }

    public function destroy(Transaction $transaction)
    {
        DB::transaction(function () use ($transaction) {
            foreach ($transaction->items as $item) {
                $product = Product::find($item->product_id);
                if ($product) {
                    $product->increment('stock', $item->qty);
                }
            }
            $transaction->items()->delete();
            $transaction->delete();
        });

        return redirect()->route('apoteker.reports')->with('success', 'Transaksi berhasil dihapus dan stok dikembalikan.');
    }
}
