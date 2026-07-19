<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;

class UtilityController extends Controller
{
    /**
     * Fetch distance, duration and fares for all vehicle types.
     * Proxies the request to the external GoRide UK API.
     *
     * Route: GET /w-get-fares
     */
    public function DistanceAndDurationAll(Request $request)
    {
        try {

            $request->validate([
                'from_place' => 'required|string',
                'to_place'   => 'required|string',
                'pickup_date'   => ['required', 'date_format:Y-m-d H:i:s'],
                'dropoff_date'   => ['nullable'],
                'way_type'      => 'required|in:oneway,roundtrip',
            ]);

            $pickup = Carbon::parse($request->pickup_date);
            $now    = Carbon::now();

            if ($pickup->isToday() && $pickup->lessThan($now->copy()->addMinutes(90))) {
                return response()->json([
                    'status'  => false,
                    'message' => 'Pickup time must be at least 90 minutes from now for same-day bookings.',
                ], 422);
            }

            // Forward the Sanctum token from the incoming request
            $token = $request->bearerToken();

            // Proxy to the external GoRide API
            $apiUrl = env('API_URL') . '/w-get-fares';

            $payload = [
                'from_place'   => $request->from_place,
                'to_place'     => $request->to_place,
                'pickup_date'  => $request->pickup_date,
                'dropoff_date' => $request->dropoff_date,
                'way_type'     => $request->way_type,
            ];

            // if ($token) {
            //     $payload['sanctum_token'] = $token;
            // }

            $response = Http::withToken($token)
                ->acceptJson()
                ->get($apiUrl, $payload);

                // dd($response);

            return response()->json($response->json(), $response->status());

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'status'  => false,
                'message' => 'Validation failed.',
                'errors'  => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'status'  => false,
                'message' => 'An error occurred: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Notify driver and create a temporary job.
     * Proxies the request to the external GoRide UK API.
     *
     * Route: POST /w-book-notify-driver
     */
    public function BookNotifyDriver(Request $request)
    {
        try {
            // Forward the Sanctum token from the incoming request
            $token = $request->bearerToken();
            
            // Proxy to the external GoRide API
            $apiUrl = env('API_URL') . '/w-book-notify-driver';

            $payload = $request->all();
            // if ($token) {
            //     $payload['sanctum_token'] = $token;
            // }

            // Ensure pickup_date matches exactly 'Y-m-d H:i:s'
            if (isset($payload['pickup_date']) && !empty($payload['pickup_date'])) {
                try {
                    $payload['pickup_date'] = \Carbon\Carbon::parse($payload['pickup_date'])->format('Y-m-d H:i:s');
                } catch (\Exception $e) {
                    // fallback to original if parsing fails
                }
            }
            if (isset($payload['dropoff_date']) && !empty($payload['dropoff_date'])) {
                try {
                    $payload['dropoff_date'] = \Carbon\Carbon::parse($payload['dropoff_date'])->format('Y-m-d H:i:s');
                } catch (\Exception $e) {
                    // fallback
                }
            }

            $response = Http::withToken($token)
                ->acceptJson()
                ->post($apiUrl, $payload);

            return response()->json($response->json(), $response->status());

        } catch (\Exception $e) {
            return response()->json([
                'status'  => false,
                'message' => 'An error occurred: ' . $e->getMessage(),
            ], 500);
        }
    }
    /**
     * Finalize Booking API Proxy
     * Proxies the request to the external GoRide UK API.
     *
     * Route: POST /w-book-final
     */
    public function BookFinal(Request $request)
    {
        try {
            $token = $request->bearerToken();
            $apiUrl = env('API_URL') . '/book';

            $response = Http::withToken($token)
                ->acceptJson()
                ->post($apiUrl, $request->all());

            return response()->json($response->json(), $response->status());

        } catch (\Exception $e) {
            return response()->json([
                'status'  => false,
                'message' => 'An error occurred: ' . $e->getMessage(),
            ], 500);
        }
    }
    /**
     * Autocomplete location search
     * Proxies the request to the external GoRide UK API.
     *
     * Route: POST /w-get-location
     */
    public function GetLocation(Request $request)
    {
        try {
            $token = $request->bearerToken();
            $apiUrl = env('API_URL') . '/web-get-location';

            $response = Http::withToken($token)
                ->acceptJson()
                ->post($apiUrl, $request->all());

            return response()->json($response->json(), $response->status());

        } catch (\Exception $e) {
            return response()->json([
                'status'  => false,
                'message' => 'An error occurred: ' . $e->getMessage(),
            ], 500);
        }
    }
}
