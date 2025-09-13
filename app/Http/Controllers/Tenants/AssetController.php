<?php

namespace App\Http\Controllers\Tenants;

use App\Models\Asset;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AssetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $assets = Asset::all();
        return view('tenants.assets.index', compact('assets'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('tenants.assets.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            // 'tenant_id' => 'required|exists:tenants,id',
            'asset_name' => 'required|string|max:255',
            'asset_model' => 'nullable|string|max:255',
            'manufacturer' => 'nullable|string|max:255',
            'vendor' => 'nullable|string|max:255',
            'warranty_period' => 'nullable|string|max:255',
            'warranty_expiry_date' => 'nullable|date',
            'asset_image' => 'nullable|string|max:255',
            'additional_images' => 'nullable|array',
            'asset_type' => 'nullable|string|max:255',
            'serial_number' => 'nullable|string|max:255|unique:assets,serial_number',
            'purchase_date' => 'nullable|date',
            'purchase_price' => 'nullable|numeric',
            'condition' => 'nullable|string|max:255',
            'notes' => 'nullable|string',
            'location' => 'nullable|string|max:255',
        ]);

        // handle file uploads if necessary
        if ($request->hasFile('asset_image')) {
            $validated['asset_image'] = $request->file('asset_image')->store('assets', 'public');
        }

        // handle multiple additional images
        if ($request->hasFile('additional_images')) {
            $paths = [];
            foreach ($request->file('additional_images') as $image) {
                $paths[] = $image->store('assets', 'public');
            }
            $validated['additional_images'] = $paths;
        }


        Asset::create([
            // 'tenant_id' => $validated['tenant_id'],
            'asset_name' => $validated['asset_name'],
            'asset_model' => $validated['asset_model'] ?? null,
            'manufacturer' => $validated['manufacturer'] ?? null,
            'vendor' => $validated['vendor'] ?? null,
            'warranty_period' => $validated['warranty_period'] ?? null,
            'warranty_expiry_date' => $validated['warranty_expiry_date'] ?? null,
            'asset_image' => $validated['asset_image'] ?? null,
            'additional_images' => $validated['additional_images'] ?? null,
            'asset_type' => $validated['asset_type'] ?? null,
            'serial_number' => $validated['serial_number'] ?? null,
            'purchase_date' => $validated['purchase_date'] ?? null,
            'purchase_price' => $validated['purchase_price'] ?? null,
            'condition' => $validated['condition'] ?? 'good',
            'notes' => $validated['notes'] ?? null,
            'location' => $validated['location'] ?? null,
        ]);

        return redirect()->route('tenant.assets.index')->with('success', 'Asset created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Asset $asset)
    {
        return view('tenants.assets.show', compact('asset'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Asset $asset)
    {
        return view('tenants.assets.edit', compact('asset'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Asset $asset)
    {
        //
        $validated = $request->validate([
            // 'tenant_id' => 'required|exists:tenants,id',
            'asset_name' => 'required|string|max:255',
            'asset_model' => 'nullable|string|max:255',
            'manufacturer' => 'nullable|string|max:255',
            'vendor' => 'nullable|string|max:255',
            'warranty_period' => 'nullable|string|max:255',
            'warranty_expiry_date' => 'nullable|date',
            'asset_image' => 'nullable|string|max:255',
            'additional_images' => 'nullable|array',
            'asset_type' => 'nullable|string|max:255',
            'serial_number' => 'nullable|string|max:255|unique:assets,serial_number,' . $asset->id,
            'purchase_date' => 'nullable|date',
            'purchase_price' => 'nullable|numeric',
            'condition' => 'nullable|string|max:255',
            'notes' => 'nullable|string',
            'location' => 'nullable|string|max:255',
        ]);
        // handle file uploads if necessary
        if ($request->hasFile('asset_image')) {
            $validated['asset_image'] = $request->file('asset_image')->store('assets', 'public');
        }

        // handle multiple additional images
        if ($request->hasFile('additional_images')) {
            $paths = [];
            foreach ($request->file('additional_images') as $image) {
                $paths[] = $image->store('assets', 'public');
            }
            $validated['additional_images'] = $paths;
        }

        $asset->update([
            // 'tenant_id' => $validated['tenant_id'],
            'asset_name' => $validated['asset_name'],
            'asset_model' => $validated['asset_model'] ?? null,
            'manufacturer' => $validated['manufacturer'] ?? null,
            'vendor' => $validated['vendor'] ?? null,
            'warranty_period' => $validated['warranty_period'] ?? null,
            'warranty_expiry_date' => $validated['warranty_expiry_date'] ?? null,
            'asset_image' => $validated['asset_image'] ?? $asset->asset_image,
            'additional_images' => $validated['additional_images'] ?? $asset->additional_images,
            'asset_type' => $validated['asset_type'] ?? null,
            'serial_number' => $validated['serial_number'] ?? null,
            'purchase_date' => $validated['purchase_date'] ?? null,
            'purchase_price' => $validated['purchase_price'] ?? null,
            'condition' => $validated['condition'] ?? $asset->condition,
            'notes' => $validated['notes'] ?? null,
            'location' => $validated['location'] ?? null,
        ]);

        return redirect()->route('tenant.assets.index')->with('success', 'Asset updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Asset $asset)
    {
        $asset->delete();

        return redirect()->route('tenant.assets.index')->with('success', 'Asset deleted successfully.');
    }
}
