<?php
/**
 * Created by PhpStorm.
 * User: Mv
 * Date: 10/12/2017
 * Time: 10:39 PM
 */
class functions
{
    public function get_data_from_url( $url ){
        $options = array(
            CURLOPT_RETURNTRANSFER => true,     // return web page
            CURLOPT_HEADER         => false,    // don't return headers
            CURLOPT_FOLLOWLOCATION => true,     // follow redirects
            CURLOPT_ENCODING       => "",       // handle all encodings
            CURLOPT_USERAGENT      => "Mv",     // who am i
            CURLOPT_AUTOREFERER    => true,     // set referer on redirect
            CURLOPT_CONNECTTIMEOUT => 120,      // timeout on connect
            CURLOPT_TIMEOUT        => 120,      // timeout on response
            CURLOPT_MAXREDIRS      => 10,       // stop after 10 redirects
            CURLOPT_SSL_VERIFYPEER => false     // Disabled SSL Cert checks
        );

        $ch      = curl_init( $url );
        curl_setopt_array( $ch, $options );
        $content = curl_exec( $ch );
        $err     = curl_errno( $ch );
        $errmsg  = curl_error( $ch );
        $header  = curl_getinfo( $ch );
        curl_close( $ch );

        $header['errno']   = $err;
        $header['errmsg']  = $errmsg;
        $header['content'] = $content;
        return $content;
    }

    /**
    Header_parameter is to ignore first row of table
     */
    public function Get_Array_From_DOM_Object($array,$no_of_columns,$header_parameter){
        $i = 0;
        $j = 0;
        $z = 1;
        foreach($array as $items)
        {
            if($z > $header_parameter){
                $data_array[$j][] = trim($items->textContent);
                $i = $i + 1;
                $j = $i % $no_of_columns == 0 ? $j + 1 : $j;
            }
            $z++;

        }
        return $data_array;
    }

    public function bse_nse($url,$no_of_columns,$header_parameter){
        $row_data=$this->get_data_from_url($url);
        $dom = new DOMDocument;
        libxml_use_internal_errors(true);
        $dom->loadHTML($row_data);
        $Header = $dom->getElementsByTagName('th');
        $Detail = $dom->getElementsByTagName('td');
        $getArrayFromTable=$this->Get_Array_From_DOM_Object($Detail,$no_of_columns,$header_parameter);
        return $getArrayFromTable;

    }

}
