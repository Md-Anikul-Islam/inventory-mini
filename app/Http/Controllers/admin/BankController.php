<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Bank;
use Illuminate\Http\Request;
use Toastr;
class BankController extends Controller
{
    public function index()
    {
        $bank =  Bank::latest()->get();
        return view('admin.bank.index',compact('bank'));
    }
    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required',
            ]);
            $bank = new Bank();
            $bank->name = $request->name;
            $bank->save();
            Toastr::success('Bank Added Successfully', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            // Handle the exception here
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'name' => 'required',
            ]);
            $bank = Bank::find($id);
            $bank->name = $request->name;
            $bank->status = $request->status;
            $bank->save();
            Toastr::success('Bank Updated Successfully', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $bank = Bank::find($id);
            $bank->delete();
            Toastr::success('Bank Deleted Successfully', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
}
