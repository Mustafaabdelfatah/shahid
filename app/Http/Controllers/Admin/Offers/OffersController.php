<?php
namespace App\Http\Controllers\Admin\Offers;

use App\Models\Offers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\OfferRequest;
use App\Http\Controllers\Controller;

class OffersController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $offers = Offers::query()->with('trans')->paginate(10);
        
        return view('admin.pages.offers.index', compact('offers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // dd('sssssssssss');
        return view('admin.pages.offers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(OfferRequest $request)
    {
        DB::beginTransaction();

        try {
            $data = $request->getSanitized();

            // Create the offer record
            $offer = Offers::create($data);

            // Add related translations if applicable
            if (isset($data['translations']) && is_array($data['translations'])) {
                foreach ($data['translations'] as $translationData) {
                    // Ensure the foreign key is correctly set
                    $translationData['offers_id'] = $offer->id;
                    $offer->translations()->create($translationData);
                }
            }

            DB::commit();

            return redirect()->route('admin.offers.index')->with('success', 'Created Successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('admin.offers.index')->with('error', 'Failed to create offer: ' . $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Offers $offer)
    {
        $currentPage = request('page', 1);

        return view('admin.pages.offers.edit', compact('offer', 'currentPage'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(OfferRequest $request, Offers $offer)
    {
        $data = $request->getSanitized();
        $offer->update($data);
        return redirect()->route('admin.offers.index', ['page' => $request->input('page', 1)])->with('success', __('Updated Successfully'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Offers $offer)
    {
        $offer->delete();
        return redirect()->route('admin.offers.index')->with('success', __('Deleted Successfully'));
    }

    public function update_status($id)
    {
        $offer = Offers::findOrFail($id);
        $offer->status = $offer->status == 1 ? 0 : 1;
        $offer->save();
        session()->flash('success', __('Updated Successfully'));
        return redirect()->back();
    }



    public function actions(Request $request)
    {

        if ($request['publish'] == 1) {
            $offers = Offers::findMany($request['record']);
            foreach ($offers as $item) {
                $item->update(['status' => 1]);
            }
            session()->flash('success', __('Updated Sucessfully'));
        }
        if ($request['unpublish'] == 1) {
            $offers = Offers::findMany($request['record']);
            foreach ($offers as $item) {
                $item->update(['status' => 0]);
            }
            session()->flash('success', __('Updated Sucessfully'));
        }
        if ($request['delete_all'] == 1) {
            $offers = Offers::findMany($request['record']);
            foreach ($offers as $item) {
                $item->delete();
            }

            return redirect()->route('admin.offers.index')->with('success', __('Deleted Sucessfully'));

        }

        return redirect()->back();
    }
}


