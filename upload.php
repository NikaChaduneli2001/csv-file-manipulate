<?php
if(isset($_FILES['file']['name']) ){  

   // file name
   $filename = $_FILES['file']['name'];  
   // Location
   $uploadlocation = 'upload/'.$filename;
   // get file extension
   $file_extension = pathinfo($uploadlocation, PATHINFO_EXTENSION);
   $file_extension = strtolower($file_extension);
   // Valid file extensions
   $valid_ext = 'csv';
   $response = 0;
    if($file_extension == 'csv'){
         // Upload file
         if (file_exists($uploadlocation)) {
           echo json_encode([
             'status'=>0
           ]);
         }else{
          if(move_uploaded_file($_FILES['file']['tmp_name'],$uploadlocation)){
            // if file upload then return 1.
            $response = 1;
            if($response ==1){
                readCsv($uploadlocation,$response);
              
              
            }
          }
         }
        
     }else{
        // if file not Valid file extensions then return 2.
        echo json_encode([
         'status'=>2
       ]);
     }
    
   
    
}
function readCsv($uploadlocation,$response)
{
  $sumA1=0;
  $sumA2=0;
  $sumA3=0;
  $sumA4=0;
  $sumC1=0;
  $sumC2=0;
  $sumC3=0;
  $resultC=0;
  if (($open = fopen($uploadlocation, "r")) !== FALSE) {

    while (($data = fgetcsv($open, 1000, ",")) !== FALSE) {
      $array[] = $data;
    }

    fclose($open);
  }

  for ($i = 0; $i < count($array); $i++) {
    //To display array data
    if (intval($array[$i][0]) >= 995322492000 && intval($array[$i][0]) < 995322492999) {
      $sumA1 += $array[$i][5];
    }

    if (intval($array[$i][0]) >= 322492000 && intval($array[$i][0]) < 322492999) {
      $sumA2 += $array[$i][5];
    }

    if (intval($array[$i][0]) >= 322040000 && intval($array[$i][0]) < 322049999) {
      $sumA3 += $array[$i][5];
    }

    if (intval($array[$i][0]) >= 706090000 && intval($array[$i][0]) < 706092999) {
      $sumA4 += $array[$i][5];
    }

    if (intval($array[$i][2]) >= 995322492000 && intval($array[$i][2]) < 995322492999) {
      $sumC1 += $array[$i][5];
    }

    if (intval($array[$i][2]) >= 995322496000 && intval($array[$i][2]) < 995322497999) {
      $sumC2 += $array[$i][5];
    }

    if (intval($array[$i][2]) >= 995322040000 && intval($array[$i][2]) < 995322049999) {
      $sumC3 += $array[$i][5];
    }

    if (intval($array[$i][2]) == 8074001) {
      $resultC += $array[$i][5];
    }
  }

  echo json_encode([
    'status'=>$response,
    'sumA1' => $sumA1,
    'sumA2' => $sumA2,
    'sumA3' => $sumA3,
    'sumA4' => $sumA4,
    'sumC1' => $sumC1,
    'sumC2' => $sumC2,
    'sumC3' => $sumC3,
    'resultC' => $resultC,
  ]);


}


?>

