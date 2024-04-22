<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }
    public function allOrders()
    {
        $orders = Order::all();
        return view('admin.orders.all-orders', compact('orders'));
    }
    public function printPdf($id)
    {
        $order = Order::find($id);
        $pdf = Pdf::loadView('admin.report.pdf', compact('order'));
        return $pdf->download('order_detail.pdf');
    }
}
