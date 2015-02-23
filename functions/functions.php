<?php

function convert_smart_quotes($string) {
    $search = array(chr(0xe2) . chr(0x80) . chr(0x98),
                    chr(0xe2) . chr(0x80) . chr(0x99),
                    chr(0xe2) . chr(0x80) . chr(0x9c),
                    chr(0xe2) . chr(0x80) . chr(0x9d),
                    chr(0xe2) . chr(0x80) . chr(0x93),
                    chr(0xe2) . chr(0x80) . chr(0x94),
                    chr(226) . chr(128) . chr(153),
                    'â€™','â€œ','â€<9d>','â€"','Â  ');

     $replace = array("'","'",'"','"',' - ',' - ',"'","'",'"','"',' - ',' ');

    return str_replace($search, $replace, $string);
}

function prettyJSON($json, $istr='  '){
        
        $result = '';
        for($p=$q=$i=0; isset($json[$p]); $p++)
        {
            $json[$p] == '"' && ($p>0?$json[$p-1]:'') != '\\' && $q=!$q;
            if(!$q && strchr(" \t\n\r", $json[$p])){continue;}
            if(strchr('}]', $json[$p]) && !$q && $i--)
            {
                strchr('{[', $json[$p-1]) || $result .= "\n".str_repeat($istr, $i);
            }
            $result .= $json[$p];
            if(strchr(',{[', $json[$p]) && !$q)
            {
                $i += strchr('{[', $json[$p])===FALSE?0:1;
                strchr('}]', $json[$p+1]) || $result .= "\n".str_repeat($istr, $i);
            }
        }
        return $result;
    }

?>