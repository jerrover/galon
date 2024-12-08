<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 10);
        $search = $request->input('search', '');
        
        $query = DB::table('customers');
        
        if (!empty($search)) {
            $query->where('name', 'like', "%{$search}%")
                  ->orWhere('phone_number', 'like', "%{$search}%")
                  ->orWhere('address', 'like', "%{$search}%");
        }
        
        $totalData = $query->count();
        $customers = $query->where('is_active', true)
                         ->orderBy('name', 'asc')
                         ->paginate($perPage);
        
        $from = $customers->firstItem() ?? 0;
        $to = $customers->lastItem() ?? 0;

        return view('customers.index', compact(
            'customers', 
            'perPage', 
            'totalData',
            'from',
            'to'
        ));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required',
                'address' => 'required',
                'phone_number' => 'required',
            ]);

            DB::table('customers')->insert([
                'name' => $request->name,
                'address' => $request->address,
                'phone_number' => $request->phone_number,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now()
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Customer added successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }

    public function edit($id)
    {
        $customer = DB::table('customers')
            ->where('id', $id)
            ->where('is_active', true)
            ->first();

        return response()->json($customer);
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'name' => 'required',
                'address' => 'required',
                'phone_number' => 'required',
            ]);

            DB::table('customers')
                ->where('id', $id)
                ->update([
                    'name' => $request->name,
                    'address' => $request->address,
                    'phone_number' => $request->phone_number,
                    'updated_at' => now()
                ]);

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        DB::table('customers')
            ->where('id', $id)
            ->update(['is_active' => false]);

        return response()->json(['success' => true]);
    }
}
