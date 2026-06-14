<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;

class MarketingController extends Controller
{
    public function index()
    {
        return response()->json(Banner::latest()->paginate(20));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'      => 'required|string|max:255',
            'placement'  => 'required|string|max:100',
            'start_date' => 'required|date',
            'end_date'   => 'required|date|after:start_date',
        ]);
        $data['status'] = 'Draft';
        return response()->json(Banner::create($data), 201);
    }

    public function show(Banner $banner)   { return response()->json($banner); }

    public function update(Request $request, Banner $banner)
    {
        $banner->update($request->validate([
            'title'     => 'sometimes|string|max:255',
            'placement' => 'sometimes|string|max:100',
            'status'    => 'sometimes|in:Active,Expired,Scheduled,Draft',
        ]));
        return response()->json($banner);
    }

    public function destroy(Banner $banner)
    {
        $banner->delete();
        return response()->json(['message' => 'Deleted']);
    }

    public function toggle(Banner $banner)
    {
        $banner->status = $banner->status === 'Active' ? 'Expired' : 'Active';
        $banner->save();
        return response()->json($banner);
    }
}
