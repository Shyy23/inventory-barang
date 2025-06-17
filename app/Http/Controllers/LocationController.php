<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Traits\UpdateHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    use UpdateHelper;
    public function index(Request $request)
    {
        $search = $request->query('search');
        $type = $request->query('type');

        $locations = DB::table('vlocations')
            ->when($type, function ($query) use ($type) {
                $query->where('type', $type);
            })
            ->when($search, function ($query) use ($search) {
                $query->where('location_name', 'like', '%' . $search . '%');
            })
            ->paginate(12);

        if ($request->ajax()) {
            $paginationHtml = view('components.pagination', [
                'paginator' => $locations,
                'RouteName' => 'locations.index',
                'RouteParams' => $request->except('page'),
            ])->render();

            return response()->json([
                'html' => view('locations.partials._location-list', compact('locations'))->render(),
                'pagination' => $paginationHtml,
                'type' => $type,
                'search' => $search,
            ]);
        }

        return view('locations.index', compact('locations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'location_name' => 'required|string',
            'location_type' => 'required|string|in:item,class'
        ]);

        $location = new Location();
        $location->location_name = $validatedData['location_name'];
        $location->type = $validatedData['location_type'];
        $location->save();
        return redirect()->route('locations.index')->with('success', 'Data location berhasil disimpan');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        // dd($request);
        try {
            $request->validate([
                'locations' => 'required|array',
                'locations.*.location_name' => 'required_if:locations.*.selected,1|string|max:255',
                'locations.*.type' => 'required|required_if:locations.*.selected,1|in:item,class',
            ]);

            $updatesName = [];
            $updatesType = [];
            $ids = [];


            foreach ($request->locations as $locationId => $data) {
                if (isset($data['selected'])) {
                    $ids[] = $locationId;
                    $updatesName[$locationId] = $data['location_name'];
                    $updatesType[$locationId] = $data['type'];

                }
            }
            if (!empty($ids)) {
                $updateData = [];
                if (!empty($updatesName)) {
                    $updateData['location_name'] = $this->buildCaseStatement($updatesName, 'location_id');
                }

                if (!empty($updatesType)) {
                    $updateData['type'] = $this->buildCaseStatement($updatesType, 'location_id');
                }

                if (!empty($updateData)) {
                    Location::whereIn('location_id', $ids)->update($updateData);
                }
            }

            return redirect()
                ->route('locations.index')
                ->with('success', 'Lokasi berhasil diperbarui.');

        } catch (\Exception $e) {
            return redirect()
                ->route('locations.index')
                ->with('error', 'Gagal memperbarui lokasi: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        try {
            // Validasi input
            $request->validate([
                'locations' => 'required|array',
                'locations.*' => 'exists:locations,location_id'
            ]);

            // Hapus kategori yang dipilih
            Location::whereIn('location_id', $request->locations)->delete();

            return redirect()
                ->route('locations.index')
                ->with('success', 'Lokasi berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()
                ->route('locations.index')
                ->with('error', 'Gagal menghapus Lokasi: ' . $e->getMessage());
        }
    }
}
