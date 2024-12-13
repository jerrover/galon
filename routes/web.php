<?php
use App\Http\Controllers\PenggajianController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\WaterGallonsController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ExpenseController;

Route::get('/penggajian', [PenggajianController::class, 'index'])->name('penggajian.index');
// Public routesRoute::get('/penggajian', [PenggajianController::class, 'index'])->name('penggajian.index');
Route::get('/', [WaterGallonsController::class, 'index'])->name('welcome');
Route::get('/home', [HomeController::class, 'index'])->name('Home');

// Admin auth routes
Route::get('/admin/login', [AdminController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminController::class, 'login']);
Route::post('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');

// Semua route yang memerlukan autentikasi admin
Route::middleware(['auth.admin'])->group(function () {
    Route::get('/admin/home', [HomeController::class, 'index'])->name('admin.home');
    
    // Customer routes
    Route::resource('customers', CustomerController::class);
    
    // Transaction routes
    Route::get('/transactions', [TransactionController::class, 'index'])->name('transactions.index');
    Route::post('/transactions', [TransactionController::class, 'store'])->name('transactions.store');
    Route::get('/transactions/{id}/edit', [TransactionController::class, 'edit'])->name('transactions.edit');
    Route::put('/transactions/{id}', [TransactionController::class, 'update'])->name('transactions.update');
    Route::delete('/transactions/{id}', [TransactionController::class, 'destroy'])->name('transactions.destroy');
    Route::resource('expenses', ExpenseController::class);
    
    // Penggajian routes
    Route::get('/penggajian', [PenggajianController::class, 'index'])->name('penggajian.index');
    
    // Data Pegawai routes
    Route::get('/datapegawai', [PegawaiController::class, 'index'])->name('datapegawai.index');
    Route::post('/datapegawai', [PegawaiController::class, 'store'])->name('datapegawai.store');
    Route::get('/datapegawai/{id}/edit', [PegawaiController::class, 'edit'])->name('datapegawai.edit');
    Route::put('/datapegawai/{id}', [PegawaiController::class, 'update'])->name('datapegawai.update');
    Route::delete('/datapegawai/{id}', [PegawaiController::class, 'destroy'])->name('datapegawai.destroy');
    
    // Absensi routes
    Route::get('/absensi', [AbsensiController::class, 'index'])->name('absensi.index');
    Route::post('/absensi', [AbsensiController::class, 'store'])->name('absensi.store');
    Route::get('/absensi/filter', [AbsensiController::class, 'filter'])->name('absensi.filter');
    Route::delete('/absensi/{id}', [AbsensiController::class, 'destroy'])->name('absensi.destroy');
    
    // Reports routes
    Route::get('/reports/chart', [ReportController::class, 'transactionChart'])->name('reports.chart');
    Route::get('/reports/chart-data', [ReportController::class, 'getChartData'])->name('reports.chartData');
    Route::get('/reports/price-chart', [ReportController::class, 'priceChart'])->name('reports.priceChart');
    Route::get('/reports/price-chart-data', [ReportController::class, 'getPriceChartData'])->name('reports.priceChartData');
    Route::get('/reports/monthly-table', [ReportController::class, 'monthlyReport'])->name('reports.monthlyTable');
    Route::get('/reports/monthly-table-data', [ReportController::class, 'getMonthlyTableData'])->name('reports.monthlyTableData');
});
