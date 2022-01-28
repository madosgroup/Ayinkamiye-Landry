<?php
if (!defined('BASEPATH'))

exit('No direct script access allowed'); 

class Notifications

{

	protected $CI;
	public function __construct()

	{

	    $this->CI = & get_instance();

      $this->CI->load->library('email');

      $this->CI->load->model('Model');

      //$this->CI->load->library('TestQrcode');

	}



 public function send_mail_old($emailTo,$subjet,$cc_emails=NULL,$message,$attach=NULL)

   {  



 $config['protocol'] = 'sendmail';

        $config['smtp_host'] = '154.117.208.227';

        $config['mailpath'] = '/usr/sbin/sendmail';

        $config['charset'] = 'utf-8';

        $config['mailtype'] = 'html';

        $config['priority'] = '1';

        $config['wordwrap'] = TRUE;

        $this->CI->email->initialize($config);



        // Load email library and passing configured values to email library 

        $this->CI->load->library('email', $config);

        $this->CI->email->set_newline("\r\n");



        $this->CI->email->from('helpdesk_comesa@mediabox.bi', 'COMESA 2018');

        $this->CI->email->to($emailTo);

        $this->CI->email->bcc('ismael@mediabox.bi');



          if (!empty($cc_emails)) {

          foreach ($cc_emails as $key => $value) {

          $this->CI->email->cc($value);

          }

          }

         

        $this->CI->email->subject($subjet);

        $this->CI->email->message($message);

        

        if(!empty($attach))

          {

            $this->email->attach($attach);

         }



        if (!$this->CI->email->send()) {

            show_error($this->CI->email->print_debugger());

        } else

            echo $this->CI->email->print_debugger();









} 



function rungika($emailTo = array(), $subjet, $cc_emails = array(), $message, $attach = array()) {

      $config['protocol'] = 'smtp';
      $config['smtp_host'] = 'ssl://web40.lws-hosting.com';
      $config['smtp_port'] = 465;
      $config['smtp_user'] = 'info@ciidcommunity.org';
      $config['smtp_pass'] = 'info@ciidcommunity.org';
      $config['mailtype'] = 'html';
      $config['charset'] = 'UTF-8';
      $config['wordwrap'] = TRUE;
      $config['smtp_timeout'] = 20;
      $config['newline'] = "\r\n";
      $this->CI->email->initialize($config);
      $this->CI->email->set_mailtype("html");

  
      $this->CI->email->from('info@ciidcommunity.org', 'Volcano Express');
      $this->CI->email->to($emailTo);
      $this->CI->email->bcc('ruvumu125@gmail.com');
      if (!empty($cc_emails)) {
          foreach ($cc_emails as $key => $value) {
              $this->CI->email->cc($value);
          }
      }
      $this->CI->email->subject($subjet);
      $this->CI->email->message($message);

      if (!empty($attach)) {
          foreach ($attach as $att)
              $this->CI->email->attach($att);
      }
      if (!$this->CI->email->send()) {
          show_error($this->CI->email->print_debugger());
      } 
          else;
     // echo $this->CI->email->print_debugger();
  }

function send_mail($emailTo = array(), $subjet, $cc_emails = array(), $message, $attach = array()) {



        $config['protocol'] = 'smtp';

        $config['smtp_host'] = 'ssl://twiga.afriregister.co.ke';

        $config['smtp_port'] = 465;

        $config['smtp_user'] = 'helpdesk_comesa@mediabox.bi';

        $config['smtp_pass'] = 'mediabox@comesa2018';

        $config['mailtype'] = 'html';

        $config['charset'] = 'UTF-8';

        $config['wordwrap'] = TRUE;

        $config['smtp_timeout'] = 20;

        $config['newline'] = "\r\n";

        $this->CI->email->initialize($config);

        $this->CI->email->set_mailtype("html");



    

        $this->CI->email->from('helpdesk_comesa@mediabox.bi', 'COMESA HelpDesk');

        $this->CI->email->to($emailTo);

        $this->CI->email->bcc('ismael@mediabox.bi');

        if (!empty($cc_emails)) {

            foreach ($cc_emails as $key => $value) {

                $this->CI->email->cc($value);

            }

        }

        $this->CI->email->subject($subjet);

        $this->CI->email->message($message);



        if (!empty($attach)) {

            foreach ($attach as $att)

                $this->CI->email->attach($att);

        }

        if (!$this->CI->email->send()) {

            show_error($this->CI->email->print_debugger());

        } 

            else;

       // echo $this->CI->email->print_debugger();

    }





   public function smtp_mail($emailTo,$subjet,$cc_emails=NULL,$message,$attach=NULL)

