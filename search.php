<?php

include('connectdb.php');
$search_text = $_REQUEST[ 'sText' ];
$query       = "select visual.* from (SELECT *,concat(first_name,' ',last_name) as name FROM `people`) as visual where name like '%" . $search_text . "%'";
$sql_query   = mysql_query($query);
if ( mysql_num_rows($sql_query) ) {
    while ( $each_row = mysql_fetch_assoc($sql_query) ) {
        $string                    = $each_row[ 'name' ];
        $is_found                  = false;
        $prepare_new_search_string = "";
        $final_rear                = "";

        while ( $string != "" ) {
//            $style               = "border:1px solid #6ebf6e; background-color:#c9d8c9; border-radius: 8px;";
            $style               = "color: #F17501;";
            $search_result_array = search_highlight_text($string, $search_text, $style);
            if ( $search_result_array[ 'is_found' ] ) {
                $is_found   = true;
                $prepare_new_search_string .= $search_result_array[ 'front_string' ] . $search_result_array[ 'highlight_text' ];
                $string     = $search_result_array[ 'rear_string' ];
                $final_rear = $string;
            }
            else if ( !$search_result_array[ 'is_found' ] ) {
                $string = "";
            }
        }
        if ( $is_found ) {
            echo $prepare_new_search_string . $final_rear;
        }
        else {
            echo $string;
        }
        echo "<br />";
    }
}
else {
    echo "Not Found!";
}

function search_highlight_text($string, $search_text, $style = "border:1px solid #e8d443; background-color:#FAFFB6; border-radius: 8px;") {
    $strpos = stripos($string, $search_text);
    $strlen = strlen($search_text);
    if ( gettype($strpos) == "integer" ) {
        $make_new_string     = substr($string, $strpos, $strlen);
        $search_front_string = ($strpos == 0) ? '' : substr($string, 0, $strpos);
        $search_rear_string  = substr($string, ($strpos + $strlen));
        $make_highlight      = "";
//        for ( $i = 0; $i < $strlen; $i++ ) {
//            $make_highlight.="<span style='" . $style . "'>" . $make_new_string[ $i ] . "</span>";
//        }
        $make_highlight      = "<span style='" . $style . "'>" . $make_new_string . "</span>";

        $return_array[ 'is_found' ]                = true;
        $return_array[ 'highlight_text' ]          = $make_highlight;
        $return_array[ 'highlight_with_all_text' ] = $search_front_string . $make_highlight . $search_rear_string;
        $return_array[ 'front_string' ]            = $search_front_string;
        $return_array[ 'rear_string' ]             = $search_rear_string;
    }
    else {
        $return_array[ 'is_found' ] = false;
    }
    return $return_array;
}

?>
