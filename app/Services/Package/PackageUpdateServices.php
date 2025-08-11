<?php
namespace App\Services\Package;
    


use App\Models\Package;
use App\Models\DatePackage;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PackageUpdateServices
{
    /**
     * Validate the incoming request data.
     *
     * @param Request $request
     * @return array
     * @throws \Illuminate\Validation\ValidationException
     */
    public function validateRequest(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'list' => 'required|array',
            'list.*.price' => 'required|numeric',
            'list.*.duration' => 'required|integer',
        ]);

        if ($validator->fails()) {
            throw new \Illuminate\Validation\ValidationException($validator);
        }

        return $request->all();
    }

    /**
     * Update the package with the provided data.
     *
     * @param array $data
     * @param int $id
     * @return Package
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function updatePackage(array $data, int $id)
    {
        $package = Package::findOrFail($id);
        $package->update($data);
        return $package;
    }

    /**
     * Create date packages associated with the package.
     *
     * @param array $data
     * @param Package $package
     */
    public function createDatePackage(array $data, Package $package)
    {
        foreach ($data['list'] as $item) {
            $datePackage = new DatePackage();
            $datePackage->price = $item['price'];
            $datePackage->duration = $item['duration'];
            $datePackage->package_id = $package->id;
            $datePackage->save();
        }
    }

    /**
     * Handle the update process including validation, updating package, and creating date packages.
     *
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, int $id)
    {
        try {
            DB::beginTransaction();

            // Validate and sanitize the request data
            $data = $this->validateRequest($request);

            // Update the package
            $package = $this->updatePackage($data, $id);

            // Create associated date packages
            $this->createDatePackage($data, $package);

            DB::commit();
            return redirect()->back()->with('success', 'Updated successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
