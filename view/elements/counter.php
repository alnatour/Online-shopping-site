<?php

    $handle = fopen(ROOT_PATH . '/view/elements/counter.txt', "r");
    if(!$handle)
    {
        echo "could not open the file";
    }
    else 
    {
        $counter=(int )fread($handle,20);
        fclose($handle);
        $counter++;
       // echo"Number of visitors to home page so far: ". $counter . "" ;
        $handle= fopen(ROOT_PATH . '/view/elements/counter.txt', "w" ) ;
        fwrite($handle,$counter) ;
        fclose ($handle) ;
    }
