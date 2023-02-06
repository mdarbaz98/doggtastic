<?php
include('pets-admin/include/config.php');

if($_POST['btn']=="payCreditCard"){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $card_no = $_POST['cc_no'];
    $expiry = $_POST['expiry'];
    $cvv = $_POST['cvv'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $pincode = $_POST['pincode'];
    $state = $_POST['state'];
    $country = $_POST['country'];
    $invoice_id = $_POST['invoice_id'];
    $total_price = (float) $_POST['total_price'];
    $refId = 'ref' . time();
    
    $curl = curl_init();   
    $fieldOpt='<createTransactionRequest xmlns="AnetApi/xml/v1/schema/AnetApiSchema.xsd">
  <merchantAuthentication>
    <name>2Xc8mT8v9Gw</name>  
    <transactionKey>45KzV768x47eEpKu</transactionKey>
  </merchantAuthentication>
  <refId>'.$refId.'</refId>
  <transactionRequest>
    <transactionType>authCaptureTransaction</transactionType>
    <amount>'.$total_price.'</amount>
    <payment>
      <creditCard>
        <cardNumber>'.$card_no.'</cardNumber>
        <expirationDate>'.$expiry.'</expirationDate>
        <cardCode>'.$cvv.'</cardCode>
      </creditCard>
    </payment>
    <order>
     <invoiceNumber>'.$invoice_id.'</invoiceNumber>
     <description>Invoice</description>
    </order>       
    <billTo>
      <firstName>'.$name.'</firstName>
      <lastName></lastName>      
      <address>'.$address.'</address>
      <city>'.$city.'</city>
      <state>'.$state.'</state>
      <zip>'.$pincode.'</zip>
      <country>'.$country.'</country>
    </billTo>       
  </transactionRequest>
</createTransactionRequest>';
 //live link https://api.authorize.net/xml/v1/request.api
  //sandbox test link https://apitest.authorize.net/xml/v1/request.api
  curl_setopt_array($curl, array(
  CURLOPT_URL => "https://api.authorize.net/xml/v1/request.api",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => "$fieldOpt",
  CURLOPT_HTTPHEADER => array(
    "cache-control: no-cache",
    "content-type: application/xml"   
  ),
));

$response = curl_exec($curl);
$xml = @simplexml_load_string($response);
$json = json_encode($xml);
$resArr = json_decode($json,TRUE);

// echo "<pre>";
// print_r($resArr);
// echo "</pre>";  

$refId = $resArr['refId'];
$success_text = $resArr['messages']['message']['text'];
$code = $resArr['messages']['message']['code'];
$transId = $resArr['transactionResponse']['transId'];
$responseCode = $resArr['transactionResponse']['responseCode'];
$acc_type = $resArr['transactionResponse']['accountType'];
$acc_no = $resArr['transactionResponse']['accountNumber'];
$error_msg = $resArr['transactionResponse']['errors']['errorText'];
$message_code = $resArr['transactionResponse']['messages']['message']['code'];
$message = $resArr['transactionResponse']['messages']['message']['description'];

if($success_text == 'Successful.'){
    $payment_insert = $conn->prepare('INSERT INTO payment_info(invoice_id, name, address, city, state, zipcode, country, amount, card_number, expiry_date, cvv_number, ref_id, success_text, code, trans_id, acc_type, acc_no, error_msg, message_code, message, status)VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)');
    if($payment_insert->execute([$invoice_id, $name, $address, $city, $state, $pincode, $country, $total_price, $card_no, $expiry, $cvv, $refId, $success_text, $code, $transId, $acc_type, $acc_no, $error_msg, $message_code, $message, 1])){
        echo $invoice_id;    
                    
     
$body = [
    'Messages' => [
        [
        'From' => [
            'Email' => "mehtab.qureshi@webenetic.com",
            'Name' => " Doggtastic Adventures"
        ],
        'To' => [
            [
                'Email' => $email,
                'Name' => $name
            ]
        ],
        'Subject' => " Order Confirmation",
        'HTMLPart' => "Thank you for placing the order your Order Id is <b>'$invoice_id'</b>. We will be sending a payment confirmation email once your payment is reflected in our system. We would request your patience and co-operation."
        ]
    ]
];
  
$ch = curl_init();
  
curl_setopt($ch, CURLOPT_URL, "https://api.mailjet.com/v3.1/send");
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($body));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
    'Content-Type: application/json')
);
curl_setopt($ch, CURLOPT_USERPWD, "25abd541dcfd2369a9c46c470c56d7d5:83be01db697aca02b727cd0e2d43822c");
$server_output = curl_exec($ch);
curl_close ($ch);
  
$response = json_decode($server_output);
if ($response->Messages[0]->Status == 'success') {
   // echo "Email sent successfully.";
}else{
  //  echo "Error While sending an email.";
}




        
        
    }        
}


// $err = curl_error($curl);
// curl_close($curl);
// $errText='';
//$result=array();  
// echo $response;

//  echo json_encode($result);
   // exit();
    
    

// $resXml = new SimpleXMLElement($response);
// $resArr = (array) $resXml; 


//   if($resArr["transactionResponse"]->responseCode=='1'){ // 1 stand for approved payment
//   $result["result"]="success";
//     $result["response"]=$resArr["transactionResponse"]->avsResultCode;
//   $result["transId"]=$resArr["transactionResponse"]->transId;
//   //end
//   }else{
//       $errMsg='';
//         if($resArr['transactionResponse']->errors){
//           $errMsg=(string) $resArr['transactionResponse']->errors->error->errorText;  
//         }
      
//       $result["result"]="error";
//       $result["errorText"]=$errMsg;
//   }


           
//log error
// $log  = "Remote Address: ".$_SERVER['REMOTE_ADDR'].' - '.date("F j, Y, g:i a").PHP_EOL.
// "Curl Response:".json_encode($resArr).PHP_EOL.
// "Result Data:".json_encode($result).PHP_EOL.
// "FAILED STATUS:".$resArr['transactionResponse']->errors->error->errorText.PHP_EOL.
// "Curl Error :".$err.PHP_EOL.
// "-------------------------".PHP_EOL;
//Save string to log, use FILE_APPEND to append.
//  file_put_contents('./log_'.date("j.n.Y").'.log', $log, FILE_APPEND);
//end log

 }


