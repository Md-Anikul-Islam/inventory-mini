<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Bank;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Invoice;
use App\Models\Order;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Toastr;
class InvoiceController extends Controller
{
    public function index()
    {
        $invoice = Invoice::latest()->get();
        $category = Category::latest()->get();
        $bank = Bank::latest()->get();
        return view('admin.invoice.index',compact('invoice','category','bank'));
    }

    public function store(Request $request)
    {
        //dd($request->all());
        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'address' => 'required|string',
            'category_id' => 'required',
            'product_name' => 'required|string',
            'description' => 'required',
            'quantity' => 'required',
            'total' => 'required',
            'payment_type' => 'required',
            'bank_id' => 'nullable|integer|required_if:payment_type,bank',
        ]);
        // Create Customer
        $customer = Customer::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address,
        ]);

        // Create Product
        $product = Product::create([
            'category_id' => $request->category_id,
            'product_name' => $request->product_name,
            'description' => $request->description,
        ]);

        // Create Order
        $order = Order::create([
            'customer_id' => $customer->id,
            'product_id' => $product->id,
            'quantity' => $request->quantity,
            'total' => $request->total,
        ]);


        // Generate BILL NO based on today's date
        $billNo = 'BILL-' . Carbon::now()->format('d-m-Y');
        // Generate CHALAN NO with sequential number for today
        $today = Carbon::now()->format('Y-m-d');
        $lastInvoice = Invoice::whereDate('created_at', $today)->orderBy('chalan_no', 'desc')->first();
        $lastChalanNo = $lastInvoice ? intval(substr($lastInvoice->chalan_no, -8)) : 0;
        $newChalanNo = 'CHALAN-' . str_pad($lastChalanNo + 1, 8, '0', STR_PAD_LEFT);
        // Generate a unique 8-digit serial number
        $serialNo = 'SL-' . str_pad(mt_rand(100000000000, 999999999999), 12, '0', STR_PAD_LEFT); // Generating random 12-digit number
        // Create Invoice
        $invoice = Invoice::create([
            'bill_no' => $billNo,
            'chalan_no' => $newChalanNo,
            'serial_no' => $serialNo,
            'category_id' => $request->category_id,
            'customer_id' => $customer->id,
            'product_id' => $product->id,
            'product_name' => $request->product_name,
            'quantity' => $request->quantity,
            'details' => $request->description,
            'total' => $request->total,
            'payment_type' => $request->payment_type,
            'bank_id' => $request->payment_type === 'bank' ? $request->bank_id : null,
        ]);

        Toastr::success('Bank Added Successfully', 'Success');
        return redirect()->back();
    }

    public function show($id)
    {
        $invoice = Invoice::find($id);
        return view('admin.invoice.invoice',compact('invoice'));
    }
}
