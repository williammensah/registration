<?php

namespace App\Http\Controllers;

use App\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Middleware\CustomerMiddleware;
use Illuminate\Support\Facades\Log;

class TestController extends Controller
{
  public function __construct()
  {
    $this->middleware(CustomerMiddleware::class,['only' => ['store']]);
  }
  public function index()
  {
    try {
      $getAllCustomers = Customer::orderBy('created_at', 'desc')->get();
      if ($getAllCustomers->isNotEmpty()) {
        return response()->json([
          'responseCode' => 200,
          'responseMessage' => 'successfully fetched customer informations',
          'data' => $getAllCustomers
        ], 200);
      } else {
        return response()->json([
          'responseCode' => 200,
          'responseMessage' => 'There are no customer data',
          'data' => []
        ], 200);
      }
    } catch (\Throwable $e) {
      \Log::error('An error occured in customers', [$e->getMessage()]);
      return response()->json([
        'responseCode' => 500,
        'responseMessage' => 'an error occurred saving customer details',
        'data' => []
      ], 500);
    }
  }
  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */ 
  public function store(Request $request)
  {

    try {
      $customerDetails  = [
        'surname' => $request->surname,
        'othername' => $request->othername,
        'sex' => request()->get('sex'),
        'email' => $request->email,
        'mobile' => $request->mobile,
        'city' => $request->city,
        'region' => $request->region
      ];
      $storeCustomerDetails = Customer::Create($customerDetails);
      if ($storeCustomerDetails) {
        return response()->json([
          'responseCode' => 200,
          'responseMessage' => 'successfully saved customer details',
          'data' => $storeCustomerDetails
        ], 200);
      }
    } catch (\Exception $e) {
      \Log::error('An error occured in customers', [$e->getMessage()]);
      return response()->json([
        'responseCode' => 500,
        'responseMessage' => 'an error occurred saving customer details',
        'data' => $storeCustomerDetails
      ], 500);
    }
  }

  public function show($id)
  {
    try {
      $findCustomer = Customer::find($id);
      if ($findCustomer) {
        return response()->json([
          'responseCode' => 200,
          'responseMessage' => 'successfully saved customer details',
          'data' => $findCustomer
        ], 200);
      }
    } catch (\Exception $e) {

      \Log::error('An error occured in saving customer', [$e->getMessage()]);
      return response()->json([
        'responseCode' => 500,
        'responseMessage' => 'an error occurred saving customer details',
        'data' => $findCustomer
      ], 500);
    }
  }

  public function update(Request $request, $id)
  {
    try {

      $updateCustomer = Customer::where('id', $id)
        ->update($request->all());
      if ($updateCustomer) {
        return response()->json([
          'responseCode' => 200,
          'responseMessage' => 'successfully updated  customer detail',
          'data' => $updateCustomer
        ], 200);
      }
    } catch (\Exception $e) {
      \Log::error('An error occured in updating customer Details', [$e->getMessage()]);
      return response()->json([
        'responseCode' => 500,
        'responseMessage' => 'an error occurred updating customer details',
        'data' => []
      ], 500);
    }
  }


  public function delete($id)
  {
    try {
      $deleteCustomer = Customer::find($id);
       Log::info('customer info to be deleted',[$deleteCustomer]);
      $deleteCustomer->delete();
      if ($deleteCustomer) {
        return response()->json([
          'responseCode' => 204,
          'responseMessage' => 'successfully updated  customer detail',
          'data' => []
        ], 204);
      }
    } catch (\Throwable $e) {
      \Log::error('An error occured in delete customer Details', [$e->getMessage()]);
      return response()->json([
        'responseCode' => 500,
        'responseMessage' => 'an error occurred updating customer details',
        'data' => []
      ], 500);
    }
  }
}
