<?php
    function getIPAddress() {  
	    //whether ip is from the share internet  
         if(!empty($_SERVER['HTTP_CLIENT_IP'])) {  
                    $ip = $_SERVER['HTTP_CLIENT_IP'];  
            }  
        //whether ip is from the proxy  
        elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {  
                    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];  
         }  
        //whether ip is from the remote address  
        else{  
                 $ip = $_SERVER['REMOTE_ADDR'];  
         }  
         return $ip;  
    }  
    $ip = getIPAddress();
    
    $Visitor = new App\Visitor();
    $visitor = $Visitor::where('ip_address',$ip)->get();
    
    if(count($visitor)>0){
        ;
    }else{
        $Visitor::create(['ip_address'=>$ip]);
    }
    $total_visitors = Count($Visitor::all());
?>