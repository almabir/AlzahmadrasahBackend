<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DonorLifeMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DonorLifeMemberController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'member_type' => 'required|in:Donor,Life Member',
            'name' => 'required|string|max:255',
            'fathers_name' => 'nullable|string|max:255',
            'probashi' => 'nullable', // Accept string or numeric representations
            'phone_number' => 'required|string|max:20',
            'email' => 'nullable|email|max:255',
            'occupation' => 'nullable|string|max:255',
            'reference' => 'nullable|string|max:255',
            'address' => 'required|string',
            'donation_payment_method' => 'required|in:Deposit in Bank Account,Online Bank Transfer,Through Website',
            'transaction_id' => 'nullable|string|max:255',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        try {
            $member = DonorLifeMember::create([
                'member_type' => $request->member_type,
                'name' => $request->name,
                'fathers_name' => $request->fathers_name,
                'probashi' => $request->probashi, // Convert to boolean
                'phone_number' => $request->phone_number,
                'email' => $request->email,
                'occupation' => $request->occupation,
                'reference' => $request->reference,
                'address' => $request->address,
                'donation_payment_method' => $request->donation_payment_method,
                'transaction_id' => $request->transaction_id,
            ]);

            return response()->json(['message' => 'Member application submitted successfully.', 'member' => $member], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to submit member application.', 'error' => $e->getMessage()], 500);
        }
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'member_type' => 'required|in:Donor,Life Member',
            'name' => 'required|string|max:255',
            'fathers_name' => 'nullable|string|max:255',
            'probashi' => 'required|boolean',
            'phone_number' => 'required|string|max:20',
            'email' => 'nullable|email|max:255',
            'occupation' => 'nullable|string|max:255',
            'reference' => 'nullable|string|max:255',
            'address' => 'required|string',
            'donation_payment_method' => 'required|in:Deposit in Bank Account,Online Bank Transfer,Through Website',
            'transaction_id' => 'nullable|string|max:255',
            'status' => 'required|in:pending,approved,rejected',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        try{
            $member = DonorLifeMember::findOrFail($id);
            $member->update($request->all());
            return response()->json(['message' => 'Member updated successfully.', 'member' => $member]);
        } catch (\Exception $e){
            return response()->json(['message' => 'Failed to update member.', 'error' => $e->getMessage()], 500);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $member = DonorLifeMember::find($id);
        if (!$member) {
            return response()->json(['message' => 'Member not found.'], 404);
        }
        return response()->json($member);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $members = DonorLifeMember::all();
        return response()->json($members);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $member = DonorLifeMember::find($id);
        if (!$member) {
            return response()->json(['message' => 'Member not found.'], 404);
        }
        $member->delete();
        return response()->json(['message' => 'Member deleted successfully.']);
    }

}
