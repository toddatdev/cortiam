<?php
defined('BASEPATH') OR exit('No direct script access allowed');


use GuzzleHttp;
class Test extends CRTM_Controller {

	function __construct(){
		parent::__construct();

        $this->load->database();
        $this->load->model('agent_model');
        $this->load->helper(array('frontend'));
    }

    public function testing()
    {
        require_once('vendor/autoload.php');

//        $CLIENT_ID     = $this->config->item("zoom_sdk");
        $CLIENT_ID     = '6dwy3dTBSXOWCqtocA8clA';
//        $CLIENT_SECRET = $this->config->item("zoom_secret");
        $CLIENT_SECRET = 'mbMxhaMSkjKNPkzDCbVQmpLbEbchtSzSt4My';
        $REDIRECT_URI  = $this->config->item("REDIRECT_URI");


        try {
                $client = new GuzzleHttp\Client(['base_uri' => 'https://api.zoom.us']);

                $response = $client->request('POST', '/v2/users/tayyab.devdi@gmail.com/meetings', [
                "headers" => [
                    "Authorization" => "bearer ". 'eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOm51bGwsImlzcyI6IjZkd3kzZFRCU1hPV0NxdG9jQThjbEEiLCJleHAiOjE2NjcyODQxMzksImlhdCI6MTY2NjY3OTM0MH0.CkgHgCLPiWSzCbfRBJfYfmUqE50EBnX-BxyynHibtco'
                ], GuzzleHttp\RequestOptions::JSON => [
                   'agenda' => 'Testing the meeting',
                        'start_time' => '2022-12-12T16:00:00Z'
                ],
            ]);

//            $response = $client->request('GET', '/v2/meetings/81716412757', [
//                "headers" => [
//                    "Authorization" => "bearer ". 'eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOm51bGwsImlzcyI6IjZkd3kzZFRCU1hPV0NxdG9jQThjbEEiLCJleHAiOjE2NjcyODQxMzksImlhdCI6MTY2NjY3OTM0MH0.CkgHgCLPiWSzCbfRBJfYfmUqE50EBnX-BxyynHibtco'
////                    "Authorization" => "bearer ". base64_encode($CLIENT_ID.':'.$CLIENT_SECRET)
//                ],
////                GuzzleHttp\RequestOptions::JSON => [
////                    'first_name' => 'FN1',
////                    'last_name' => 'FN2',
////                    'email' => 'letnadeemdoit@gmail.com',
////                ],
//            ]);

          
            $token = json_decode($response->getBody()->getContents(), true);
            echo "<pre>";
            print_r($token);
            // $db = new DB();
            // $db->update_access_token(json_encode($token));
            echo "Access token inserted successfully.";
        } catch(Exception $e) {
            echo $e->getMessage();
        }


    }

    public function zoom()
    {
       $data = activeFeatures("minimum_wins");

       echo '<pre>';
            print_r($data);
            exit;
    }


    public function q()
    {
        $data = $this->agent_model->testing();
    }
 }
?>