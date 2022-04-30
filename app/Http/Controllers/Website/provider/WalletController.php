<?php

namespace App\Http\Controllers\Website\provider;

use App\Http\Controllers\Controller;
use App\Models\ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Config;

class WalletController extends Controller
{
    //

    public function index(Request $request)
    {

        $details = getMyLocationDetails();
        $country = $details->country;

        $currency = null;

        if ($country == 'SA' || $country == 'SAU') {
            # code...
            $currency = 'SAR';
        } else  if ($country == 'EG' || $country == 'EGY') {
            # code...
            $currency = 'EGP';
        } else  if ($country == 'AE' || $country == 'ARE') {
            # code...
            $currency = 'AED';
        } else  if ($country == 'KW' || $country == 'KWT') {
            # code...
            $currency = 'KWD';
        } else {
            $currency = 'USD';
        }

        return view('Website.service provider.wallet', [
            'currency' => $currency
        ]);
    }




    public function chargeStatus(Request $request)
    {

        if ($request->status == 1) {

            $serviceProvider =    ServiceProvider::findOrFail(Auth::guard('provider')->id());

            $serviceProvider =    ServiceProvider::where('id', Auth::guard('provider')->id())->update([
                'wallet' =>  $serviceProvider->wallet + $request->cost,
            ]);

            return redirect()->route('provider.wallet')->with('msg', Config::get('app.locale') == 'ar' ?  ' تم اعادة شحن محفظتك بنجاح.' : 'Your wallet has been successfully recharged.');
        } else {

            return redirect()->route('provider.wallet')->withErrors(['msg' => Config::get('app.locale') == 'ar' ?  'حدث خطأ يرجي التواصل مع الادارة.' : 'An error occurred, please contact the administration.']);
        }
    }



