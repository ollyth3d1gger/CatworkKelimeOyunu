<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Setting;

class ApiController extends Controller
{
    
public function setApiView()
    {
     
      $env_files = [
        'STRIPE_KEY' => env('STRIPE_KEY'),
        'STRIPE_SECRET' => env('STRIPE_SECRET'),
        'MAILCHIMP_APIKEY' => env('MAILCHIMP_APIKEY'),
        'MAILCHIMP_LIST_ID' => env('MAILCHIMP_LIST_ID'),
        'TMDB_API_KEY' => env('TMDB_API_KEY'),
        'PAYPAL_CLIENT_ID' => env('PAYPAL_CLIENT_ID'),
        'PAYPAL_SECRET_ID' => env('PAYPAL_SECRET_ID'),
        'PAYPAL_MODE' => env('PAYPAL_MODE'),
        'PAYU_METHOD' => env('PAYU_METHOD'),
        'PAYU_DEFAULT' => env('PAYU_DEFAULT'),
        'PAYU_MERCHANT_KEY' => env('PAYU_MERCHANT_KEY'),
        'PAYU_MERCHANT_SALT' => env('PAYU_MERCHANT_SALT')
      ];
      return view('admin.mailsetting.api', compact('env_files'));
    }

    public function changeEnvKeys(Request $request)
    {
        $input = $request->all();
        // some code
        $env_update = $this->changeEnv([
          'STRIPE_KEY' => $request->STRIPE_KEY,
          'STRIPE_SECRET' => $request->STRIPE_SECRET,
          'MAILCHIMP_APIKEY' => $request->MAILCHIMP_APIKEY,
          'MAILCHIMP_LIST_ID' => $request->MAILCHIMP_LIST_ID,
          'TMDB_API_KEY' => $request->TMDB_API_KEY,
          'PAYPAL_CLIENT_ID' => $request->PAYPAL_CLIENT_ID,
          'PAYPAL_SECRET_ID' => $request->PAYPAL_SECRET_ID,
          'PAYPAL_MODE' => $request->PAYPAL_MODE,
          'PAYU_METHOD' => $request->PAYU_METHOD,
          'PAYU_DEFAULT' => $request->PAYU_DEFAULT,
          'PAYU_MERCHANT_KEY' => $request->PAYU_MERCHANT_KEY,
          'PAYU_MERCHANT_SALT' => $request->PAYU_MERCHANT_SALT
        ]);

        if(!isset($input['stripe_payment']))
        {
          $input['stripe_payment'] = 0;
        }

        if(!isset($input['paypal_payment']))
        {
          $input['paypal_payment'] = 0;
        }

        if(!isset($input['payu_payment']))
        {
          $input['payu_payment'] = 0;
        }

        
        if($env_update) {
            return back()->with('updated', 'Api settings has been saved');
        } else {
          return back()->with('deleted', 'Api settings could not be saved');
        }

    }

    public function facebook()
    {
      $env_files = [
        'FACEBOOK_CLIENT_ID' => env('FACEBOOK_CLIENT_ID'),
        'FACEBOOK_CLIENT_SECRET' => env('FACEBOOK_CLIENT_SECRET'),
        'FACEBOOK_CALLBACK' => env('FACEBOOK_CALLBACK'),
        'GOOGLE_CLIENT_ID' => env('GOOGLE_CLIENT_ID'),
        'GOOGLE_CLIENT_SECRET' => env('GOOGLE_CLIENT_SECRET'),
        'GOOGLE_CALLBACK' => env('GOOGLE_CALLBACK'),
        'GITLAB_CLIENT_ID' => env('GITLAB_CLIENT_ID'),
        'GITLAB_CLIENT_SECRET' => env('GITLAB_CLIENT_SECRET'),
        'GITLAB_CALLBACK' => env('GITLAB_CALLBACK')
      ];

      

      return view('admin.sociallogin.index',compact('env_files'));


    }

     public function updateFacebookKey(Request $request)
    {
        $input = $request->all();
        // some code
        $env_update = $this->changeEnv([
          'FACEBOOK_CLIENT_ID' => $request->FACEBOOK_CLIENT_ID,
          'FACEBOOK_CLIENT_SECRET' => $request->FACEBOOK_CLIENT_SECRET,
          'FACEBOOK_CALLBACK' => $request->FACEBOOK_CALLBACK
        ]);

        if(isset($request->fb_check)){
       
            Setting::where('id','=',1)->update(['fb_login' => "1"]);

        }else{
       
            Setting::where('id','=',1)->update(['fb_login' => "0"]);

        }
        return back()->with('updated','Facebook Settings Enabled');


      }

      public function updateGoogleKey(Request $request)
    {
        $input = $request->all();
        // some code
        $env_update = $this->changeEnv([
          'GOOGLE_CLIENT_ID' => $request->GOOGLE_CLIENT_ID,
          'GOOGLE_CLIENT_SECRET' => $request->GOOGLE_CLIENT_SECRET,
          'GOOGLE_CALLBACK' => $request->GOOGLE_CALLBACK,
        ]);

        if(isset($request->google_login)){
        
            Setting::where('id','=',1)->update(['google_login' => 1]);

        }else{
            
            Setting::where('id','=',1)->update(['google_login' => 0]);

        }



        return back()->with('updated','Google Settings updated');


      }

      public function updategitlabKey(Request $request)
    {
        $input = $request->all();
        // some code
        $env_update = $this->changeEnv([
          'GITLAB_CLIENT_ID' => $request->GITLAB_CLIENT_ID,
          'GITLAB_CLIENT_SECRET' => $request->GITLAB_CLIENT_SECRET,
          'GITLAB_CALLBACK' => $request->GITLAB_CALLBACK,
        ]);

        if(isset($request->git_lab_check)){
        
            Setting::where('id','=',1)->update(['gitlab_login' => 1]);

        }else{
            
            Setting::where('id','=',1)->update(['gitlab_login' => 0]);

        }



        return back()->with('updated','Gitlab Settings is enabled !');


      }

    

    protected function changeEnv($data = array()){
    {
        if ( count($data) > 0 ) {

            // Read .env-file
            $env = file_get_contents(base_path() . '/.env');

            // Split string on every " " and write into array
            $env = preg_split('/\s+/', $env);;

            // Loop through given data
            foreach((array)$data as $key => $value){
              // Loop through .env-data
              foreach($env as $env_key => $env_value){
                // Turn the value into an array and stop after the first split
                // So it's not possible to split e.g. the App-Key by accident
                $entry = explode("=", $env_value, 2);

                // Check, if new key fits the actual .env-key
                if($entry[0] == $key){
                    // If yes, overwrite it with the new one
                    $env[$env_key] = $key . "=" . $value;
                } else {
                    // If not, keep the old one
                    $env[$env_key] = $env_value;
                }
              }
            }

            // Turn the array back to an String
            $env = implode("\n\n", $env);

            // And overwrite the .env with the new data
            file_put_contents(base_path() . '/.env', $env);

            return true;

        } else {

          return false;
        }
    }
  }

}
