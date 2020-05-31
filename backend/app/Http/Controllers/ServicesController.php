<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Validator;
use App\Services;

class ServicesController extends Controller
{
    /**
     * Get all services
     * @return Response
     *
     */

    public function index(){
        return Services::all();
    }

    /**
     * Get service
     * @param $id
     * @return Response
     *
     */
    public function show($id)
    {
        return Services::find($id);
    }
    /**
     * Create service
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
                'description' => 'required|min:20',
                'price' => 'required'
            ]
        );

        //Response fails
        if ($validator->fails()) {
            $response['response'] = $validator->messages();
            return response()->json($response['response']);
        }else{
            //Create service
            $response = Services::create([
                'name'     => $request->name,
                'description'    => $request->description,
                'price'    => $request->price
            ]);
            return response()->json([
                'message' => 'Servicio creado satisfactoriamente'], 201);

        }
    }
    /**
     * Update service
     * @param Request $request
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $customers = Services::findOrFail($id);
        $customers->update($request->all());

        return $customers;
    }
    /**
     * Delete service
     * @param Request $request, $id
     * @return Response
     */
    public function delete(Request $request, $id)
    {
        $customers = Services::findOrFail($id);
        $customers->delete();

        return 204;
    }
}
