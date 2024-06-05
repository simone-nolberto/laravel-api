<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Mail\NewLeadMessageMd;
use App\Models\Lead;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class LeadController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($data, [

            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required'

        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),

            ]);
        };

        $newLead = Lead::create($data);

        Mail::to('admin@boolpress.com')->send(new NewLeadMessageMd($newLead));

        return response()->json([
            'success' => true,
            'message' => 'Your message was received',

        ]);
    }
}
