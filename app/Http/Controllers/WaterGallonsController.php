<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WaterGallonsController extends Controller
{
    public function index()
    {
        return view('welcome'); // Mengembalikan tampilan welcome.blade.php
    }

    public function buy()
    {
        // Logika untuk halaman pembelian
        return view('buy'); // Ganti dengan tampilan yang sesuai
    }

    public function learnMore()
    {
        // Logika untuk halaman belajar lebih lanjut
        return view('learn-more'); // Ganti dengan tampilan yang sesuai
    }
}