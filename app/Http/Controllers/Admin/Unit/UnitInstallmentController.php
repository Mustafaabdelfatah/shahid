<?php

namespace App\Http\Controllers\Admin\Unit;

use App\Models\Deposit;
use App\Models\Product;
use App\Models\Project;
use Illuminate\Http\Request;
use App\Models\UnitInstallment;
use App\Http\Controllers\Controller;

class UnitInstallmentController extends Controller
{
    public function create($productId)
    {
        $product = Product::with('installments')->findOrFail($productId);
        return view('admin.pages.unit.installment.create', compact('product'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'nullable',
            'price' => 'nullable|numeric|min:0',
            'deposit' => 'required|numeric|min:0', // 'required' instead of 'require'
            'years' => 'required|integer|min:1',   // 'required' instead of 'require'
        ]);

        // Retrieve deposit details
        $price_unit = $request->price;
        $years = $request->years;

        // Calculate the monthly installment
        $total_price = $price_unit;
        $down_payment = $request->deposit;
        $months = $years * 12; // Total months

        // Prevent division by zero
        if ($months > 0) {
            $monthly_installment = ($total_price - $down_payment) / $months;
        } else {
            $monthly_installment = 0;
        }

        // Store the installment details, including the monthly installment
        $unit_installment = UnitInstallment::create(array_merge($request->all(), [
            'monthly_installment' => $monthly_installment
        ]));

        // Retrieve the product ID for redirection
        $productId = $unit_installment->product_id;

        return redirect()->route('admin.unit-installments.create', $productId)
            ->with('success', __('Created successfully'));
    }



    public function update(Request $request, $id)
    {
        // Validate the request data
        $request->validate([
            'product_id' => 'nullable',
            'price' => 'nullable|numeric|min:0',
            'deposit' => 'required|numeric|min:0',
            'years' => 'required|integer|min:1',
        ]);

        // Retrieve the existing installment
        $unit_installment = UnitInstallment::findOrFail($id);

        // Calculate the monthly installment
        $total_price = $request->price;
        $down_payment = $request->deposit;
        $years = $request->years;
        $months = $years * 12; // Total months

        // Prevent division by zero
        if ($months > 0) {
            $monthly_installment = ($total_price - $down_payment) / $months;
        } else {
            $monthly_installment = 0;
        }

        // Update the installment record with the new data
        $unit_installment->update([
            'product_id' => $request->product_id,
            'price' => $total_price,
            'deposit' => $down_payment,
            'years' => $years,
            'monthly_installment' => $monthly_installment
        ]);

        // Redirect back to the same page or wherever needed
        return redirect()->back()->with('success', __('Installment updated successfully'));
    }


    public function destroy($id)
    {
        $unit_installment = UnitInstallment::findOrFail($id);
        $unit_installment->delete();
        return redirect()->back()->with('success', __('Deleted successfully'));
    }
}