    public function charge(Request $request)
    {

        //   dd($request->all());

        $validated = $request->validate([
            'cost' => 'required|numeric|gt:0',
        
        ]);


        $details = getMyLocationDetails();
        $country = $details->country;
        //   dd($country);
        $currency = null;

        if ($country == 'SA' || $country == 'SAU') {
            # code...
            $currency = 'SAR';
        } else  if ($country === 'EG' || $country === 'EGY') {
            # code...
            $currency = 'EGP';
        } else  if ($country == 'AE' || $country == 'ARE') {
            # code...
            $currency = 'AED';
        } else  if ($country == 'KW' || $country == 'KWT') {
            # code...
            $currency = 'KWD';
        } else {
            $currency = 'USD';
        }
        //   dd($currency);

        /* ------------------------ Configurations ---------------------------------- */
        //Test
        $apiURL = 'https://apitest.myfatoorah.com';
        $apiKey = 'rLtt6JWvbUHDDhsZnfpAhpYk4dxYDQkbcPTyGaKp2TYqQgG7FGZ5Th_WD53Oq8Ebz6A53njUoo1w3pjU1D4vs_ZMqFiz_j0urb_BH9Oq9VZoKFoJEDAbRZepGcQanImyYrry7Kt6MnMdgfG5jn4HngWoRdKduNNyP4kzcp3mRv7x00ahkm9LAK7ZRieg7k1PDAnBIOG3EyVSJ5kK4WLMvYr7sCwHbHcu4A5WwelxYK0GMJy37bNAarSJDFQsJ2ZvJjvMDmfWwDVFEVe_5tOomfVNt6bOg9mexbGjMrnHBnKnZR1vQbBtQieDlQepzTZMuQrSuKn-t5XZM7V6fCW7oP-uXGX-sMOajeX65JOf6XVpk29DP6ro8WTAflCDANC193yof8-f5_EYY-3hXhJj7RBXmizDpneEQDSaSz5sFk0sV5qPcARJ9zGG73vuGFyenjPPmtDtXtpx35A-BVcOSBYVIWe9kndG3nclfefjKEuZ3m4jL9Gg1h2JBvmXSMYiZtp9MR5I6pvbvylU_PP5xJFSjVTIz7IQSjcVGO41npnwIxRXNRxFOdIUHn0tjQ-7LwvEcTXyPsHXcMD8WtgBh-wxR8aKX7WPSsT1O8d8reb2aR7K3rkV3K82K_0OgawImEpwSvp9MNKynEAJQS6ZHe_J_l77652xwPNxMRTMASk1ZsJL'; //Test token value to be placed here: https://myfatoorah.readme.io/docs/test-token

        //Live
        //$apiURL = 'https://api.myfatoorah.com';
        //$apiKey = 'VEONDmliVLRnRv6H-0gfIa8XPMVCGSmdx2007F4ASxw9Oku91ebfJyBlofmexY2XZboQpId5Ikk_6_U9seTETAx7hlcZ3DNcmSJn9_9UQzwDo-9i0PYZZVkjoBuJSevrNlm1FcWDTa2AORV959lsoP1pO6KkO0KI7fhYNfiByxtQuNi5NdA46kdyqod_IBM6_KlNxPeYDb6SUKAxfXxOE9Ny3nqX7SSPYA-KIQfmGYVSHiYWPfAk69A4-UzrZTd20cDlqoxrsH2whNRIBUaaHsu6OL8htShMr46RdiIlMaPRiixcjwkjbjUT-cGVsujh62f_EZ3MjfHTYxsI8qRiF3-7eZMe4_1VXhhF9bKFlxR6zwAa-VH5kg9iAcwJWRJhHSEI8DthHD7Kj-C2OZAnBs25D1YmXR_mzaSszFfbTGYoJIc71sUYBt-o8NEJH_5twR6_58w4CrzuwbeW-UIE2oPcOo3wz7a8wiCWIm_pz9iW8pNJItQFzuL4uBcX39-tcDhY717KonwDZjOxwC9HqHV7GRZI5S8OH2S2qyUbxQfuFqPw3TySN5zJYns1PFtbUtQn4Cc1Wbyk7-1jwNNspL-0kQT3LbGIYnzO8_8oDzFh_-podn6HoFdgqB4WZOuhaF3ex0-rFq1pHjudvNYZzkbOItxCkhWVeV_6BpDBXh0U_Y4W'; //Live token value to be placed here: https://myfatoorah.readme.io/docs/live-token


        /* ------------------------ Call InitiatePayment Endpoint ------------------- */





        //Fill POST fields array
        $ipPostFields = ['InvoiceAmount' => $request->cost, 'CurrencyIso' => $currency, 'PaymentCurrencyIso' => $currency, 'DisplayCurrencyIso' =>  $currency,];

        //Call endpoint
        $paymentMethods =  $this->initiatePayment($apiURL, $apiKey, $ipPostFields);

        //     dd($paymentMethods);
        //You can save $paymentMethods information in database to be used later
      //  $paymentMethodId = 2;
               foreach ($paymentMethods as $pm) {
            if ($pm->PaymentMethodEn == 'VISA/MASTER') {
                $paymentMethodId = $pm->PaymentMethodId;
                break;
            }
        }

        /* ------------------------ Call ExecutePayment Endpoint -------------------- */
        //Fill customer address array
        /* $customerAddress = array(
  'Block'               => 'Blk #', //optional
  'Street'              => 'Str', //optional
  'HouseBuildingNo'     => 'Bldng #', //optional
  'Address'             => 'Addr', //optional
  'AddressInstructions' => 'More Address Instructions', //optional
  ); */

        //Fill invoice item array
        /* $invoiceItems[] = [
  'ItemName'  => 'Item Name', //ISBAN, or SKU
  'Quantity'  => '2', //Item's quantity
  'UnitPrice' => '25', //Price per item
  ]; */

        //Fill POST fields array
        $postFields = [
            //Fill required data
            'paymentMethodId' => $paymentMethodId,
            'InvoiceValue'    => $request->cost,
            'CallBackUrl'     => route('provider.chargeStatus', ['status' => 1, 'cost' => $request->cost]),
            'ErrorUrl'        => route('provider.chargeStatus', ['status' => 0]), //or 'https://example.com/error.php'    
            //Fill optional data
            //'CustomerName'       => 'fname lname',
            'DisplayCurrencyIso' =>  $currency,
            //'MobileCountryCode'  => '+965',
            //'CustomerMobile'     => '1234567890',
            //'CustomerEmail'      => 'email@example.com',
            //'Language'           => 'en', //or 'ar'
            //'CustomerReference'  => 'orderId',
            //'CustomerCivilId'    => 'CivilId',
            //'UserDefinedField'   => 'This could be string, number, or array',
            //'ExpiryDate'         => '', //The Invoice expires after 3 days by default. Use 'Y-m-d\TH:i:s' format in the 'Asia/Kuwait' time zone.
            //'SourceInfo'         => 'Pure PHP', //For example: (Laravel/Yii API Ver2.0 integration)
            //'CustomerAddress'    => $customerAddress,
            //'InvoiceItems'       => $invoiceItems,
        ];

        //Call endpoint
        $data =  $this->executePayment($apiURL, $apiKey, $postFields);

        //You can save payment data in database as per your needs
        $invoiceId   = $data->InvoiceId;
        $paymentLink = $data->PaymentURL;

        //Redirect your customer to the payment page to complete the payment process
        //Display the payment link to your customer
        return redirect()->to($paymentLink);

        //    echo "Click on <a href='$paymentLink' target='_blank'>$paymentLink</a> to pay with invoiceID $invoiceId.";
    }


