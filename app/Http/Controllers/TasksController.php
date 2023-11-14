<?php

namespace App\Http\Controllers;

use App\Models\Tasks;
use Illuminate\Http\Request;
use DB;

class TasksController extends Controller
{
    public function duplicateValidation($method = 'create', $name, $id = null) 
    {

        if ($method == 'create') {
            $data = DB::table('tasks')->where(['name' => $name])->get();
            $data = json_decode($data, true);
            if (count($data) > 0) {
                return true;
            } else {
                return false;
            }
        } else {
            $data = DB::table('tasks')->where(['name' => $name])->where('id', '!=' , $id)->get();
            $data = json_decode($data, true);
            if (count($data) > 0) {
                return true;
            } else {
                return false;
            }
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
        // Form validation
        if ($request->name == null) {
            return response()->json(array('success' => false, 'message' => 'Task field is required.'), 200);
        }

        if ($this->duplicateValidation('create', $request->name)) {
            return response()->json(array('success' => false, 'message' => 'Duplicate Task.'), 200);
        }
        

        //  Store data in database
        $data = new Tasks();
        $data->name  = $request->name;
        
        if ($data->save()) {
            return response()->json(array('success' => true, 'message' => 'Successfully Added.', 'last_insert_id' => $data->id), 201);
        } else {
            return response()->json(array('success' => false, 'message' => 'Failed to Add.', 'last_insert_id' => null), 500);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tasks  $tasks
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        //  Show data in database
        if ($request->keyword != null) {
            $data = DB::table('tasks')->where('name','LIKE',"%{$request->keyword}%")->get();
        } else {
            $data = DB::table('tasks')->get();
        }
        $data = json_decode($data, true);
        return response()->json($data, 200);
    }

    public function showOne($id)
    {
        //  Show data in database
        $data = DB::table('tasks')->where(['id' => $id])->get();
        $data = json_decode($data, true);
        if (count($data) > 0) {
            $data = $data[0];
        } else {
            $data = array("message" => "No result found.");
        }

        return response()->json($data, 200);
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tasks  $tasks
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
        // Form validation
        if ($request->name == null) {
            return response()->json(array('success' => false, 'message' => 'Task field is required.'), 200);
        }
        if ($this->duplicateValidation('update', $request->name, $id)) {
            return response()->json(array('success' => false, 'message' => 'Duplicate Task.'), 200);
        }

        //  Update data in database
        $data = Tasks::find($id);
        $data->name = $request->name;

        if ($data->update()) {
            return response()->json(array('success' => true, 'message' => 'Successfully Updated.', 'affected_id' => $id), 201);
        } else {
            return response()->json(array('success' => false, 'message' => 'Failed to Update.', 'affected_id' => null), 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tasks  $tasks
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //  Delete data in database
        $data = Tasks::find($id);

        if ($data->delete()) {
            return response()->json(array('success' => true, 'message' => 'Successfully Deleted.', 'affected_id' => $id), 201);
        } else {
            return response()->json(array('success' => false, 'message' => 'Failed to Delete.', 'affected_id' => null), 500);
        }

    }
}
