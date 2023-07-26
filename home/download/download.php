<? 
session_start();
   	if (isset($_SESSION['userid'])) 
	{
			$userid = $_SESSION['userid'];
			$username = $_SESSION['username'];
			$usernick = $_SESSION['usernick'];
			$userlevel = $_SESSION['userlevel'];
	}

$table = "download"; 
$num = $_GET['num'];
$real_name = $_GET['real_name'];
$show_name = $_GET['show_name'];
$file_type = $_GET['file_type'];
?>
<?
	if(!$userid) {
		echo("
		<script>
	     window.alert('로그인 후 이용해 주세요.')
	     history.go(-1)
	   </script>
		");
		exit;
	}
    $file_path = "./data/".$real_name;

    if( file_exists($file_path) )
    { 
		   $fp = fopen($file_path,"rb"); 

           if( $file_type ) 
           { 
				Header("Content-type: application/x-msdownload"); 
                Header("Content-Length: ".filesize($file_path));     
                Header("Content-Disposition: attachment; filename=$show_name");   
                Header("Content-Transfer-Encoding: binary"); 
				Header("Content-Description: File Transfer"); 

                header("Expires: 0"); 
            } 
            else 
            { 
                if(eregi("(MSIE 5.0|MSIE 5.1|MSIE 5.5|MSIE 6.0)", $HTTP_USER_AGENT)) 
                { 
                    Header("Content-type: application/octet-stream"); 
                    Header("Content-Length: ".filesize($file_path));     
                    Header("Content-Disposition: attachment; filename=$show_name");   
                    Header("Content-Transfer-Encoding: binary");   
                    Header("Expires: 0");   
                 } 
                 else 
                 { 
                    Header("Content-type: file/unknown");     
                    Header("Content-Length: ".filesize($file_path)); 
                    Header("Content-Disposition: attachment; filename=$show_name"); 
                    Header("Content-Description: PHP3 Generated Data"); 
                    Header("Expires: 0"); 
                 } 
             } 

			if(!fpassthru($fp)) 
				fclose($fp); 
	}
?>

  
