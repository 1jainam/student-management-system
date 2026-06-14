<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function index()
    {
        return response()->json(Company::latest()->paginate(20));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'    => 'required|string|max:150',
            'sector'  => 'required|string|max:100',
            'contact' => 'required|email|max:150',
        ]);
        $data['placements'] = 0;
        $data['visits']     = 0;
        $data['status']     = 'Active';
        return response()->json(Company::create($data), 201);
    }

    public function show(Company $company)   { return response()->json($company); }

    public function update(Request $request, Company $company)
    {
        $company->update($request->validate([
            'name'       => 'sometimes|string|max:150',
            'sector'     => 'sometimes|string|max:100',
            'contact'    => 'sometimes|email|max:150',
            'status'     => 'sometimes|in:Active,Inactive',
            'placements' => 'sometimes|integer|min:0',
            'visits'     => 'sometimes|integer|min:0',
        ]));
        return response()->json($company);
    }

    public function destroy(Company $company)
    {
        $company->delete();
        return response()->json(['message' => 'Deleted']);
    }
}
