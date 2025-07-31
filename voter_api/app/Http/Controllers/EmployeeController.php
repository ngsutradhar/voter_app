<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function update_order_complete($id)
    {
         $result = DB::select("update order_details set is_completed=1,status_id=3,
                     completed_date=CURDATE(), completed_time=CURRENT_TIMESTAMP
                    where id='$id'");

         $result = DB::select("select * from order_details where id='$id'");
                    return response()->json(['success'=>1,'data'=> $result], 200,[],JSON_NUMERIC_CHECK);
    }
    public function get_employee_order_service_completed($orgId)
    {
        $result = DB::select("select customers.customer_name,
                    customers.address,
                    customers.city, 
                    customers.district,
                    customers.pin,
                    customers.whatsapp_number,
                    customers.contact_number ,
                    order_masters.id as order_masters_id,
                    order_masters.order_no,
                    order_masters.order_date,
                    employees.employee_name,
                    employees.id,
                    work_types.work_type_name, 
                    work_types.rate,
                    order_details.id as order_details_id,
                    order_details.working_date, 
                    order_details.completed_date,
                    order_details.completed_time,
                    DATEDIFF(order_details.completed_date,order_details.working_date) as completed_days
                    from order_masters
                    inner join order_details on order_details.order_master_id = order_masters.id
                    inner join customers ON customers.id = order_masters.customer_id
                    inner join employees ON employees.id = order_details.employee_id
                    inner join work_types ON work_types.id = order_details.work_type_id
                    where order_details.status_id=3 and order_details.is_completed=1 and order_masters.organisation_id='$orgId'
                    order by order_details.completed_date desc");
        return response()->json(['success'=>1,'data'=> $result], 200,[],JSON_NUMERIC_CHECK);
    }
    public function get_employee_order_service_pending($orgId,$id)
    {
        $result = DB::select("select customers.customer_name,
                    customers.address,
                    customers.city, 
                    customers.district,
                    customers.pin,
                    customers.whatsapp_number,
                    customers.contact_number ,
                    order_masters.id as order_masters_id,
                    order_masters.order_no,
                    order_masters.order_date,
                    employees.employee_name,
                    employees.id,
                    work_types.work_type_name, 
                    work_types.rate,
                    order_details.id as order_details_id,
                    order_details.working_date, 
                    DATEDIFF(order_details.working_date,CURDATE()) as due_date,
                    order_details.working_time
                    from order_masters
                    inner join order_details on order_details.order_master_id = order_masters.id
                    inner join customers ON customers.id = order_masters.customer_id
                    inner join employees ON employees.id = order_details.employee_id
                    inner join work_types ON work_types.id = order_details.work_type_id
                    where order_details.status_id=1 and order_details.is_completed=0 and employees.id='$id' and order_masters.organisation_id='$orgId'
                    order by order_masters.order_date");
        return response()->json(['success'=>1,'data'=> $result], 200,[],JSON_NUMERIC_CHECK);
    }
    public function get_employee_organisation_by_id($id)
    {
        $result = DB::select("Select employees.id,
                        employees.employee_category_id,
                        employees.employee_name,
                        employees.guardian_name,
                        employees.dob, employees.doj,
                        employees.sex, employees.address,
                        employees.city,
                        employees.district, employees.pin,
                        employees.whatsapp_number,
                        employees.contact_number, 
                        employees.email_id, 
                        employees.qualification,
                        organisations.organisation_name, 
                        organisations.address as organisationAddress,
                        organisations.pin as organisationPin, 
                        organisations.contact_number as organisationContact,
                        organisations.email_id as organisationEmail,
                        organisation_id FROM employees
                        inner join organisations ON organisations.id = employees.organisation_id
                        where employees.id='$id'");
        return response()->json(['success'=>1,'data'=> $result], 200,[],JSON_NUMERIC_CHECK);
    }
    public function index($orgId)
    {
        //
        $result = DB::select("select employees.id,employee_categories.employee_category_name,
        employees.employee_name,
        employees.guardian_name, 
        employees.dob, 
        employees.state_id,
        employees.district,
        employees.employee_category_id,
        employees.doj, 
        employees.sex,
        employees.address,
        employees.city, 
        employees.whatsapp_number,
        employees.contact_number,
        employees.email_id,
        employees.qualification, 
        employees.pin,
        employees.organisation_id,
        organisations.organisation_name,
        organisations.address as org_address, 
        organisations.city as org_city,
        organisations.district as org_district,
        organisations.pin as org_pin, 
        organisations.contact_number org_contact_number,
        organisations.whatsapp_number as org_whatsapp_number,
        organisations.email_id as org_email_id
        FROM employees 
        inner join employee_categories ON employee_categories.id = employees.employee_category_id
        inner join organisations ON organisations.id = employees.organisation_id
        where employees.organisation_id='$orgId' order by employees.id desc");
        return response()->json(['success'=>1,'data'=> $result], 200,[],JSON_NUMERIC_CHECK);
    }
    public function get_employee_by_id($orgId,$id)
    {
        //
        $result = DB::select("select employees.id,employee_categories.employee_category_name,
        employees.employee_name,
        employees.guardian_name, 
        employees.dob, 
        employees.doj, 
        employees.sex,
        employees.address,
        employees.city,
        employees.district, 
        employees.state_id, 
        employees.whatsapp_number,
        employees.contact_number,
        employees.email_id,
        employees.qualification, 
        employees.pin,
        employees.organisation_id
        FROM employees 
        inner join employee_categories ON employee_categories.id = employees.employee_category_id
        where employees.organisation_id='$orgId' and employees.id='$id'");
        return response()->json(['success'=>1,'data'=> $result], 200,[],JSON_NUMERIC_CHECK);
    }
    public function update_employee(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'employeenName' => 'required|max:255',
            'emailId' => "required|max:255",
            'address' => "required|max:255",     
        ]);
        DB::beginTransaction();

       try{    
           // if any record is failed then whole entry will be rolled back
           //try portion execute the commands and catch execute when error.
            $employee= Employee::findOrFail($request->input('employeeId'));
            $employee ->employee_name = $request->input('employeeName');
            $employee ->employee_category_id = $request->input('employeeCategoryId');
            $employee->guardian_name = $request->input('guardianName');
            $employee->dob = $request->input('dob');
            $employee->doj = $request->input('doj');
            $employee->sex = $request->input('sex');
            $employee->address = $request->input('address');
            $employee->city = $request->input('city');
            $employee->district= $request->input('district');
            $employee->pin= $request->input('pin');
            $employee->contact_number= $request->input('contactNumber');
            $employee->whatsapp_number= $request->input('whatsappNumber');
            $employee->email_id= $request->input('emailId');
            $employee->qualification= $request->input('qualification');
            $employee->state_id= $request->input('stateId');
            $employee->organisation_id= $request->input('organisationId');
           
           
            $employee->save();
            DB::commit();

        }catch(\Exception $e){
            DB::rollBack();
          return response()->json(['success'=>0,'exception'=>$e->getMessage()], 500);
            //return $this->errorResponse($e->getMessage());
        }
        return response()->json(['success'=>1,'data'=>$employee], 200,[],JSON_NUMERIC_CHECK);

    }
    public function save_employee(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'employeenName' => 'required|max:255',
            'emailId' => "required|max:255",
            'address' => "required|max:255",     
        ]);
        DB::beginTransaction();

       try{    
           // if any record is failed then whole entry will be rolled back
           //try portion execute the commands and catch execute when error.
            $employee= new Employee();
           
            $employee ->employee_name = $request->input('employeeName');
            $employee ->employee_category_id = $request->input('employeeCategoryId');
            $employee->guardian_name = $request->input('guardianName');
            $employee->dob = $request->input('dob');
            $employee->doj = $request->input('doj');
            $employee->sex = $request->input('sex');
            $employee->address = $request->input('address');
            $employee->city = $request->input('city');
            $employee->district= $request->input('district');
            $employee->pin= $request->input('pin');
            $employee->contact_number= $request->input('contactNumber');
            $employee->whatsapp_number= $request->input('whatsappNumber');
            $employee->email_id= $request->input('emailId');
            $employee->qualification= $request->input('qualification');
            $employee->state_id= $request->input('stateId');
            $employee->organisation_id= $request->input('organisationId');
           
           
            $employee->save();
            DB::commit();

        }catch(\Exception $e){
            DB::rollBack();
          return response()->json(['success'=>0,'exception'=>$e->getMessage()], 500);
            //return $this->errorResponse($e->getMessage());
        }
        return response()->json(['success'=>1,'data'=>$employee], 200,[],JSON_NUMERIC_CHECK);

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
     * @param  \App\Http\Requests\StoreEmployeeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEmployeeRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateEmployeeRequest  $request
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEmployeeRequest $request, Employee $employee)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        //
    }
}