    /* ------------------------ Functions --------------------------------------- */
    /*
 * Initiate Payment Endpoint Function 
 */

    function initiatePayment($apiURL, $apiKey, $postFields)
    {

        $json =  $this->callAPI("$apiURL/v2/InitiatePayment", $apiKey, $postFields);
        return $json->Data->PaymentMethods;
    }

    //------------------------------------------------------------------------------
    /*
 * Execute Payment Endpoint Function 
 */

    function executePayment($apiURL, $apiKey, $postFields)
    {

        $json =  $this->callAPI("$apiURL/v2/ExecutePayment", $apiKey, $postFields);
        return $json->Data;
    }

    //------------------------------------------------------------------------------
    /*
 * Call API Endpoint Function
 */

    function callAPI($endpointURL, $apiKey, $postFields = [], $requestType = 'POST')
    {

        $curl = curl_init($endpointURL);
        curl_setopt_array($curl, array(
            CURLOPT_CUSTOMREQUEST  => $requestType,
            CURLOPT_POSTFIELDS     => json_encode($postFields),
            CURLOPT_HTTPHEADER     => array("Authorization: Bearer $apiKey", 'Content-Type: application/json'),
            CURLOPT_RETURNTRANSFER => true,
        ));

        $response = curl_exec($curl);
        $curlErr  = curl_error($curl);

        curl_close($curl);

        if ($curlErr) {
            //Curl is not working in your server
            die("Curl Error: $curlErr");
        }

        $error =  $this->handleError($response);
        if ($error) {
            die("Error: $error");
        }

        return json_decode($response);
    }

    //------------------------------------------------------------------------------
    /*
 * Handle Endpoint Errors Function 
 */

    function handleError($response)
    {

        $json = json_decode($response);
        if (isset($json->IsSuccess) && $json->IsSuccess == true) {
            return null;
        }

        //Check for the errors
        if (isset($json->ValidationErrors) || isset($json->FieldsErrors)) {
            $errorsObj = isset($json->ValidationErrors) ? $json->ValidationErrors : $json->FieldsErrors;
            $blogDatas = array_column($errorsObj, 'Error', 'Name');

            $error = implode(', ', array_map(function ($k, $v) {
                return "$k: $v";
            }, array_keys($blogDatas), array_values($blogDatas)));
        } else if (isset($json->Data->ErrorMessage)) {
            $error = $json->Data->ErrorMessage;
        }

        if (empty($error)) {
            $error = (isset($json->Message)) ? $json->Message : (!empty($response) ? $response : 'API key or API URL is not correct');
        }

        return $error;
    }

    /* -------------------------------------------------------------------------- */
}
