<?php

namespace Gabbyti\BulkSmsNigeriaOtp\Http\Controllers;

use Gabbyti\BulkSmsNigeriaOtp\BulkSmsNigeriaOtp;
use Illuminate\Http\Request;

class OtpController extends Controller
{
    /**
     * @param request
     * @return JsonResponse
     */
    public function sendOtp(Request $request)
    {

        $response = array();

        $request->validate([
            'phone' => ['required', 'string'],
        ]);

        $phone = $request->session()->get('phone');
        if (!$phone) {
            $otp = rand(100000, 999999);

            $bulkSmsResponse = BulkSmsNigeriaOtp::sendOtpToNumber($otp, $request->phone)->getData();

            if ($bulkSmsResponse->error) {
                $response['error'] = true;
                $response['message'] = 'Sending sms failed. Contact admin.';
            } else {

                $request->session()->put([
                    'OTP' => $otp,
                    'phone' => $request->phone,
                ]);

                $response['error'] = false;
                $response['message'] = 'Your OTP is created.';
                $response['OTP'] = $otp;
            }
            return json_encode($response);
        } else {
            $response['error'] = true;
            $response['message'] = 'OTP has already been sent. Click the resend button to resend your OTP';
            return json_encode($response);
        }
    }

    /**
     * @param $request
     * @return JsonResponse
     */
    public function resendOtp(Request $request)
    {
        $response = array();

        $phone = $request->session()->get('phone');
        if ($phone) {
            $otp = $request->session()->get('OTP');

            $bulkSmsResponse = BulkSmsNigeriaOtp::sendOtpToNumber($otp, $request->phone)->getData();

            if ($bulkSmsResponse->error) {
                $response['error'] = true;
                $response['message'] = 'Sending sms failed. Contact admin.';
            } else {

                $request->session()->put([
                    'OTP' => $otp,
                    'phone' => $request->phone,
                ]);

                $response['error'] = false;
                $response['message'] = 'Your OTP is created.';
                $response['OTP'] = $otp;
            }
            return json_encode($response);
        } else {
            $response['error'] = true;
            $response['message'] = 'phone number not available';
            return json_encode($response);
        }
    }

    /**
     * @param $request
     * @return JsonResponse
     */
    public function verifyOtp(Request $request)
    {
        // dd($request->session()->get('phone'));
        $request->validate([
            'otp' => ['required', 'digits:6'],
        ]);

        $response = array();

        // Get OTP entered in the form
        $enteredOtp = $request->otp;

        // gets current logged in user instance
        $user = auth()->user();

        //gets OTP sent to users phone from session
        $OTP = $request->session()->get('OTP');

        if ($OTP == $enteredOtp) {

            // get users ohone number stored in session
            $phone = $request->session()->get('phone');

            //Update the user information
            // $user->update([
            //     'phone' => $phone,
            //     'is_phone_verified' => true
            // ]);

            //Removing Session variables
            $request->session()->forget(['OTP', 'phone']);

            $response['error'] = false;
            $response['isPhoneVerified'] = true;
            $response['message'] = "Your Phone Number is Verified.";
        } else {
            //Removing Session variables
            $request->session()->forget(['OTP', 'phone']);

            $response['error'] = true;
            $response['isPhoneVerified'] = false;
            $response['message'] = "Invalid OTP";
        }

        return json_encode($response);
    }
}
