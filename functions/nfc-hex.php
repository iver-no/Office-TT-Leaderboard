<?php
    function nfchex($input){

        $input = dechex($input);

        $output[0] = substr($input,0,2) ;
        $output[1] = substr($input,2,2);
        $output[2] = substr($input,4,2);
        $output[3] = substr($input,6);

        $output = array_reverse($output);

        $string_output = $output[0].$output[1].$output[2].$output[3];

        return $string_output;
    }

?>  