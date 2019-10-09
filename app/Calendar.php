<?php

namespace App;

use App\Shifts;
use App\Members;

class Calendar
{
    private $html;

    public function showCalendarTag($m, $y,$Hol_list)
    {
        $year = $y;
        $month = $m;
        if ($year == null) {
            // システム日付を取得する。
            $year = date("Y");
            $month = date("m");
        }
        $firstWeekDay = date("w", mktime(0, 0, 0, $month, 1, $year)); // 1日の曜日(0:日曜日、6:土曜日)
        $lastDay = date("t", mktime(0, 0, 0, $month, 1, $year)); // 指定した月の最終日
        // 日曜日からカレンダーを表示するため前月の余った日付をループの初期値にする
        $day = 1 - $firstWeekDay;


        // 前月
        $prev = strtotime('-1 month', mktime(0, 0, 0, $month, 1, $year));
        $prev_year = date("Y", $prev);
        $prev_month = date("m", $prev);
        // 翌月
        $next = strtotime('+1 month', mktime(0, 0, 0, $month, 1, $year));
        $next_year = date("Y", $next);
        $next_month = date("m", $next);


        $this->html = <<< EOS

<h1 style="text-align:center">
<a class="btn btn-primary" href="/?year={$prev_year}&month={$prev_month}" role="button">&lt;前月</a>
{$year}年{$month}月
<a class="btn btn-primary" href="/?year={$next_year}&month={$next_month}" role="button">翌月&gt;</a>
</h1>
<div class="scroll calendar">
<table class="table table-bordered tbl-r07" align="center">
<tr>
EOS;
        // style="text-align:center"
        $j = 1 - $firstWeekDay;
        $weekday_count = 0;
        $weekday_array = ["日", "月", "火", "水", "木", "金", "土"];
        //<th scope="col">日</th>
        $this->html .= "<th scope=\"col\">名前</th>";

        while ($day <= $lastDay) {

            $holiday_boolean = false;

            if ($day<= 0 || $day > $lastDay) {
                // 先月・来月の日付の場合
                //$this->html .= "<td>&nbsp;</td>";
            } else {

                $target = date("Y-m-d", mktime(0, 0, 0, $month, $day, $year));

                foreach($Hol_list as $val) {

                    if ($val->day == $target) {
                        //休日時判定
                        $holiday_boolean = true;
                        break;
                    }

                }

                if($holiday_boolean == true){

                    $this->html .= "<th scope=\"col\"><div class=\"week-target\">${day} / ${weekday_array[$weekday_count]}</div></th>";

                    $holiday_boolean = false;

                }else{

                    $this->html .= "<th scope=\"col\">${day} / ${weekday_array[$weekday_count]}</th>";
                }

            };

            $day++;

            if (6 <= $weekday_count) {

                $weekday_count = 0;

            } else {

                $weekday_count += 1;

            }
        };

        $this->html .= "</tr>";

        //末日シメ

        //userデータ作成
        $Hol_list =  Holiday::select('day') -> get();
        $group_id = 1;

        $Mem_list= Members::where('group_id',$group_id) -> where('year',$year) -> where('month',$month) -> select('id','name','type','day_1','day_2','day_3','day_4','day_5','day_6','day_7', 'day_8','day_9','day_10','day_11','day_12','day_13','day_14','day_15','day_16','day_17','day_18','day_19','day_20','day_21','day_22','day_23','day_24', 'day_25','day_26','day_27','day_28','day_29','day_30','day_31') -> get();

        $shi = new \App\Shifts();

        $tag = $shi->show_shifter_tag($this->html,$month, $year, $lastDay,$Hol_list,$Mem_list);

        $this->html = $tag;

        $this->html .= '</table>';

        return $this->html .= '</div>';
    }

}


