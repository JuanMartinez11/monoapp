<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Staff;
use Validator;
use Hash;
use Illuminate\Support\Facades\Mail;

class StaffController extends Controller
{
    /**
     * Get all Staff
     * @return Response
     *
     */

    public function index(){
        return Staff::all();
    }

    /**
     * Get customer
     * @param $id
     * @return Response
     *
     */
    public function show($id)
    {
        return Staff::find($id);
    }
    /**
     * Create customer
     * @param Request $request
     * @return Response
     *
     */
    public function store(Request $request)
    {
        //Validate data
        $response = array('response' => '', 'success'=>false);
        $validator = Validator::make($request->all(),  [
                'name' => 'required|min:2',
                'phone' => 'required|min:10|unique:staff',
                'email' => 'required|email|unique:staff',
                'industry' => 'required|min:2',
                'password' => 'required|min:8']
        );

        //Response fails
        if ($validator->fails()) {
            $response['response'] = $validator->messages();
        }else{
            //Create customer

            $response = Staff::create([
                'name'     => $request->name,
                'email'    => $request->email,
                'phone'    => $request->phone,
                'industry'    => $request->industry,
                'password' => Hash::make($request->password),
            ]);

            // email data
            $email_data = array(
                'name' => $response['name'],
                'email' => $response['email'],
            );

            // Send email register
            Mail::send('welcome_staff', $email_data, function ($message) use ($email_data) {
                $message->to($email_data['email'], $email_data['name'])
                    ->subject('Bienvenido a MonAPP')
                    ->from('juanbijose11@hotmail.com', 'MonAPP');
            });

        }
        return $response;
    }
    /**
     * Update customer
     * @param Request $request
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $Staff = Staff::findOrFail($id);
        $Staff->update($request->all());

        return $Staff;
    }
    /**
     * Delete customer
     * @param Request $request, $id
     * @return Response
     */
    public function delete(Request $request, $id)
    {
        $Staff = Staff::findOrFail($id);
        $Staff->delete();

        return 204;
    }

}
