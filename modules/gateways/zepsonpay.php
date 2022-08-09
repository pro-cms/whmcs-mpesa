<?php

# zepsonpay

/**
 * Define module related meta data.
 *
 * Values returned here are used to determine module related capabilities and
 * settings.
 *
 * @see https://developers.whmcs.com/payment-gateways/meta-data-params/
 *
 * @return array
 */
function zepsonpay_MetaData()
{
    return array(
        'DisplayName' => 'Zepson pay',
        'APIVersion' => '1.0', // Use API Version 1.1
        'DisableLocalCreditCardInput' => true,
        'TokenisedStorage' => false,
    );
}

function zepsonpay_config() {

    $configarray = array(
     "FriendlyName" => array(
        "Type" => "System",
        "Value" => "Zepson Pay"
        ),
     
     'environment' => array(
            'FriendlyName' => 'Environment',
            'Type' => 'text',
            'Size' => '25',
            'Default' => '',
            'Description' => 'Enter your Environment here',
        ),
     'api_key' => array(
            'FriendlyName' => 'API key',
            'Type' => 'text',
            'Size' => '35',
            'Default' => '',
            'Description' => 'Enter your key here',
     ),
     'api_secret' => array(
            'FriendlyName' => 'API Secret',
            'Type' => 'text',
            'Size' => '35',
            'Default' => '',
            'Description' => 'Enter your secret here',
     )
    );

    return $configarray;

}

function zepsonpay_link($params) {
    $message = "";
    $paymentmade = false;
    
    if (isset($_POST)){
         
      
        if ( $_POST['invoice_id'] != '') {
           
            // ?api_key=65c0c0a1-8bd3-4807-b994-f5b5ea8ef19f&api_secret=795eb9d9-1b10-44b7-bc85-4d2e2c2aaed9&environment=production&purpose=testing&operator=airtel&phone=0782898054&amount=500
        $payment_params = [
            'api_key' => $params['api_key'],
            'api_secret' => $params['api_secret'],
            'environment' => $params['environment'],
            'purpose' => 'Hosting Service',
            'operator' => $_POST['operator'],
            'phone' =>  $_POST['phone'],
            'amount' => $_POST['amount']*2340,
    
        ];
        $build_url_params = http_build_query($payment_params);
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'http://staging.zepsonpay.com/api/v1/payment?'.$build_url_params,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        ));

        $response = curl_exec($curl);

        curl_close($curl);
    //         if ($_POST['send_url'] == 'paybill') {
    //             $send_url = 'https://my.jisort.com/paymentsApi/validate/?business_no='.$_POST['shortcode'].'&trans_id='.$_POST['trans_id'];
    //         } else {
    //             $send_url = 'https://my.jisort.com:9382/general_ledger/transactions_ledger/?business_no='.$_POST['shortcode'].'&trans_id='.$_POST['trans_id'];
    //         }

    //         $url = $send_url;
    //         $ch = curl_init(); 
    //         curl_setopt($ch, CURLOPT_URL, $url); 
    //         curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true);
    //         curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    //         curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    //         $result = curl_exec($ch); 
    //         $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE); 
    //         curl_close($ch);  

    //         if ($httpcode == '500') {
    //             $message = "<strong style='color:red;'>An error has occurred. Kindly try again later.</strong>";
    //         } elseif ($httpCode != '200') {
    //             $message = "<strong style='color:red;'>".str_replace('["', '', str_replace('"]', '', $result))."</strong>";
    //         } else {   

    //             $json = json_decode($result, true);     

    //             addInvoicePayment(
    //                 $_POST['invoice_id'],
    //                 $json['transaction_reference'],
    //                 $json['debit'],
    //                 '0',
    //                 $_POST['moduleName']
    //             );
                
    //             header("Refresh:0");
    //         }
    //         $res = $message;
       }
    }

    global $_LANG;

    // Gateway Configuration Parameters
    $accountId = $params['accountID'];
    $secretKey = $params['secretKey'];
    $testMode = $params['testMode'];
    $dropdownField = $params['dropdownField'];
    $radioField = $params['radioField'];
    $textareaField = $params['textareaField'];

    // Invoice Parameters
    $invoiceId = $params['invoiceid'];
    $description = $params["description"];
    $amount = $params['amount'];
    $currencyCode = $params['currency'];

    // Client Parameters
    $firstname = $params['clientdetails']['firstname'];
    $lastname = $params['clientdetails']['lastname'];
    $email = $params['clientdetails']['email'];
    $address1 = $params['clientdetails']['address1'];
    $address2 = $params['clientdetails']['address2'];
    $city = $params['clientdetails']['city'];
    $state = $params['clientdetails']['state'];
    $postcode = $params['clientdetails']['postcode'];
    $country = $params['clientdetails']['country'];
    $phone = $params['clientdetails']['phonenumber'];

    // System Parameters
    $companyName = $params['companyname'];
    $systemUrl = $params['systemurl'];
    $returnUrl = $params['returnurl'];
    $langPayNow = $params['langpaynow'];
    $moduleDisplayName = $params['name'];
    $moduleName = $params['paymentmethod'];
    $whmcsVersion = $params['whmcsVersion'];

    $url = "viewinvoice.php?id=".$params['invoiceid'];
    $send_url = '';

   

    $postfields = array();
    $postfields['username'] = $username;
    $postfields['invoice_id'] = $invoiceId;
    $postfields['shortcode'] = $params['shortcode'];
    $postfields['description'] = $description;
    $postfields['amount'] = $amount;
    $postfields['currency'] = $currencyCode;
    $postfields['first_name'] = $firstname;
    $postfields['last_name'] = $lastname;
    $postfields['email'] = $email;
    $postfields['address1'] = $address1;
    $postfields['address2'] = $address2;
    $postfields['city'] = $city;
    $postfields['state'] = $state;
    $postfields['postcode'] = $postcode;
    $postfields['country'] = $country;
    $postfields['phone'] = $phone;
    $postfields['send_url'] = $send_url;
    $postfields['moduleName'] = $moduleName;
    $postfields['trans_id'] = $params['trans_id'];
    $postfields['clientsecret'] = $params['clientsecret'];
    $postfields['clientkey'] = $params['clientkey'];

     

    $code = '<form method="post" class="p-2 shadow-sm" action="' . $url . '">';
    foreach ($postfields as $k => $v) {
        $code .= '<input type="hidden" name="' . $k . '" value="' . urlencode($v) . '" />';
    }
    $code .= '<input required type="number" name="phone" placeholder="0XXXXXXXXX" class="form-control "  /> <br>';
    $code .= '<select required type="text" name="operator"    class="form-control  "/> 
         <option value="">--select operator--</option>
        <option value="airtel">Airtel Money</option>
        <option value="vodacom">Mpesa</option>
        </select>
        <br>
    
    ';
    $code .= '<input class="btn btn-info form-control" type="submit" value="' . $langPayNow . '" />';
    $code .= '</form>';

    return $code;

}

?> 