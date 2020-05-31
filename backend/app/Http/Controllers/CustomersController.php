<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
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
        return User::where('user_type', '=', 0)->get();
    }

    /**
     * Get customer
     * @param $id
     * @return Response
     *
     */
    public function show($id)
    {

    }
    /**
     * Create customer
     * @param Request $request
     * @return Response
     *
     */
    public function store(Request $request)
    {

    }
    /**
     * Update customer
     * @param Request $request
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $customers = User::findOrFail($id);
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
        $customers = User::findOrFail($id);
        $customers->delete();

        return 204;
    }

}
