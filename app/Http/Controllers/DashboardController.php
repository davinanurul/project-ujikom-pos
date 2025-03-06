<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Produk;
use App\Models\Supplier;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $produkCount = Produk::count();
        $supplierCount = Supplier::count();
        $memberCount = Member::count();
        return view('dashboard', compact('produkCount', 'supplierCount', 'memberCount'));
    }
}
