<?php
class Email_engine
{
	private $CI;
	
	public function __construct()
	{
		$this->CI = &get_instance();
	}
		
	public function account_activation_email($to, $data)
	{
		$subject = 'School Driving Account Activation';
		$body = $this->CI->load->view('email_templates/account_activation',$data,TRUE);
		
		return $this->sendEmail($to, $subject, $body);
	}
	
				
	public function sendEmail($to, $subject, $body)
	{
		$config ['charset'] = 'utf-8';
		$config ['wordwrap'] = TRUE;
		$config ['mailtype'] = 'html';
		
		$this->CI->email->set_mailtype ("html");
		$this->CI->email->from ('no-reply@xanta-tech.com', 'Driving School');
		$this->CI->email->to ($to);
		$this->CI->email->subject ($subject);
		$this->CI->email->message($body);
		
		return $this->CI->email->send () ? true : false;
	}
	

	public function attachement($attachement_path=null,$from_name=null,$from_mail,$subject,$mailto,$html)
    { 
      
        $message=$html;       
             
        $attachement=@$attachement_path ;
        if(!empty($attachement))
        {
              if(file_exists($attachement))
              {
                //read from the uploaded file & base64_encode content for the mail
               
                $file_name=basename($attachement);
                $encoded_content = chunk_split(base64_encode(file_get_contents($attachement)));
  
                $boundary = md5(time());
                //header
                $headers = "MIME-Version: 1.0\r\n"; 
                $headers .='From: '.$from_name.'<no-reply@xanta-tech.com>' . "\r\n";
                $headers .= "Reply-To: ".$from_mail."" . "\r\n";
                $headers .= "Content-Type: multipart/mixed; boundary = $boundary\r\n\r\n"; 
          
                //plain text 
                $body = "--$boundary\r\n";
                $body .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                $body .= "Content-Transfer-Encoding: base64\r\n\r\n"; 
                $body .= chunk_split(base64_encode($message));          
                //attachment
                $body .= "--$boundary\r\n";
                $body .="Content-Type: $file_type; name=".$file_name."\r\n";
                $body .="Content-Disposition: attachment; filename=".$file_name."\r\n";
                $body .="Content-Transfer-Encoding: base64\r\n";
                $body .="X-Attachment-Id: ".rand(1000,99999)."\r\n\r\n"; 
                $body .= $encoded_content; 
      
               $sentMail = @mail($mailto, $subject, $body, $headers);
               if($sentMail)  
               {
                 $send=1;
                } 
              }
        }
        if (!empty($send)) { 
            return true;
        } else {        
           return false;
        }



    }




}