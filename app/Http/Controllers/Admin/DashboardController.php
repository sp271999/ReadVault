<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use App\Models\User; 

class DashboardController extends Controller
{
    public function index()
    {
        /* =========================
           PIE CHART (Books by Category)
        ========================== */

          $totalUsers = User::count();

        $categories = Category::withCount('books')->get();

        $labels = [];
        $values = [];

        foreach ($categories as $category) {
            $labels[] = $category->name;
            $values[] = $category->books_count;
        }

       /* =========================
   BAR CHART (Month-wise Borrow)
========================== */

// 1️⃣ Create all months (Jan–Dec) with default 0
$allMonths = [
    1 => 'January',  2 => 'February', 3 => 'March',
    4 => 'April',    5 => 'May',      6 => 'June',
    7 => 'July',     8 => 'August',   9 => 'September',
    10 => 'October', 11 => 'November',12 => 'December',
];

$monthValues = array_fill(1, 12, 0);

// 2️⃣ Get actual borrowed data from DB
$borrowData = DB::table('transactions')
    ->selectRaw('MONTH(borrowed_at) as month, COUNT(*) as total')
    ->where('status', 'borrowed')
    ->groupByRaw('MONTH(borrowed_at)')
    ->get();

// 3️⃣ Replace 0 with real values where data exists
foreach ($borrowData as $row) {
    $monthValues[$row->month] = $row->total;
}

// 4️⃣ Prepare final arrays for chart
$monthLabels = array_values($allMonths);
$monthValues = array_values($monthValues);

return view('admin.dashboard', compact(
    'labels',
    'values',
    'monthLabels',
    'monthValues',
     'totalUsers'
));


    }
}
