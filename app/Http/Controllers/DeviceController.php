<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Device;
use Validator;

class DeviceController extends Controller
{
    //
    function list($id = null)
    {
        return $id ? Device::find($id) : Device::all();
    }

    function add(Request $req)
    {
        $device = new Device;
        $device->name = $req->name;
        $device->member_id = $req->member_id;
        $result = $device->save();
        if ($result) {
            return ["Result" => "Device has been saved"];
        } else {
            return ["Result" => "Operation failed"];
        }
    }

    function update(Request $req)
    {
        $device = Device::find($req->id);
        $device->name = $req->name;
        $device->member_id = $req->member_id;
        $result = $device->save();
        if ($result) {
            return ["result" => "Data has been updated"];
        } else {
            return ["result" => "Update operation has been failed"];
        }

    }
    function search($name)
    {
        return Device::where("name", "like", "%" . $name . "%")->get();
    }
    function delete($id)
    {
        $device = Device::find($id);
        $result = $device->delete();
        if ($result) {
            return ["result" => "Record has been deleted"];
        } else {
            return ["result" => "Delete operation has been failed"];
        }
    }

    function testData(Request $req)
    {
        $rules = array(
            "member_id" => "required | min:2 | max:4"
        );
        $validator = Validator::make($req->all(), $rules);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 401);
        } else {
            $device = new Device;
            $device->name = $req->name;
            $device->member_id = $req->member_id;
            $result = $device->save();
            if ($result) {
                return ["result" => "Data has been saved"];
            } else {
                return ["result" => "Saved operation has been failed"];
            }
        }
    }
}
