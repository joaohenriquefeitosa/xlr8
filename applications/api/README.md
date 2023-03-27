# API Hotels

[Consume some json sources and order the hotels by proximity or price.]

## Sources:
```
To add or remove some source, you just need to go in the App\Services\HotelService.php,
and make the change inside the array $sources.
```
<br>

## getNearbyHotels:
```
To get the nearby hotels, you just need to use the method getNearbyHotels inside the 
App\Services\HotelService.php file.

Parameters:
string|float $latitude
string|float $longitude
string $longitude (proximity or pricepernight)
```
<br>

### Test Endpoint
```
[Retrieves the hotels.]
```
#### Request
```
* URL: http://localhost:8082/api/get-hotels?latitude=value&longitude=value&orderby=value
* Parameters 
    * Required (latitude, longitude)
    * Optional (orderby)
* Method: GET
* Headers:
    * Accept: application/json
    * Content-Type: application/json
```
#### Response
```
[Retrieves the hotels.]
```
#### Example
```
Request
GET | http://localhost:8082/api/get-hotels?latitude=51.50000000&longitude=0.10000000

Response: 
{
	"data": [
		{
			"name": "City Inn Express London Fields",
			"latitude": 51.5389962,
			"longitude": -0.056316499999979897,
			"price": 134.5,
			"distance": 11.652516349951686
		},
		{
			"name": "Central Park Hotel",
			"latitude": 51.5647845,
			"longitude": -0.1018521,
			"price": 53.8,
			"distance": 15.7111671856925
		},
    ...
    ]
}
```
