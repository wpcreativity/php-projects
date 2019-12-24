

<?php
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP
 *
 * This content is released under the MIT License (MIT)
 *
 * Copyright (c) 2014 - 2015, British Columbia Institute of Technology
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @package	CodeIgniter
 * @author	EllisLab Dev Team
 * @copyright	Copyright (c) 2008 - 2014, EllisLab, Inc. (http://ellislab.com/)
 * @copyright	Copyright (c) 2014 - 2015, British Columbia Institute of Technology (http://bcit.ca/)
 * @license	http://opensource.org/licenses/MIT	MIT License
 * @link	http://codeigniter.com
 * @since	Version 1.0.0
 * @filesource
 */
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Shopping Cart Class
 *
 * @package		CodeIgniter
 * @subpackage	Libraries
 * @category	Shopping Cart
 * @author		EllisLab Dev Team
 * @link		http://codeigniter.com/user_guide/libraries/cart.html
 * @deprecated	3.0.0	This class is too specific for CI.
 */
class Pushnotification_for_vender
{
		
	const _GOOGLE_API_KEY = 'AIzaSyAzvsnHuewBD1Wfb08zz0R1uNYC0KIBRyE';
	const _GOOGLE_FCM_URL = 'https://fcm.googleapis.com/fcm/send';
	
	public function __construct(){ }
		
	public function andriod_push($registrationId, $message)
	{
		$msg = array
        (
            'message'   => $message,
            'title'     => 'SPOON 11',
            
        );

	    $fields = array(
	       'registration_ids' => $registrationId , 
	       'data'=>$msg
	    );
		   
	    $headers = array(
            'Authorization: key='.static::_GOOGLE_API_KEY,
            'Content-Type: application/json'
        );
       
        // Open connection
        $ch = curl_init();

        // Set the url, number of POST vars, POST data
        curl_setopt($ch, CURLOPT_URL, static::_GOOGLE_FCM_URL);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Disabling SSL Certificate support temporarly
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));

        // Execute post
        $result = curl_exec($ch);
        // Close connection
        curl_close($ch);
        return $result;
	}
	
	public function ios_push($registrationId, $message)
	{
		foreach ($registrationId as $reg) 
		{	
			//echo $message;
			$passphrase = '12345';
	        $ctx = stream_context_create();

	        stream_context_set_option($ctx, 'ssl', 'local_cert', APPPATH.'libraries/ck.pem');
	        stream_context_set_option($ctx, 'ssl', 'passphrase', $passphrase);
	        //echo "hihihih121212"; die;
	        $fp = stream_socket_client(
	        'ssl://gateway.sandbox.push.apple.com:2195', $err,
	        $errstr, 60, STREAM_CLIENT_CONNECT|STREAM_CLIENT_PERSISTENT, $ctx);

	        if (!$fp)
	        exit("Failed to connect: $err $errstr" . PHP_EOL);

	        $body['aps'] = array(
	         'alert' =>   'Notification',
	         'sound' =>   'default',
	         'message' => $message,                               
	        );                           

	        $payload = json_encode($body);

	        $msg = chr(0) . pack('n', 32) . pack('H*', $reg) . pack('n', strlen($payload)) . $payload;
	        $result = fwrite($fp, $msg, strlen($msg));
	        //print_r($result);
	        if (!$result) return 'Message not delivered' . PHP_EOL;
	        else  return 'Message successfully delivered' . PHP_EOL;
	        fclose($fp);
		}
	    
	}
public function hello(){
	// echo "hello";
	return "hello";
}
	
	
}

///$message = array('body' => 'hello');

// $registrationId = array('dGQKpp554tQ:APA91bFDILbYKkD6dUt8sXpYitZ8njtAOUt-lIGE7NHLUvXG1iNAL9b1XIl7vTdI-LWqQF0IjIOaYa-PGDIf2eseAlHP0D-wK07Gyj2smf-kZOWtTd9OWIX4i6-oZmxrnfzuKmeUR0oD');


//$registrationId = array('0df524060668b3b658ca4635d1f9c84d88d1a0d9077925291fe8566f923e4296');

//$message ='My First Push Notification';

//$obj = new Push_notification();
//$result = $obj->send_notification($registrationId, $message);