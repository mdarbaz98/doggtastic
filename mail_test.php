<?php
$body = [
    'Messages' => [
        [
        'From' => [
            'Email' => "mehtab.qureshi@webenetic.com",
            'Name' => " Doggtastic Adventures"
        ],
        'To' => [
            [
                'Email' => "mehtabq24@gmail.com",
                'Name' => "Mehtab Qureshi"
            ]
        ],
        'Subject' => " Order Confirmation",
        'HTMLPart' => "Thank you for placing the order your Order Id is #INV-20230202172553. We will be sending a payment confirmation email once your payment is reflected in our system. We would request your patience and co-operation."
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
    echo "Email sent successfully.";
}else{
    echo "Error While sending an email.";
}
?>