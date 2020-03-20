<?php

namespace App\Http\Controllers\Api;
use App\Location;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Location as LocationResource;

class LocationController extends Controller
{
	public function index()
	{
        return ['status' => TRUE , 'message' => 'All locations in record!', 'data' => LocationResource::collection(Location::all())];
	}

	public function show(Request $request)
	{
		if (isset($request->id)) {
			
			$location = Location::find($request->id);

			return ['status' => TRUE , 'message' => 'Location found!', 'data' => new LocationResource($location)];
		}
		else {
			return ['status' => FALSE , 'message' => 'Location Not Found!'];
		}
	}

	public function create(Request $request)
	{
		if (isset($request->name)) {
			
			$exist = Location::where('name', $request->name)->first();

			if (isset($exist)) {
				return ['status' => FALSE , 'message' => 'Location already exists..'];
			}
			else {
				$location = Location::create($request->all());

				return ['status' => TRUE , 'message' => 'Location created successfully!', 'data' => new LocationResource($location)];				
			}
		}
		else {
			return ['status' => FALSE , 'message' => 'Parameters Missing..'];
		}
	}

	public function delete(Request $request)
	{
		if (isset($request->id)) {
			
			$location = Location::find($request->id);
			
			$location->delete();

			return ['status' => TRUE , 'message' => 'Location deleted successfully!'];
		}
		else {
			return ['status' => FALSE , 'message' => 'Location Not Found!'];
		}
	}
}
