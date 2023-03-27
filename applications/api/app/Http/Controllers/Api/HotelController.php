<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\HotelFormRequest;
use App\Services\HotelService;
use Illuminate\Http\Request;

class HotelController extends Controller
{
    /**
     * Search for nearby hotels by latitude and longitude.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Services\HotelService  $hotelService
     * @return \Illuminate\Http\JsonResponse
     */
    public function search(HotelFormRequest $request, HotelService $hotelService)
    {
        $data = $request->validated();

        $latitude = $data['latitude'];
        $longitude = $data['longitude'];
        $orderBy = $data['orderby'] ?? 'proximity';

        $hotels = $hotelService->getNearbyHotels($latitude, $longitude, $orderBy);

        return response()->json([
            'data' => $hotels,
        ]);
    }
}
