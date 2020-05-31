<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
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
        return User::where('user_type', '=', 1)->get();
    }

    /**
     * Get customer
     * @param $id
     * @return Response
     *
     */
    public function show($id)
    {
        return User::find($id);
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
        $Staff = User::findOrFail($id);
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
        $Staff = User::findOrFail($id);
        $Staff->delete();

        return 204;
    }

}
