<?php
/**
 * Created by PhpStorm.
 * User: Mv
 * Date: 10/12/2017
 * Time: 10:38 PM
 */
require 'functions.php';
/** Your BSE URL goes here...*/
$BSE_url = "http://www.bseindia.com/markets/publicIssues/BSEDemandSchedule_new.aspx?Scripcode=3523";
/** Your NSE URL goes here...*/
$NSE_url = "https://nseindia.com//products/content/equities/ipos/GICRE_curr_ipo_bid_details.htm";
$Number_Columns_in_BSE_table = 5;
$Number_Columns_in_NSE_table = 5;
$number_of_columns_in_table_heading_in_BSE_table = 3;
$number_of_columns_in_table_heading_in_NSE_table = 1;
$function_obj = new functions();
$BSE_Array = $function_obj->bse_nse($BSE_url, $Number_Columns_in_BSE_table, $number_of_columns_in_table_heading_in_BSE_table);
$NSE_Array = $function_obj->bse_nse($NSE_url, $Number_Columns_in_NSE_table, $number_of_columns_in_table_heading_in_NSE_table);
$count_BSE = count($BSE_Array);
$count_NSE = count($NSE_Array);
$header_array = $BSE_Array[0];


unset($BSE_Array[0]);

$BSE_2nd_column = array();
$NSE_2nd_column = array();
$BSE_3nd_column = array();
$NSE_3nd_column = array();
$BSE_4nd_column = array();
$NSE_4nd_column = array();
for ($i = 1; $i < $count_BSE; $i++) {
    if (is_numeric($BSE_Array[$i][0]) || $BSE_Array[$i][0] == '') {
        if(is_numeric(str_replace(',','',$BSE_Array[$i][2]))){
            $BSE_2nd_column[] = $BSE_Array[$i][2];
        }
        if(is_numeric(str_replace(',','',$BSE_Array[$i][3]))){
            $BSE_3nd_column[] = $BSE_Array[$i][3];
        }
        if(is_numeric(str_replace(',','',$BSE_Array[$i][4]))){
            $BSE_4nd_column[] = $BSE_Array[$i][4];
        }
    }
}
for ($i = 0; $i < $count_NSE; $i++) {
    if (is_numeric($NSE_Array[$i][0]) || $NSE_Array[$i][0] == '') {
        if(is_numeric(str_replace(',','',$NSE_Array[$i][2]))){
            $NSE_2nd_column[] = $NSE_Array[$i][2];
        }
        if(is_numeric(str_replace(',','',$NSE_Array[$i][3]))){
            $NSE_3nd_column[] = $NSE_Array[$i][3];
        }
        if(is_numeric(str_replace(',','',$NSE_Array[$i][4]))){
            $NSE_4nd_column[] = $NSE_Array[$i][4];
        }
    }
}

$sums_2nd = array();
$sums_3rd = array();
$sums_4th = array();
foreach (array_keys($NSE_2nd_column + $BSE_2nd_column) as $key) {
    $sums_2nd[] = (isset($NSE_2nd_column[$key]) ? str_replace(',','',$NSE_2nd_column[$key]) : 0) + (isset($BSE_2nd_column[$key]) ? str_replace(',','',$BSE_2nd_column[$key]) : 0);
}
foreach (array_keys($NSE_3nd_column + $BSE_3nd_column) as $key) {
    $sums_3rd[] = (isset($NSE_3nd_column[$key]) ? str_replace(',','',$NSE_3nd_column[$key]) : 0) + (isset($BSE_3nd_column[$key]) ? str_replace(',','',$BSE_3nd_column[$key]) : 0);
}
foreach (array_keys($NSE_4nd_column + $BSE_4nd_column) as $key) {
    $sums_4th[] = (isset($NSE_4nd_column[$key]) ? str_replace(',','',$NSE_4nd_column[$key]) : 0) + (isset($BSE_4nd_column[$key]) ? str_replace(',','',$BSE_4nd_column[$key]) : 0);
}

$res['sum_second_col']=$sums_2nd;
$res['bse_second_col']=$BSE_2nd_column;
$res['nse_second_col']=$NSE_2nd_column;
$res['sum_third_col']=$sums_3rd;
$res['bse_third_col']=$BSE_3nd_column;
$res['nse_third_col']=$NSE_3nd_column;
$res['sum_fourth_col']=$sums_4th;
$res['sum_fourth_col']=$sums_4th;
$res['bse_fourth_col']=$BSE_4nd_column;
$res['nse_fourth_col']=$NSE_4nd_column;
echo json_encode($res);
die;
?>


