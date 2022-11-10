<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Staff;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class StaffApiController extends Controller
{
    /**
     * Display a list of all staff.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Specify fields to return - password omitted.
        return Staff::all('id', 'email', 'first_name', 'last_name', 'status', 'squad', 'start_date', 'notes');
    }

    /**
     * Store a newly created Staff record.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate fields in request
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:6|max:255',
            'first_name' => 'required|min:2|max:255',
            'last_name' => 'required|min:2|max:255',
            'status' => 'required|in:Active,Inactive',
            'squad' => 'required|in:squad1,squad2,squad3,squad4,squad5,NA',
            'start_date' => 'required|date_format:Y-m-d',
            'notes' => 'max:1000',
    
        ]);

        // Handle errors 
        if($validator->fails()) {
            
            /// Build error message array for response
            $error_messages = [];
            foreach($validator->errors()->getMessages() as $validationErrors) {
                $error_messages[] = $validationErrors[0];
            }
            
            return response()->json(['status' => 'error',
                                     'message' => $error_messages],   
                                     400);
        }

        // Check for duplicate email address
        if(Staff::where('email', $request->email)->exists()) {

            return response()->json(['status' => 'error',
                                     'message' => 'email already exists'],   
                                     400);        
        }
       
        // Instantiate Staff object, values properties from HTTP request, then save
        $staff = new Staff();
        $staff->email = $request->email;
        $staff->password = Hash::make($request->password);
        $staff->first_name = $request->first_name;
        $staff->last_name = $request->last_name;
        $staff->status = $request->status;
        $staff->squad = $request->squad;
        $staff->start_date = $request->start_date;
        $staff->notes = $request->notes;
        $staff->save();

        return response()->json(['status' => 'success', 
                                 'message' => 'staff record created successfully'], 
                                 201);
    }

    /**
     * Display a specific staff record.
     *
     * @param  \App\Models\Staff
     * @return \Illuminate\Http\Response
     */
    public function show(Staff $staff)
    {
        unset($staff->password); // We don't want to include password in response       
        $staff->full_name = $staff->first_name.' '.$staff->last_name; // Add full name in response
        return $staff;
    }    


    /**
     * Update a specific staff record.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Staff
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Staff $staff)
    {
        // Validate fields in request
        $validator = Validator::make($request->all(), [
            'email' => 'email',
            'password' => 'min:6|max:255',
            'first_name' => 'min:2|max:255',
            'last_name' => 'min:2|max:255',
            'status' => 'in:Active,Inactive',
            'squad' => 'in:squad1,squad2,squad3,squad4,squad5,NA',
            'start_date' => 'date_format:Y-m-d',
            'notes' => 'max:1000',

        ]);

        // Some errors 
        if($validator->fails()) {
            
            /// Build error message array for response
            $error_messages = [];
            foreach($validator->errors()->getMessages() as $validationErrors) {
                $error_messages[] = $validationErrors[0];
            }
            
            return response()->json(['status' => 'error',
                                    'message' => $error_messages],   
                                    400);
        }
        
        // Check if another user has the same email submitted in update call
        $sameEmailExists = Staff::select("id")
                            ->where("email", $request->email)
                            ->where("id", '<>', $staff->id)
                            ->exists();

        if($sameEmailExists) 
        {
            return response()->json(['status' => 'error',
                                     'message' => 'email already exists'],   
                                     400);        
        }
        
        $staff->update($request->all());

        return response()->json(['status' => 'success', 
                                 'message' => 'staff record updated successfully'], 
                                 200);
    }

    /**
     * Delete a specific staff record.
     *
     * @param  \App\Models\Staff
     * @return \Illuminate\Http\Response
     */
    public function delete(Staff $staff)
    {
        $staff->delete();        
        return response()->json(['status' => 'success', 
                                 'message' => 'staff record deleted successfully'], 
                                  200);
    }
}
