<?php

namespace App\Http\Controllers;

use App\Models\PaymentGateway;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Database\QueryException;
use Exception;
use Illuminate\Support\Facades\Log;

class PaymentGatewayController extends Controller
{
    /**
     * Display a listing of the payment gateways.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $paymentGateways = PaymentGateway::all();
            return view('admin.payment-gateways.index', compact('paymentGateways'));
        } catch (QueryException $e) {
            Log::error('Database error in PaymentGateway index: ' . $e->getMessage());
            return redirect()->back()->with('error', 'An error occurred while retrieving payment gateways.');
        } catch (Exception $e) {
            Log::error('General error in PaymentGateway index: ' . $e->getMessage());
            return redirect()->back()->with('error', 'An unexpected error occurred.');
        }
    }

    /**
     * Show the form for creating a new payment gateway.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        try {
            return view('admin.payment-gateways.create');
        } catch (Exception $e) {
            Log::error('General error in PaymentGateway create: ' . $e->getMessage());
            return redirect()->back()->with('error', 'An unexpected error occurred.');
        }
    }

    /**
     * Store a newly created payment gateway in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:payment_gateways',
            'api_key' => 'nullable|string',
            'api_secret' => 'nullable|string',
            'is_active' => 'boolean',
            'config' => 'nullable|array',
        ]);

        try {
            PaymentGateway::create($request->all());
            return redirect()->route('admin.payment-gateways.index')->with('success', 'Payment gateway created successfully.');
        } catch (QueryException $e) {
            Log::error('Database error in PaymentGateway store: ' . $e->getMessage());
            return redirect()->back()->with('error', 'An error occurred while creating the payment gateway.');
        } catch (Exception $e) {
            Log::error('General error in PaymentGateway store: ' . $e->getMessage());
            return redirect()->back()->with('error', 'An unexpected error occurred.');
        }
    }

    /**
     * Show the form for editing the specified payment gateway.
     *
     * @param  \App\Models\PaymentGateway  $paymentGateway
     * @return \Illuminate\Http\Response
     */
    public function edit(PaymentGateway $paymentGateway)
    {
        try {
            return view('admin.payment-gateways.edit', compact('paymentGateway'));
        } catch (Exception $e) {
            Log::error('General error in PaymentGateway edit: ' . $e->getMessage());
            return redirect()->back()->with('error', 'An unexpected error occurred.');
        }
    }

    /**
     * Update the specified payment gateway in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PaymentGateway  $paymentGateway
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PaymentGateway $paymentGateway)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255', Rule::unique('payment_gateways')->ignore($paymentGateway->id)],
            'api_key' => 'nullable|string',
            'api_secret' => 'nullable|string',
            'is_active' => 'boolean',
            'config' => 'nullable|array',
        ]);

        try {
            $paymentGateway->update($request->all());
            return redirect()->route('admin.payment-gateways.index')->with('success', 'Payment gateway updated successfully.');
        } catch (QueryException $e) {
            Log::error('Database error in PaymentGateway update: ' . $e->getMessage());
            return redirect()->back()->with('error', 'An error occurred while updating the payment gateway.');
        } catch (Exception $e) {
            Log::error('General error in PaymentGateway update: ' . $e->getMessage());
            return redirect()->back()->with('error', 'An unexpected error occurred.');
        }
    }

    /**
     * Remove the specified payment gateway from storage.
     *
     * @param  \App\Models\PaymentGateway  $paymentGateway
     * @return \Illuminate\Http\Response
     */
    public function destroy(PaymentGateway $paymentGateway)
    {
        try {
            $paymentGateway->delete();
            return redirect()->route('admin.payment-gateways.index')->with('success', 'Payment gateway deleted successfully.');
        } catch (QueryException $e) {
            Log::error('Database error in PaymentGateway destroy: ' . $e->getMessage());
            return redirect()->back()->with('error', 'An error occurred while deleting the payment gateway.');
        } catch (Exception $e) {
            Log::error('General error in PaymentGateway destroy: ' . $e->getMessage());
            return redirect()->back()->with('error', 'An unexpected error occurred.');
        }
    }
}