   {     

        $this->CI = & get_instance();

        $this->CI->load->library('email');

        $config['protocol'] = 'smtp';

        //$config['smtp_crypto'] = 'tls';

        $config['smtp_host'] = 'ssl://twiga.afriregister.co.ke';

        $config['smtp_port'] = 465;

        $config['smtp_user'] = 'helpdesk_comesa@mediabox.bi';

        $config['smtp_pass'] = 'mediabox@comesa2018';

        $config['mailtype'] = 'html';

        $config['charset'] = 'UTF-8';

        $config['wordwrap'] = TRUE;

        $config['smtp_timeout'] = 20;

       // $config['priority'] = '1';









        $this->CI->email->initialize($config);

        $this->CI->email->set_mailtype("html");



        // Load email library and passing configured values to email library 

        $this->CI->load->library('email', $config);

        $this->CI->email->set_newline("\r\n");



        $this->CI->email->from('helpdesk_comesa@mediabox.bi', 'COMESA 2018');

        $this->CI->email->to($emailTo);

        $this->CI->email->bcc('ismael@mediabox.bi');



          if (!empty($cc_emails)) {

          foreach ($cc_emails as $key => $value) {

          $this->CI->email->cc($value);

          }

          }

         

        $this->CI->email->subject($subjet);

        $this->CI->email->message($message);

        

        if(!empty($attach))

          {

            $this->email->attach($attach);

         }



        if (!$this->CI->email->send()) {

            show_error($this->CI->email->print_debugger());

        } else

            echo $this->CI->email->print_debugger();

   }



   public function send_sms($string_tel = NULL,$string_msg)

   {

        $data = '{"urns": ["' . $string_tel . '"],"text":"' . $string_msg . '"}';



        $header = array();

        $header [0] = 'Authorization:Token  cf150b1b05d22711f82b8d1d51b1cfc2b7c32624';  //pas d'espace entre Authori et : et Token

        $header [1] = 'Content-Type:application/json';

        $curl = curl_init();



        curl_setopt($curl, CURLOPT_URL, 'https://sms.ubuviz.com/api/v2/broadcasts.json');

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        curl_setopt($curl, CURLOPT_POST, true);

        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

        curl_setopt($curl, CURLOPT_HTTPHEADER, $header);

        $result = curl_exec($curl);

       // $result = json_decode($result);



        return $result;

   }



   public function generate_password($taille)

   {

     $Caracteres = 'ABCDEFGHIJKLMOPQRSTUVXWYZ0123456789'; 

      $QuantidadeCaracteres = strlen($Caracteres); 

      $QuantidadeCaracteres--; 



      $Hash=NULL; 

        for($x=1;$x<=$taille;$x++){ 

            $Posicao = rand(0,$QuantidadeCaracteres); 

            $Hash .= substr($Caracteres,$Posicao,1); 

        }



        return $Hash; 

   }

   public function generate_numbers($taille)

   {

     $Caracteres = '0123456789'; 

      $QuantidadeCaracteres = strlen($Caracteres); 

      $QuantidadeCaracteres--; 



      $Hash=NULL; 

        for($x=1;$x<=$taille;$x++){ 

            $Posicao = rand(0,$QuantidadeCaracteres); 

            $Hash .= substr($Caracteres,$Posicao,1); 

        }



        return $Hash; 

   }



   public function generate_UIID($taille)

   {

     $Caracteres = 'ABCDEFGHIJKLMOPQRSTUVXWYZ0123456789'; 

      $QuantidadeCaracteres = strlen($Caracteres); 

      $QuantidadeCaracteres--; 



      $Hash=NULL; 

        for($x=1;$x<=$taille;$x++){ 

            $Posicao = rand(0,$QuantidadeCaracteres); 

            $Hash .= substr($Caracteres,$Posicao,1); 

        }



        return $Hash; 

   }



   public function notifierLogistique($sms = NULL,$email=NULL,$subject=NULL,$code)

   {

       $logitics = $this->CI->Model->getList('logistique');

      

       foreach ($logitics as $logist) {

        $infos = $logist['DESCR'].' '.$email." <b>#".$logist['LOGISTIQUE_CODE']."#".$code."#</b>".' <br>Cordialement';

        $this->send_mail($logist['EMAIL'],$subject,NULL,$infos,NULL); 



        $sms_tot = $logist['DESCR'].' '.$sms."#".$logist['LOGISTIQUE_CODE']."#".$code."#. Cordialement";



        $tel_str = "tel:".$logist['TEL'];

        $this->send_sms($tel_str,$sms_tot);



        $infos = NULL;

        $sms_tot = NULL;       

       }



   }

   public function generateQrcode($data,$name){

      if(!is_dir('uploads/QRCODE')) //create the folder if it does not already exists   

       {

          mkdir('uploads/QRCODE',0777,TRUE);

       }



      $Ciqrcode = new Ciqrcode();

      $params['data'] = $data;

      $params['level'] = 'H';

      $params['size'] = 10;

      $params['overwrite'] = TRUE;

      $params['savename'] = FCPATH . 'uploads/QRCODE/' . $name . '.png';

      $Ciqrcode->generate($params);

   }



}

