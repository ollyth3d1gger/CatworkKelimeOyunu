<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class Configcontroller extends Controller
{
    public function getset()
    {
       
	$env_files = [
        'MAIL_FROM_NAME' => env('MAIL_FROM_NAME'),
        'MAIL_FROM_ADDRESS' => env('MAIL_FROM_ADDRESS'),
        'MAIL_DRIVER' => env('MAIL_DRIVER'),
        'MAIL_HOST' => env('MAIL_HOST'),
        'MAIL_PORT' => env('MAIL_PORT'),
        'MAIL_USERNAME' => env('MAIL_USERNAME'),
        'MAIL_PASSWORD' => env('MAIL_PASSWORD'),
        'MAIL_ENCRYPTION' => env('MAIL_ENCRYPTION'),

      ];
      return view('admin.mailsetting.mailset', compact('env_files'));

    }

 public function changeMailEnvKeys(Request $request)
    {
         $input = $request->all();
        // some code
      

        	$env_update = $this->changeEnv([
          'MAIL_FROM_NAME' => $request->MAIL_FROM_NAME,
          'MAIL_DRIVER' => $request->MAIL_DRIVER,
          'MAIL_HOST' => $request->MAIL_HOST,
          'MAIL_PORT' => $request->MAIL_PORT,
          'MAIL_USERNAME' => $request->MAIL_USERNAME,
          'MAIL_FROM_ADDRESS' => $string = preg_replace('/\s+/', '', $request->MAIL_USERNAME),
          'MAIL_PASSWORD' => $request->MAIL_PASSWORD,
          'MAIL_ENCRYPTION' => $request->MAIL_ENCRYPTION,
        ]);

        //return $config = DB::table('configs')->get();
        // $config = Config::first();
		if($env_update) {
            return back()->with('updated', 'Mail settings has been saved');
        } else {
          return back()->with('deleted', 'Mail settings could not be saved');
        }

    }

    protected function changeEnv($data = array()){
        if(count($data) > 0){

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
            $env = implode("\n", $env);

            // And overwrite the .env with the new data
            file_put_contents(base_path() . '/.env', $env);
            
            return true;
        } else {
            return false;
        }
    }

    
}
