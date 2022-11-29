<?php

namespace App\Helpers;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\RoleHasPermissions;
use App\User;
use App\Notifiction;
use DateTime;
use Illuminate\Support\Facades\Auth;

class Helper {

    public static function auth(){
        $users = User::with('role')
        ->whereHas('role',function ($q){
            return $q->where('id','=',\Auth::user()->role_id);
        })
        ->orderBy('id','desc')->first();
        if ($users){
           return $users->role->name;
       }
       return null;
   }


   public static function checkPermission($permissionName=0){

    if(Auth::user()->user_type == "superadmin"){
        return true;
    }else{
        $user = Auth::user();

        $role = RoleHasPermissions::with('permission')
        ->where('role_id','=',$user->role_id)
        ->get();

        $user_permission=[];
        foreach ($role as $key=>$value){
            foreach ($value->permission as $perm){
                if(in_array($perm->name, $permissionName)){
                    $user_permission[]=$perm;    
                }                            
            }
        }

        if(empty($user_permission)){
            return false;
        }else{
            return true;
        }

    }
    return false;

}

public static function CheckAllUserNotifiction($user_id) {
    // dd("in");
    // $notifiction_all = Notifiction::where('user_id',Auth::id())->first();
    $notifiction_all = User::where('id',Auth::id())->first();
    $current = date("m-Y",strtotime($notifiction_all->passport_expiry_date));
    $first        = date('m-Y');
    $second       = date('m-Y', strtotime('+1 month'));
    $throw = date("m-Y", strtotime('+2 month'));
    if($first >= $current){
        return $month = "Your Passport will be expired in 1 months. Renow it!";
    } else if($second >= $current){
        return $month = "Your Passport will be expired in 2 months. Renow it!";
    } else if($throw >= $current){
        return $month = "Your Passport will be expired in 3 months. Renow it!";
    } else{
        return $month = "";
    }
    // dd($$notifiction_all);
    // return $month;
}


}
