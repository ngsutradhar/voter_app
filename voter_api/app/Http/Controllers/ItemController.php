<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\ItemToService;
use App\Models\Equipment;
use App\Http\Requests\StoreItemRequest;
use App\Http\Requests\UpdateItemRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
class ItemController extends Controller
{
    public function update_item(Request $request)
     {
        DB::beginTransaction();

        try{
            $item= Item::findOrFail($request->input('itemId'));
            $item ->item_name = $request->input('itemName');
            $item ->technical_name = $request->input('technicalName');
            $item ->item_description = $request->input('description');
            $item ->organisation_id = $request->input('organisationId');

            $item->save();
          DB::commit();
        }
        catch(\Exception $e){
            DB::rollBack();
          return response()->json(['success'=>0,'exception'=>$e->getMessage()], 500);
            //return $this->errorResponse($e->getMessage());
        }
        return response()->json(['success'=>1,'data'=>$item], 200,[],JSON_NUMERIC_CHECK);
     }
    public function save_item(Request $request)
     {
        DB::beginTransaction();

        try{

            $item= new Item();

            $item ->item_name = $request->input('itemName');
            $item ->technical_name = $request->input('technicalName');
            $item ->item_description = $request->input('description');
            $item ->organisation_id = $request->input('organisationId');

            $item->save();
          DB::commit();
        }
        catch(\Exception $e){
            DB::rollBack();
          return response()->json(['success'=>0,'exception'=>$e->getMessage()], 500);
            //return $this->errorResponse($e->getMessage());
        }
        return response()->json(['success'=>1,'data'=>$item], 200,[],JSON_NUMERIC_CHECK);
     }
     public function save_item_to_service(Request $request)
     {
        DB::beginTransaction();

        try{

            $item= new ItemToService();

            $item ->work_type_id = $request->input('workTypeId');
            $item ->item_id = $request->input('itemId');
            $item ->item_to_service_description = $request->input('description');
            $item ->organisation_id = $request->input('organisationId');

            $item->save();
          DB::commit();
        }
        catch(\Exception $e){
            DB::rollBack();
          return response()->json(['success'=>0,'exception'=>$e->getMessage()], 500);
            //return $this->errorResponse($e->getMessage());
        }
        return response()->json(['success'=>1,'data'=>$item], 200,[],JSON_NUMERIC_CHECK);
     }
     public function update_item_to_service(Request $request)
     {
        DB::beginTransaction();

        try{
            $item= ItemToService::findOrFail($request->input('itemToServiceId'));
            $item ->work_type_id = $request->input('workTypeId');
            $item ->item_id = $request->input('itemId');
            $item ->item_to_service_description = $request->input('description');
            $item ->organisation_id = $request->input('organisationId');

            $item->save();
          DB::commit();
        }
        catch(\Exception $e){
            DB::rollBack();
          return response()->json(['success'=>0,'exception'=>$e->getMessage()], 500);
            //return $this->errorResponse($e->getMessage());
        }
        return response()->json(['success'=>1,'data'=>$item], 200,[],JSON_NUMERIC_CHECK);
     }
     public function save_equipment(Request $request)
     {
        DB::beginTransaction();

        try{

            $item= new Equipment();

            $item ->equipment_name = $request->input('equipmentName');
            $item ->equipment_description = $request->input('description');
            $item ->organisation_id = $request->input('organisationId');

            $item->save();
          DB::commit();
        }
        catch(\Exception $e){
            DB::rollBack();
          return response()->json(['success'=>0,'exception'=>$e->getMessage()], 500);
            //return $this->errorResponse($e->getMessage());
        }
        return response()->json(['success'=>1,'data'=>$item], 200,[],JSON_NUMERIC_CHECK);
     }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($orgId)
    {
        //
        $result = DB::select("select  id, item_name, technical_name, item_description 
        from items 
        where organisation_id='$orgId'
        order by id desc");
        return response()->json(['success'=>1,'data'=> $result], 200,[],JSON_NUMERIC_CHECK);
    }
    public function get_all_work_types($orgId)
    {
        //
        $result = DB::select("Select id, work_type_name, rate FROM work_types
        where organisation_id='$orgId'
        order by work_type_name");
        return response()->json(['success'=>1,'data'=> $result], 200,[],JSON_NUMERIC_CHECK);
    }
    public function get_all_item_to_servce($orgId)
    {
       $result = DB::select("select item_to_services.id,item_to_services.work_type_id,item_to_services.item_id,
        items.item_name, items.technical_name,
        work_types.work_type_name,
        item_to_services.item_to_service_description,
        work_types.rate
        from item_to_services
        inner join items ON items.id = item_to_services.item_id
        inner join work_types ON work_types.id = item_to_services.work_type_id
        Where item_to_services.organisation_id='$orgId'
        order by item_to_services.id desc");
        return response()->json(['success'=>1,'data'=> $result], 200,[],JSON_NUMERIC_CHECK);
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
     * @param  \App\Http\Requests\StoreItemRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreItemRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function show(Item $item)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function edit(Item $item)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateItemRequest  $request
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateItemRequest $request, Item $item)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function destroy(Item $item)
    {
        //
    }
}
