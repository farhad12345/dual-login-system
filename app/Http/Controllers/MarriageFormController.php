<?php

namespace App\Http\Controllers;

use App\Models\MarriageForm;
use Illuminate\Http\Request;

class MarriageFormController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'fathers_name' => 'required|string|max:255',
            'grandfathers_name' => 'required|string|max:255',
            'thing' => 'required|string|max:255',
            'village' => 'required|string|max:255',
            'event_date' => 'required|date',
            'today_date' => 'required|date',
            'city_of_occassion' => 'required|string|max:255',
            'hall' => 'required|string|max:255',
            'her_address' => 'required|string|max:255',
            'brides_fathers_name' => 'required|string|max:255',
            'her_village' => 'required|string|max:255',
        ]);

        MarriageForm::create($validatedData);

        return response()->json(['status'=>'success','message' => 'Form data saved successfully'], 201);
    }
    public function show()
    {
        // Retrieve all saved form data
        $formData = MarriageForm::all();

        // Return the data as a JSON response
        return response()->json([
            'success' => true,
            'data' => $formData,
        ], 200);
    }
}
