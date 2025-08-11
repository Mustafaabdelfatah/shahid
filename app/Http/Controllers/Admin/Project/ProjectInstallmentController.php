<?php
namespace App\Http\Controllers\Admin\Project;

use App\Models\Project;
use Illuminate\Http\Request;
use App\Models\CompoundInstallment;
use App\Http\Controllers\Controller;

class ProjectInstallmentController extends Controller
{
    public function create($projectId)
    {
        $project = Project::with('installments')->findOrFail($projectId);
        return view('admin.pages.project.installment.create',compact('project'));
    }


    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'product_id' => 'nullable',
            'deposit' => 'required|numeric|min:0',
            'price' => 'required|numeric|min:0', // Ensure price is included and valid
            'years' => 'required|integer|min:1',

        ]);

        // Retrieve deposit details
        $price_unit = $request->price;
        $years = $request->years;
        $down_payment = $request->deposit;

        // Calculate total months
        $months = $years * 12;

        // Prevent division by zero and ensure down_payment is less than price
        if ($months > 0 && $price_unit > $down_payment) {
            $monthly_installment = ($price_unit - $down_payment) / $months;
        } else {
            $monthly_installment = 0;
        }

        // Store the installment details, including the monthly installment
        $compound_installment = CompoundInstallment::create(array_merge($request->all(), [
            'monthly_installment' => $monthly_installment
        ]));
        $projectId = $compound_installment->project_id;
        return redirect()->route('admin.compound_installments.create', $projectId)
            ->with('success', __('Created successfully'));
        // Optionally, return response or redirect
        return redirect()->back()->with('success', 'Installment saved successfully');
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
        $compound_installment = CompoundInstallment::findOrFail($id);

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
        $compound_installment->update([
            'product_id' => $request->product_id,
            'deposit' => $down_payment,
            'years' => $years,
            'monthly_installment' => $monthly_installment
        ]);

        // Redirect back to the same page or wherever needed
        return redirect()->back()->with('success', __('Installment updated successfully'));
    }

    public function destroy($id)
    {
        $compoundInstallment = CompoundInstallment::findOrFail($id);
        $compoundInstallment->delete();
        return redirect()->back()->with('success', __('Deleted successfully'));
    }
}
