<?php

namespace App\Helpers;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Session;
use URL;
use DateTime;
use DateTimeZone;

class Helper {

    public static function res($data, $msg, $code) {
        $response = [
            'status' => $code == 200 ? true : false,
            'code' => $code,
            'msg' => $msg,
            'version' => '1.0.0',
            'data' => $data
        ];
        return response()->json($response, $code);
    }

    public static function success($data = [], $msg = 'Success', $code = 200) {
        return Helper::res($data, $msg, $code);
    }

    public static function fail($data = [], $msg = "Some thing wen't wrong!", $code = 203) {
        return Helper::res($data, $msg, $code);
    }

    public static function error_parse($msg) {
        foreach ($msg->toArray() as $key => $value) {
            foreach ($value as $ekey => $evalue) {
                return $evalue;
            }
        }
    }

    public static function active($param = "") {
        return Request::path() == $param ? 'active open' : '';
    }



    public static function Status($data) {
        if ($data->status == config('const.statusActive')) {
            return '<span class="kt-badge  kt-badge--success kt-badge--inline kt-badge--pill">Active</span>';
        }else if($data->status == config('const.statusInActive')){
            return '<span class="kt-badge  kt-badge--yellow kt-badge--inline kt-badge--pill " style="color: #ffffff;
                    background: #ffb822 !important;">InActive</span>';
        }else if($data->status == config('const.statusPending')){
            return '<span class="kt-badge kt-badge--brand kt-badge--inline kt-badge--pill">Pending</span>';
        }else if($data->status == config('const.statusLocked')){
            return '<span class="kt-badge  kt-badge--danger kt-badge--inline kt-badge--pill">Locked</span>';
        } else {
            return '<button type="button" class="btn red btn-xs pointerhide cursornone">---</button>';
        }
    }


    public static function Action($editLink = '', $deleteID = '', $viewLink = '',$recoverylink='') {
        if ($editLink)
            $edit = '<a href="' . $editLink . '" class="btn btn-sm btn-clean btn-icon btn-icon-md"> <i class="la la-edit"></i></a>';
        else
            $edit = '';

        if ($deleteID)
            $delete = '<a onclick="deleteValueSet(' . $deleteID . ')"  class="btn btn-sm btn-clean btn-icon btn-icon-md"  data-toggle="modal" data-target="#kt_modal_1" >  <i class="la la-trash"></i></a>';
        else
            $delete = '';

        if ($viewLink)
            $view = '<a href="' . $viewLink . '" class="btn btn-sm btn-clean btn-icon btn-icon-md"><i class="la la-eye"></i></a>';
        else
            $view = '';

        if ($recoverylink)
            $recovery = '<a onclick="deleteValueSet(' . $deleteID . ')"  class="btn btn-sm btn-clean btn-icon btn-icon-md"  data-toggle="modal" data-target="#kt_modal_2" >  <i class="la la-eraser"></i></a>';
        else
            $recovery = '';

        return $view . '' . $edit . '' . $delete . '' .$recovery .'';
    }


    /* For Store Path Start */
    public static function profileFileUploadPath(){
       return storage_path('app/public/profilepic/');
    }
    /* For Store Path End */

    /* For Display Image */
    public static function displayProfilePath(){
        return URL::to('/').'/storage/profilepic/';
    }

    public static function getRoleArray(){
        return array(
                "1" => "Admin",
                "2" => "User",
            );
    }

    public static function getTimezone(){
        if(Session::get('customTimeZone') && Session::get('customTimeZone') !='')
            return Session::get('customTimeZone');
        else
            return "Asia/Kolkata";
    }

    public static function displayDateTimeConvertedWithFormat($date,$format=''){
        if(!$format){
            $format= config('const.displayDateTimeFormatForAll');
        }

        $dt = new DateTime($date);
        $tz = new DateTimeZone(Helper::getTimezone()); // or whatever zone you're after

        $dt->setTimezone($tz);
        return $dt->format($format);
    }

    public static function getStatusArray(){
        return array(
            'active'=>"Active",
            'inactive'=>"InActive",
            'locked'=>"locked",
        );
    }

    public  static function generateRandomString($length =20) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}
