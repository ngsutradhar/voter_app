<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /* weetg wqtlkwjiot oquw4thoqw touqwehtou */
    public function index($orgId)
    {
        //
        $result = DB::select("Select customers.id,
        customers.customer_category_id,
        customer_categories.customer_category_name,
        customers.customer_name,
        customers.address,
        customers.city,
        customers.district,
        customers.pin,
        customers.whatsapp_number,
        customers.contact_number,
        customers.email_id,
        customers.state_id,
        customers.organisation_id
        FROM customers
        inner join customer_categories ON customer_categories.id = customers.customer_category_id
        where customers.organisation_id='$orgId' order by customers.id desc");
        return response()->json(['success'=>1,'data'=> $result], 200,[],JSON_NUMERIC_CHECK);
    }
    public function get_customer_by_id($orgId,$id)
    {
        //
        $result = DB::select("Select customers.id,
        customers.customer_category_id,
        customer_categories.customer_category_name,
        customers.customer_name,
        customers.address,
        customers.city,
        customers.district,
        customers.pin,
        customers.whatsapp_number,
        customers.contact_number,
        customers.email_id,
        customers.state_id,
        customers.organisation_id
        FROM customers
        inner join customer_categories ON customer_categories.id = customers.customer_category_id
        where customers.organisation_id='$orgId'and customers.id='$id'");
        return response()->json(['success'=>1,'data'=> $result], 200,[],JSON_NUMERIC_CHECK);
    }
    public function update_customer(Request $request)
     {
        DB::beginTransaction();

        try{
            $customer= Customer::findOrFail($request->input('customerId'));
            $customer ->customer_name = $request->input('customerName');
            $customer ->customer_category_id = $request->input('customerCategoryId');
            $customer ->address = $request->input('address');
            $customer ->city = $request->input('city');
            $customer ->district = $request->input('district');
            $customer ->pin = $request->input('pin');
            $customer ->whatsapp_number = $request->input('whatsappNumber');
            $customer ->contact_number = $request->input('contactNumber');
            $customer ->email_id = $request->input('emailId');
            $customer ->state_id = $request->input('stateId');
            $customer ->organisation_id = $request->input('organisationId');

          $customer->save();
          DB::commit();
        }
        catch(\Exception $e){
            DB::rollBack();
          return response()->json(['success'=>0,'exception'=>$e->getMessage()], 500);
            //return $this->errorResponse($e->getMessage());
        }
        return response()->json(['success'=>1,'data'=>$customer], 200,[],JSON_NUMERIC_CHECK);
     }
     public function save_customer(Request $request)
     {
        DB::beginTransaction();

        try{

            $customer= new Customer();

            $customer ->customer_name = $request->input('customerName');
            $customer ->customer_category_id = $request->input('customerCategoryId');
            $customer ->address = $request->input('address');
            $customer ->city = $request->input('city');
            $customer ->district = $request->input('district');
            $customer ->pin = $request->input('pin');
            $customer ->whatsapp_number = $request->input('whatsappNumber');
            $customer ->contact_number = $request->input('contactNumber');
            $customer ->email_id = $request->input('emailId');
            $customer ->state_id = $request->input('stateId');
            $customer ->organisation_id = $request->input('organisationId');

          $customer->save();
          DB::commit();
        }
        catch(\Exception $e){
            DB::rollBack();
          return response()->json(['success'=>0,'exception'=>$e->getMessage()], 500);
            //return $this->errorResponse($e->getMessage());
        }
        return response()->json(['success'=>1,'data'=>$customer], 200,[],JSON_NUMERIC_CHECK);
     }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCustomerRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCustomerRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCustomerRequest  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCustomerRequest $request, Customer $customer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        //
    }
}
