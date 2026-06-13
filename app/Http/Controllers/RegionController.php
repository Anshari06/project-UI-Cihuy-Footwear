<?php

namespace App\Http\Controllers;

use App\Models\RegProvince;
use App\Models\RegRegency;
use App\Models\RegDistrict;
use App\Models\RegVillage;
use Illuminate\Http\Request;

class RegionController extends Controller
{
    public function provinces()
    {
        $provinces = RegProvince::orderBy('name')->get(['id', 'name']);
        return response()->json($provinces);
    }

    public function cities(Request $request)
    {
        $provinceId = $request->query('province_id');
        $cities = RegRegency::where('province_id', $provinceId)
            ->orderBy('name')
            ->get(['id', 'province_id', 'name']);
        return response()->json($cities);
    }

    public function districts(Request $request)
    {
        $cityId = $request->query('city_id');
        $districts = RegDistrict::where('regency_id', $cityId)
            ->orderBy('name')
            ->get(['id', 'regency_id', 'name']);
        return response()->json($districts);
    }

    public function villages(Request $request)
    {
        $districtId = $request->query('district_id');
        $villages = RegVillage::where('district_id', $districtId)
            ->orderBy('name')
            ->get(['id', 'district_id', 'name']);
        return response()->json($villages);
    }
}