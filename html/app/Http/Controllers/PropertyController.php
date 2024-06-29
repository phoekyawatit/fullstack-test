<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Models\PropertyGeo;
use App\Models\Province;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $queryBuilder = Property::query();
            if ($request->has('search')) {
                $search = $request->get('search');
                $queryBuilder->where('title', 'like', "%{$search}%");
            }
    
            if ($request->has('location')) {
                $location = $request->get('location');
                $province = Province::where('slug', Str::slug($location))->first();
                $propertyIds = PropertyGeo::where('province_id', $province->id)->pluck('property_id')->toArray();
                $queryBuilder->whereIn('id', $propertyIds);
            }

            if ($request->has('sorting')) {
                $sorting = $request->get('sorting');
                if ($sorting == 'price_asc') {
                    $queryBuilder->orderBy('price', 'asc');
                } elseif ($sorting == 'price_desc') {
                    $queryBuilder->orderBy('price', 'desc');
                } elseif ($sorting == 'date_asc') {
                    $queryBuilder->orderBy('created_at', 'asc');
                } elseif ($sorting == 'date_desc') {
                    $queryBuilder->orderBy('created_at', 'desc');
                }
            }
            $properties = $queryBuilder->paginate(25);
            return response()->json($properties);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Server Error'], 500);
        }
    }
}
