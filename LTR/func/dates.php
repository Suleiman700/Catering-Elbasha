<?php


function dates($option){
    switch ($option) {
        case "today":
            return date("Y-m-d");
            break;
        case "today_only":
            return date("d");
            break;
        case "today_flipped":
            return date("d-m-Y");
            break;
        case "today_name_short":
            return substr(strtolower(date("l")), 0, 3);
            break;
        case "today_flipped_slash":
            return date("d/m/Y");
            break;
        case "yesterday":
            return date('Y-m-d',strtotime("-1 days"));
            break;
        case "month":
            return date("Y-m");
            break;
        case "month_flipped":
            return date("m/Y");
            break;
        case "last_month":
            return date('Y-m', strtotime("last month"));
            break;
        case "last_month_flipped":
            return date('m/Y', strtotime("last month"));
            break;
        case "next_month":
            return date('Y-m', strtotime("next month"));
            break;
        case "same_day_last_month":
            return date("Y-m-d", strtotime("-1 month", strtotime(dates(date("Y-m-d")))));
            break;
        case "year":
            return date("Y");
            break;
        default:
            return date("Y-m-d");
    }
}

//Return date/time based on timezone & DST
function timezone_date_hour($option, $timezone){
    $date = new DateTime("now", new DateTimeZone($timezone));
    $date_time_str = $date->format('d-m-Y H:i');
    $date_str = $date->format('d-m-Y');
    $time_str = $date->format('H:i');
    switch ($option) {
        case "date":
            return $date_str;
            break;
        case "hour":
            if (date('I', time()))
                return $time_str;
            else
                return $time_str;
                //return date( 'H:i', strtotime('-1 hour', strtotime($date_time_str)));
            break;
        case "date_hour":
            if (date('I', time()))
                return $date_time_str;
            else
                return $date_time_str;
                //return date('d-m-Y H:i', strtotime('-1 hour', strtotime($date_time_str)));
            break;
        default:
            return $date_time_str;
    }
}


?>