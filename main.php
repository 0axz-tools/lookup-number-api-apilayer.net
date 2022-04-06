<?php
$nama_file = readline("Masukan file : ");
$file = fopen("valid.txt","w");  
$file2 = fopen("not valid.txt","w"); 
// set API Access Key
$access_key = 'apikey'; // apikey
// set phone number
//$phone_number = '14158586273';
if (file_exists($nama_file)) {
    $fh = fopen($nama_file, "r");
    while(!feof($fh)){
        $line = fgets($fh);
        if($line === null)break;
        $string = trim(preg_replace('/\s\s+/', ' ', $line));
        $sate = '61'. $string;
        // Initialize CURL:
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'http://apilayer.net/api/validate?access_key='. $access_key .'&number='. $sate); 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch). PHP_EOL;
     //  var_dump(json_decode($output, true)); 
        $validationResult = json_decode($output, true);      
        if ($validationResult['valid']) {
            echo ' Phone number is valid => '.$sate.'|'. $validationResult["carrier"] . PHP_EOL;
           // echo $sate. " Phone number is valid". PHP_EOL;
                 $hasil = ' Phone number is valid => '.$sate.'|'. $validationResult["carrier"] . PHP_EOL;
                 fwrite($file,$hasil);               
                 
        } 
        
        else {
            echo $sate. " Phone number is not valid". PHP_EOL;
                
                 
        }
        
    }
   
        


fclose($fh); 
fclose($file);
}else {
    echo "File tidak di temukan";
}
