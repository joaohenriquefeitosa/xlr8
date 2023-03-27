<?php

namespace App\Services;

use stdClass;

class HotelService
{
    protected $sources = [
        'https://xlr8-interview-files.s3.eu-west-2.amazonaws.com/source_1.json',
        'https://xlr8-interview-files.s3.eu-west-2.amazonaws.com/source_2.json',
    ];

    /**
     * Return the hotels from sources ordering by price or proximity.
     *
     * @param string|float $latitude
     * @param string|float $longitude
     * @param string $longitude (proximity or pricepernight)
     */
    public function getNearbyHotels($latitude, $longitude, $orderBy = 'proximity')
    {
        $hotels = collect();

        foreach ($this->sources as $source) {
            $response = file_get_contents($source);

            $data = json_decode($response, true);

            foreach ($data['message'] as $hotel) {
                $hotelNew = new stdClass();
                $hotelNew->name = $hotel[0];
                $hotelNew->latitude = floatval($hotel[1]);
                $hotelNew->longitude = floatval($hotel[2]);
                $hotelNew->price = floatval($hotel[3]);
                $hotelNew->distance = $this->getDistance($latitude, $longitude, $hotelNew->latitude, $hotelNew->longitude);
                $hotels->push($hotelNew);
            }
        }

        if ($orderBy === 'pricepernight') {
            $hotels = $hotels->sortBy('price');
        } else {
            $hotels = $hotels->sortBy('distance');
        }

        return $hotels->values()->all();
    }

    protected function getDistance($lat1, $lon1, $lat2, $lon2)
    {
        $earthRadius = 6371;

        $dLat = deg2rad($lat2 - $lat1);
        $dLon = deg2rad($lon2 - $lon1);

        $a = sin($dLat / 2) * sin($dLat / 2) +
            cos(deg2rad($lat1)) * cos(deg2rad($lat2)) *
            sin($dLon / 2) * sin($dLon / 2);

        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

        return $earthRadius * $c;
    }
}
