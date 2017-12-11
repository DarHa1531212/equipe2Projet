<html>
 <head>
  <title>Test PHP</title>
 </head>
 <body>
 <?php 
     $url = 'facebook.com';
       
        
        $ch = curl_init(); 
        curl_setopt($ch, CURLOPT_URL, $url); 
        curl_setopt($ch, CURLOPT_HEADER, 0); 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 300);
        curl_setopt($ch, CURLOPT_TIMEOUT, 300);
        $data = curl_exec($ch); 
        file_put_contents("text.txt", $data);
        curl_close($ch); 
        echo $data;     
     
     ?>
 </body>
</html>