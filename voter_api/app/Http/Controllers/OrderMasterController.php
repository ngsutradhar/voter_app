<?php

namespace App\Http\Controllers;

use App\Models\OrderMaster;
use App\Models\OrderDetail;
use App\Models\CustomVoucher;
use App\Models\WorkType;
use App\Http\Requests\StoreOrderMasterRequest;
use App\Http\Requests\UpdateOrderMasterRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class OrderMasterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Http\Requests\StoreOrderMasterRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function get_employee_service_schedule_by_date_and_time($orgId,$date,$time)
    {
        $result = DB::select("select employees.id, employees.employee_name,
                        if(table1.working_date,table1.working_date,'-') as working_date,
                        if(table1.time1,table1.time1,'-') as time1,
                        if(table1.time2,table1.time2,'-') as time2,
                        if(table1.total_work ,table1.total_work,0) as total_work
                        from
                          (select order_details.employee_id,
                            employees.employee_name,
                            order_details.working_date,
                            min(order_details.working_time) as time1,
                            max(order_details.working_time) as time2,
                            count(*) as total_work
                            FROM order_masters
                            inner join order_details on order_details.order_master_id = order_masters.id
                            inner join employees ON employees.id = order_details.employee_id
                             where ((order_details.working_date not in ('$date')) or 
                             (order_details.working_date>=CURDATE()))
                            and order_details.working_time not in ('$time')
                            and employees.organisation_id='$orgId'
                             group by order_details.employee_id,employees.employee_name,
                            order_details.working_date order by count(*)) as table1
                            right outer join employees on table1.employee_id=employees.id
                             order by table1.total_work,table1.working_date");
        return response()->json(['success'=>1,'data'=> $result], 200,[],JSON_NUMERIC_CHECK);
    }
    public function get_employee_service_schedule_by_date($orgId,$date)
    {
        $result = DB::select("select employees.id, employees.employee_name,
                        if(table1.working_date,table1.working_date,'-') as working_date,
                        if(table1.time1,table1.time1,'-') as time1,
                        if(table1.time2,table1.time2,'-') as time2,
                        if(table1.total_work ,table1.total_work,0) as total_work
                        from
                          (select order_details.employee_id,
                            employees.employee_name,
                            order_details.working_date,
                            min(order_details.working_time) as time1,
                            max(order_details.working_time) as time2,
                            count(*) as total_work
                            FROM order_masters
                            inner join order_details on order_details.order_master_id = order_masters.id
                            inner join employees ON employees.id = order_details.employee_id
                             where ((order_details.working_date not in ('$date')) or 
                             (order_details.working_date>=CURDATE()))
                            and employees.organisation_id='$orgId'
                             group by order_details.employee_id,employees.employee_name,
                            order_details.working_date order by count(*)) as table1
                            right outer join employees on table1.employee_id=employees.id
                             order by table1.total_work,table1.working_date");
        return response()->json(['success'=>1,'data'=> $result], 200,[],JSON_NUMERIC_CHECK);
    }
    public function get_employee_service_schedule_by_id($orgId,$id)
    {
        $result = DB::select("select employees.id, employees.employee_name,
                        if(table1.working_date,table1.working_date,'-') as working_date,
                        if(table1.time1,table1.time1,'-') as time1,
                        if(table1.time2,table1.time2,'-') as time2,
                        if(table1.total_work ,table1.total_work,0) as total_work
                        from
                          (select order_details.employee_id,
                            employees.employee_name,
                            order_details.working_date,
                            min(order_details.working_time) as time1,
                            max(order_details.working_time) as time2,
                            count(*) as total_work
                            FROM order_masters
                            inner join order_details on order_details.order_master_id = order_masters.id
                            inner join employees ON employees.id = order_details.employee_id
                            where order_details.working_date>=CURDATE()
                            and employees.organisation_id='$orgId'
                             group by order_details.employee_id,employees.employee_name,
                            order_details.working_date order by count(*)) as table1
                            right outer join employees on table1.employee_id=employees.id
                            where employees.id='$id'
                            order by table1.total_work,table1.working_date");
        return response()->json(['success'=>1,'data'=> $result], 200,[],JSON_NUMERIC_CHECK);
    }
    public function get_employee_service_schedule($orgId)
    {
        $result = DB::select("select employees.id, employees.employee_name,
                        if(table1.working_date,table1.working_date,'-') as working_date,
                        if(table1.time1,table1.time1,'-') as time1,
                        if(table1.time2,table1.time2,'-') as time2,
                        if(table1.total_work ,table1.total_work,0) as total_work
                        from
                          (select order_details.employee_id,
                            employees.employee_name,
                            order_details.working_date,
                            min(order_details.working_time) as time1,
                            max(order_details.working_time) as time2,
                            count(*) as total_work
                            FROM order_masters
                            inner join order_details on order_details.order_master_id = order_masters.id
                            inner join employees ON employees.id = order_details.employee_id
                            where order_details.working_date>=CURDATE()
                            and employees.organisation_id='$orgId'
                             group by order_details.employee_id,employees.employee_name,
                            order_details.working_date order by count(*)) as table1
                            right outer join employees on table1.employee_id=employees.id
                            order by table1.total_work");
        return response()->json(['success'=>1,'data'=> $result], 200,[],JSON_NUMERIC_CHECK);
    }
    public function get_all_worktype($orgId)
    {
        $result = DB::select("select id, work_type_name,rate from work_types where organisation_id='$orgId'");

        return response()->json(['success'=>1,'data'=> $result], 200,[],JSON_NUMERIC_CHECK);
      
       
    }
    public function get_all_order($orgID)
    {
        $result = OrderMaster::
        join('order_details', 'order_details.order_master_id', '=', 'order_masters.id')
        ->join('customers', 'customers.id', '=', 'order_masters.customer_id')
        ->where('order_masters.organisation_id', '=', $orgID)
        ->orderBy('order_masters.id', 'desc')
        ->select('order_masters.id','customers.customer_name',
        'order_masters.order_date',DB::raw('sum(order_details.rate) as total_order')
        )
        -> groupBy('order_masters.id','customers.customer_name','order_masters.order_date')
        ->get();
        foreach ($result as $row) {
            $row->setAttribute('order_details', $this->get_order_details_by_id($row->id));
        } 
        return response()->json(['success'=>1,'data'=>$result], 200,[],JSON_NUMERIC_CHECK);
    }
    public function get_order_details_by_id($id){
        $result = OrderMaster::
        join('order_details', 'order_details.order_master_id', '=', 'order_masters.id')
        ->join('work_types', 'work_types.id', '=', 'order_details.work_type_id')
        ->where('order_masters.id', '=', $id)
        ->select('order_masters.id as order_master_id'
        ,'order_details.id as order_details_id'
        ,'order_details.working_date'
        ,'work_types.work_type_name'
        ,'order_details.rate')
        ->get();
        return $result;
    }
    public function get_fees_charge_details_by_id($id){
        $result = TransactionMaster::
        join('transaction_details', 'transaction_details.transaction_master_id', '=', 'transaction_masters.id')
        ->join('ledgers', 'ledgers.id', '=', 'transaction_details.ledger_id')
        ->where('student_course_registration_id', '=', $id)
        ->where('transaction_details.transaction_type_id', '=',2)
        ->select('student_course_registration_id'
        ,'transaction_masters.id'
        ,'transaction_masters.transaction_date'
        ,'transaction_masters.transaction_number'
        ,'ledgers.ledger_name'
        ,'transaction_details.amount')
        ->get();
        return $result;
    }
    public function save_order(Request $request)
    {
        $input=($request->json()->all());
        $input_order_master=(object)($input['orderMaster']);
        $input_order_details=($input['orderDetails']);

        $rules = array(
            'customerId' => 'required|exists:customers,id',
            'orderDate'=>["required","date_format:Y-m-d"],
            'orderNo'=>'orderNo'
        );
        //$validator = Validator::make($input['orderMaster'],$rules,"Invalid Input" );


        /* if ($validator->fails()) {
            return response()->json(['position'=>1,'success'=>0,'data'=>null,'error'=>$validator->messages()], 406,[],JSON_NUMERIC_CHECK);
        } */
       
          $entryDate=Carbon::now()->format('Y-m-d');
          DB::beginTransaction();
          try{
            $accounting_year = get_accounting_year($entryDate);
            $voucher="order";
            $customVoucher=CustomVoucher::where('voucher_name','=',$voucher)->where('accounting_year',"=",$accounting_year)->first();
            if($customVoucher) {
                //already exist
                $customVoucher->last_counter = $customVoucher->last_counter + 1;
                $customVoucher->save();
            }else{
                //fresh entry
                $customVoucher= new CustomVoucher();
                $customVoucher->voucher_name=$voucher;
                $customVoucher->accounting_year= $accounting_year;
                $customVoucher->last_counter=1;
                $customVoucher->delimiter='-';
                $customVoucher->prefix='ORD';
                $customVoucher->save();
            }
            //adding Zeros before number
            $counter = str_pad($customVoucher->last_counter,5,"0",STR_PAD_LEFT);
            //creating sale bill number
            $order_no = $customVoucher->prefix.'-'.$counter."-".$accounting_year;
           
            $order_master=new OrderMaster();
            $order_master ->customer_id =$input_order_master->customerId;
            $order_master ->service_type_id =$input_order_master->serviceTypeId;
            $order_master ->order_no = $order_no;
            $order_master ->order_date = $input_order_master->orderDate;
            $order_master ->order_description = $input_order_master->orderDescription;
            $order_master ->organisation_id = $input_order_master->organisationId;
            $order_master->save();
            $result_array['order_master']=$order_master;
            $order_details=array();
            foreach($input_order_details as $order_detail){
                $detail = (object)$order_detail;
                $td = new OrderDetail();
                $td->order_master_id = $order_master->id;
                $td->work_type_id = $detail->workTypeId;
                $td->working_date = $detail->workingDate;
                $td->working_time = $detail->workingTime;
                $td->employee_id = $detail->employeeId;
                $td->rate = $detail->rate;
                $td->save();
                $order_details[]=$td;
            }
            $result_array['order_details']=$order_details;
            DB::commit();
          }
          catch(\Exception $e){
            DB::rollBack();
            return response()->json(['success'=>0,'exception'=>$e->getMessage()], 500);
             //return $this->errorResponse($e->getMessage());
          }
          return response()->json(['success'=>1,'data'=>$result_array], 200,[],JSON_NUMERIC_CHECK);
    }
    public function update_order($id,Request $request)
    {
        $input=($request->json()->all());
        $input_order_master=(object)($input['orderMaster']);
        $input_order_details=($input['orderDetails']);

        $rules = array(
            'customerId' => 'required|exists:customers,id',
            'orderDate'=>["required","date_format:Y-m-d"],
            'orderNo'=>'orderNo'
        );
        //$validator = Validator::make($input['orderMaster'],$rules,"Invalid Input" );


        /* if ($validator->fails()) {
            return response()->json(['position'=>1,'success'=>0,'data'=>null,'error'=>$validator->messages()], 406,[],JSON_NUMERIC_CHECK);
        } */
        // ------ delete record ---------
        $ord_details=OrderDetail::where('order_master_id',$id)->delete();
        if(!$ord_details){
           return response()->json(['success'=>1,'data'=>'Sorry Data Not Deleted:'.$id], 200,[],JSON_NUMERIC_CHECK);
        }
          $entryDate=Carbon::now()->format('Y-m-d');
          DB::beginTransaction();
          try{
            $order_master=OrderMaster::findOrFail($id);
            $order_master ->customer_id =$input_order_master->customerId;
            $order_master ->order_date = $input_order_master->orderDate;
            $order_master ->order_description = $input_order_master->orderDescription;
            $order_master->save();
            $result_array['order_master']=$order_master;
            $order_details=array();
            foreach($input_order_details as $order_detail){
                $detail = (object)$order_detail;
                $td = new OrderDetail();
                $td->order_master_id = $order_master->id;
                $td->work_type_id = $detail->workTypeId;
                $td->working_date = $detail->workingDate;
                $td->rate = $detail->rate;
                $td->save();
                $order_details[]=$td;
            }
            $result_array['order_details']=$order_details;
            DB::commit();
          }
          catch(\Exception $e){
            DB::rollBack();
            return response()->json(['success'=>0,'exception'=>$e->getMessage()], 500);
             //return $this->errorResponse($e->getMessage());
          }
          return response()->json(['success'=>1,'data'=>$result_array], 200,[],JSON_NUMERIC_CHECK);
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\OrderMaster  $orderMaster
     * @return \Illuminate\Http\Response
     */
    public function show(OrderMaster $orderMaster)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\OrderMaster  $orderMaster
     * @return \Illuminate\Http\Response
     */
    public function edit(OrderMaster $orderMaster)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateOrderMasterRequest  $request
     * @param  \App\Models\OrderMaster  $orderMaster
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateOrderMasterRequest $request, OrderMaster $orderMaster)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OrderMaster  $orderMaster
     * @return \Illuminate\Http\Response
     */
    public function destroy(OrderMaster $orderMaster)
    {
        //
    }
}
