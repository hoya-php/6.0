<?php


namespace App;


use App\Shifts;
use Illuminate\Database\Eloquent\Model;
use App\Calendar;

class Members extends Model
{
    public function shifts_update($y, $m, $id, $member_list){

        $members = members::where('group_id', $id) -> get();
        $member_number = 0;

        \Debugbar::info($members);

        //Member全員
        foreach ($members as $mem) {

            //Member一人ずつ
            for($day = 1; $day <= 31; $day++){

                $day_drop  = 'day_'.$day;

                if(isset($member_list[$member_number][$day])){

                    $mem -> $day_drop = $member_list[$member_number][$day];

                }else{

                    $mem -> $day_drop = "";

                }
            }

            $mem->save();
            $member_number++;

        }
    }

}
