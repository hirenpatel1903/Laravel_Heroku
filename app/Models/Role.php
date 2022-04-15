<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Role extends Model
{
    use HasFactory;

    protected $table = 'role';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name',
    ];

    public static function getRoles(){
        if(Auth::user()->role_id==config('const.roleSubAdmin')){
            return Role::where('id','!=',1)->get();
        }else{
            return Role::all();
        }
    }
}
