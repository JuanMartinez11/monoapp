<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customers;
use Validator;
use Hash;

class CustomersController extends Controller
{

    /**
     * Get all customers
     * @return Response
     *
     */

    public function index(){
        return Customers::all();
    }

    /**
     * Get customer
     * @param $id
     * @return Response
     *
     */
    public function show($id)
    {
        return Customers::find($id);
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
            'phone' => 'required|min:10|unique:customers',
            'email' => 'required|email|unique:customers',
            'password' => 'required|min:8']
        );

        //Response fails
        if ($validator->fails()) {
            $response['response'] = $validator->messages();
        }else{
            //Create customer

            $response = Customers::create([
                'name'     => $request->name,
                'email'    => $request->email,
                'phone'    => $request->phone,
                'password' => Hash::make($request->password),
            ]);
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
        $customers = Customers::findOrFail($id);
        $customers->update($request->all());

        return $customers;
    }
    /**
     * Delete customer
     * @param Request $request, $id
     * @return Response
     */
    public function delete(Request $request, $id)
    {
        $customers = Customers::findOrFail($id);
        $customers->delete();

        return 204;
    }

}
