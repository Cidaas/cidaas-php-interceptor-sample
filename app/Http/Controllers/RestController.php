<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RestController extends Controller
{
    public function MyProfile(Request $request){
         $result = [
            "firstName" => "john",
           "lastName" => "wiliams",
           "role" => ["USER"]
         ];

         return $result;
    }

    public function EmployeeList(Request $request){
        $result = [];

        $result[0]=[
            "firstName" => "john",
            "lastName" => "wiliams",
            "role" => ["USER"]
        ];

        $result[1]=[
            "firstName" => "vimal",
            "lastName" => "prakash",
            "role" => ["ADMIN","USER"]
        ];
        return $result;
    }

    public function HolidayList(Request $request){
        $result = [];

        $result[0]=[
            "date" => "1-1-2017",
            "reason" => "New year"
        ];

        $result[1]=[
            "date" => "25-3-2017",
            "reason" => "Good Friday"
        ];
        return $result;
    }

    public function LocalHolidayList(Request $request){
        $result = [];

        $result[0]=[
            "date" => "1-1-2017",
            "reason" => "New year"
        ];

        $result[1]=[
            "date" => "25-3-2017",
            "reason" => "Good Friday"
        ];
        return $result;
    }

    public function LeaveType(Request $request){
        $result = [];

        $result[0]=[
            "Type" => "Vacation Leave"
        ];

        $result[1]=[
            "Type" => "Sick Leave"
        ];
        return $result;
    }




}
