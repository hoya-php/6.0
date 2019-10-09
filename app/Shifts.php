<?php


namespace App;

use App\Calendar;
use App\Members;
use Illuminate\Database\Eloquent\Model;

class Shifts extends Model
{
    private $html;

    public function show_shifter_tag($h, $m, $y, $lad, $Hol_list, $Mem_list){

        $this -> html = $h;
        $year = $y;
        $month = $m;
        $last_day = $lad;

        //$user_count = members::where('group_id',1)->count();

        foreach($Mem_list as $mem) {

            $user_number = 1;
            $day = 1;
            $holiday_boolean = false ;

            $this->html .= "<tr>";

            //個人ユーザ用リンク
            $this->html .= "<td><a href=members/{$mem->id}>{$mem -> name}</a></td>";

            while ($day <= $last_day) {

                // 各週を描画するHTMLソースを生成する
                if ($day <= 0 || $day > $last_day) {
                // 先月・来月の日付の場合
                //$this->html .= "<td>&nbsp;</td>";
                } else {

                    //休日と一致しているか確認している

                    $target = date("Y-m-d", mktime(0, 0, 0, $month, $day, $year));
                    foreach($Hol_list as $val) {

                        if ($val->day == $target) {
                        //休日時判定
                        $holiday_boolean = true;
                        break;
                        }

                    }

                    if($holiday_boolean == true){

                        $this->html .= "<td bgcolor=\"#FFFDBD\">";

                        $holiday_boolean = false;

                    }else{

                        $this->html .= "<td>";
                    }


                }

                $day_drop  = 'day_'.$day;

                $column_name = $mem -> $day_drop;

                $this->html .= $column_name;

                //ここまでで一日終わり　日付進める＆メンバID進める
                $this->html .= "</td>";
                $day++;
                $user_number++;

            }

            $this->html .= "</tr>";

        }

        return $this -> html;

    }

    public function shifts_create($y, $m, $id, $lad, $Hol_list, $Mem_list, $shi_list){
        //必要情報の取得

        $shift_count =  $shi_list -> count();
        $member_count = $Mem_list -> count();

        $member_list = [];
        $shift_list =[];
        $i = 0;

        foreach($shi_list as $shi){

            $shift_list[$i] = $shi -> name;
            $i++;

        }

        //シフトの自動作成
        for($day = 1; $day <= $lad; $day++){

            //すでに抽選されたメンバを除外
            $no_day_member = "除外";

            for($shift_number = 0; $shift_number < $shift_count; $shift_number++){

                //1日あたりシフト必要人数 -> $shift_ranker
                //シフト選択メンバID格納 -> day_member_select_id
                //シフト選択メンバ変数格納 -> day_member_select_level

                $shift_ranker = 1;
                $day_member_select_id = -1;
                $day_member_select_level = 1000000;

                while(0.1 < $shift_ranker){

                    for($member_number = 0; $member_number < $member_count; $member_number++){

                        //メンバシフトカウント格納
                        //当日までのすべてのカウント　-> all_shifts_count
                        //当日までの該当シフトのカウント -> selected_shifts_count

                        $all_shifts_count = 0;
                        $selected_shifts_count = 0;

                        for($day_count = 1; $day_count < $day; $day_count++) {
                            //シフトをカウントする
                            if(isset($member_list[$member_number][$day_count])){

                                if ($member_list[$member_number][$day_count] != ""){

                                    $all_shifts_count++;

                                } elseif ($member_list[$member_number][$day_count] == $shift_list[$shift_number]) {

                                    $selected_shifts_count++;

                                }
                            }
                        }


                        //メンバ抽選用変数を作成　-> arrangement_shift
                        //各ユーザごとに比較する(最小値を記録したメンバを記録)
                        //カウント変数を引用し、抽選結果を平均化する

                        $arrangement_shift = (($all_shifts_count * 1.2) ** 2) + (($selected_shifts_count * 0.9) ** 2) + (rand(2, 99) / 100);

                        //日別除外リスト確認
                        if(strpos($no_day_member,"<".$member_number.">") === false){

                            if($arrangement_shift < $day_member_select_level){

                                $day_member_select_level = $arrangement_shift;

                                $day_member_select_id = $member_number;

                            }
                        }
                    }

                    if($day_member_select_id == -1 || $day_member_select_level == 1000000){

                        break;

                    }else{

                        $member_list[$day_member_select_id][$day] = $shift_list[$shift_number];

                        //当選メンバ除外
                        $no_day_member .= "<".$day_member_select_id.">";

                        //抽選用変数リセット
                        $day_member_select_id = -1;
                        $day_member_select_level = 1000000;

                        //シフト必要人数まで while loop
                        $shift_ranker += -1;

                        //除外リスト確認
                        //\Debugbar::info($no_day_member);

                    }

                }


            }

        }

        return $member_list;

    }

}
