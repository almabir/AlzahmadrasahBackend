<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use App\Models\DonationArea;
use App\Models\PaymentGateway; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\QueryException;
use Exception;
use App\Services\SSLCommerzService;
use Illuminate\Support\Str;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Auth;


class DonationController extends Controller
{
    protected $sslCommerzService;

    public function __construct(SSLCommerzService $sslCommerzService)
    {
        $this->sslCommerzService = $sslCommerzService;
    }

    public function initializePayment(Request $request)
    {
        try {
            // Validate request
            $request->validate([
                'fund' => 'required|exists:donationareas,id',
                'contact' => 'required',
                'amount' => 'required|numeric|min:1',
                'date' => 'required|date',
            ]);

            // Determine if contact is email or mobile
            $donorEmail = filter_var($request->contact, FILTER_VALIDATE_EMAIL) ? $request->contact : null;
            $donorMobile = $donorEmail ? null : $request->contact;

            // Generate a unique transaction ID
            $transactionId = Str::uuid();

            // Store donation details
            $donation = Donation::create([
                'donation_area_id' => $request->fund,
                'donor_email' => $donorEmail,
                'donor_mobile' => $donorMobile,
                'amount' => $request->amount,
                'payment_gateway' => 'SSLCommerz',
                'transaction_id' => $transactionId,
                'status' => 'pending',
            ]);

            // Prepare data for SSLCommerz
            $paymentData = [
                'tran_id' => $transactionId,
                'amount' => $request->amount,
                'currency' => 'BDT',
                'cus_name' => $donorEmail ?? $donorMobile,
                'cus_email' => $donorEmail,
                'cus_phone' => $donorMobile,
                'product_name' => "Donation for Fund ID: " . $request->fund,
                'ipn_url' => url('/api/payment/ipn') // Add IPN URL
            ];

            // Call SSLCommerz Service
            $response = $this->sslCommerzService->initializePayment($paymentData);

            if (!empty($response['GatewayPageURL'])) {
                return response()->json([
                    'success' => true,
                    'message' => 'Redirecting to payment gateway.',
                    'url' => $response['GatewayPageURL'],
                ]);
            } else {
                throw new Exception("Payment initialization failed.");
            }
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation error',
                'errors' => $e->errors(),
            ], 422);
        } catch (Exception $e) {
            // Log the error
            Log::error('Payment Initialization Error: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Something went wrong. Please try again later.',
            ], 500);
        }
    }


    public function paymentIPN(Request $request)
    {
        Log::info('SSLCommerz IPN Received:', $request->all());
    
        $transactionId = $request->input('tran_id');
        $paymentStatus = $request->input('status');
    
        $donation = Donation::where('transaction_id', $transactionId)->first();
    
        if (!$donation) {
            return response()->json(['message' => 'Transaction not found.'], 404);
        }
    
        if ($paymentStatus === 'VALID') {
            $donation->status = 'completed';
        } else {
            $donation->status = 'failed';
        }
    
        $donation->save();
    
        return response()->json(['message' => 'Payment status updated via IPN.', 'status' => $donation->status]);
    }
    

     public function create()
    {
        try {
            $donationAreas = DonationArea::all();
            $paymentGateways = PaymentGateway::all();
            return view('donations.create', compact('donationAreas', 'paymentGateways'));
        } catch (Exception $e) {
            Log::error('General error in Donation create: ' . $e->getMessage());
            return redirect()->back()->with('error', 'An unexpected error occurred.');
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'donation_area_id' => 'required|exists:donationareas,id',
            'donor_name' => 'nullable|string|max:255',
            'donor_email' => 'nullable|email|max:255',
            'donor_mobile' => 'nullable|string|max:20',
            'amount' => 'required|numeric|min:0.01',
            'payment_gateway' => 'required|string|max:255', // Payment gateway name
            'transaction_id' => 'nullable|string|max:255',
            'status' => 'nullable|in:pending,completed,failed',
        ]);

        try {
            $paymentGatewayName = $request->payment_gateway;

            // Retrieve the payment gateway configuration
            $paymentGateway = PaymentGateway::where('name', $paymentGatewayName)->where('is_active', true)->firstOrFail();

            // Now you have the $paymentGateway object, you can access its properties
            $apiKey = $paymentGateway->api_key;
            $apiSecret = $paymentGateway->api_secret;
            $config = $paymentGateway->config; // This is the JSON config as a PHP array.

            // Example: Using the retrieved configuration (replace with your actual payment logic)
            // Example using stripe
            if($paymentGatewayName === 'Stripe'){
                // use stripe.
                \Stripe\Stripe::setApiKey($apiSecret);
                $charge = \Stripe\Charge::create([
                    'amount' => $request->amount * 100,
                    'currency' => $config['currency'] ?? 'usd', //Get currency from config, or default to USD.
                    'description' => 'Donation',
                    'source' => $request->stripeToken, // Assuming you have a Stripe token from the frontend
                ]);

                Donation::create([
                    'donation_area_id' => $request->donation_area_id,
                    'donor_name' => $request->donor_name,
                    'donor_email' => $request->donor_email,
                    'donor_mobile' => $request->donor_mobile,
                    'amount' => $request->amount,
                    'payment_gateway' => $paymentGatewayName,
                    'transaction_id' => $charge->id,
                    'status' => 'completed',
                ]);
            } else {
                 // Example: Using the retrieved configuration (replace with your actual payment logic)
                 // Simulated successful payment
                Donation::create([
                    'donation_area_id' => $request->donation_area_id,
                    'donor_name' => $request->donor_name,
                    'donor_email' => $request->donor_email,
                    'donor_mobile' => $request->donor_mobile,
                    'amount' => $request->amount,
                    'payment_gateway' => $paymentGatewayName,
                    'transaction_id' => 'SIMULATED_' . uniqid(),
                    'status' => 'completed',
                ]);
            }

            return redirect()->route('donations.create')->with('success', 'Donation created successfully.');
        } catch (\Stripe\Exception\CardException $e){
            Log::error('Stripe error in Donation store: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Stripe error: ' . $e->getMessage());
        } catch (\Stripe\Exception\InvalidRequestException $e) {
            Log::error('Stripe error in Donation store: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Stripe error: ' . $e->getMessage());
        } catch (QueryException $e) {
            Log::error('Database error in Donation store: ' . $e->getMessage());
            return redirect()->back()->with('error', 'An error occurred while creating the donation.');
        } catch (Exception $e) {
            Log::error('General error in Donation store: ' . $e->getMessage());
            return redirect()->back()->with('error', 'An unexpected error occurred.');
        }
    }   

}