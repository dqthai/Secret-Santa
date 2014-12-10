<?php
require 'PHPMailer-master/PHPMailerAutoload.php';

/*
 * PHP Secret Santa
 * A very simple PHP based Secret Santa Script.
 *
 *
 * Basic Usage:
 *	$santa = new SecretSanta();
 *	$santa->run(
 *			array(
 *					array('name'=>'Bob','email'=>'bob@bobnet.com'),
 *					array('name'=>'Dave','email'=>'dave@davenet.com')
 *				)
 *			);
 */
Class SecretSanta {
	//Vars
	private $item_value = 5;
	
	/**
	 * Run
	 * runs the secret santa script on an array of users. 
	 * Everyone is assigned their secret santa and emailed with who they need to buy for.
	 * @param $users Array
	 * @return success
	 */
	public function run($users_array){
		//Check array is safe to use
		$ok = $this->validateArray($users_array);
		if(!$ok) return false;
		//If no issues, run!
		$matched = $this->assign_users($users_array);
    $save = print_r($matched, true);
    //echo "$save<br>";
    $this->sendSave($save);
		$this->sendEmails($matched);
		return true;
	}
	
	/**
	 * Validate Array
	 * Ensure array is safe to use in Secret Santa Script
	 * @param Users Array
	 * @return true if safe.
	 */
	private function validateArray($users_array){
		//Ensure that more than 2 users have been provided
		if(sizeof($users_array)<2){
			echo '[Error] A minimum of 2 secret santa participants is required in order to use this system.';
			return false;
		}
		//Check there are no duplicate emails
		$tmp_emails = array();
		foreach($users_array as $u){
			if(in_array($u['email'],$tmp_emails)){
				echo "[Error] Users cannot share an email or be in the secret santa more than once.";
				return false;
			}
			$tmp_emails[] = $u['email'];
		}
		return true;
	}
	
	/**
	 * Set the price secret santa items should be around
	 * @param $price (in £'s)
	 */
	public function setAmount($price){
		$this->item_value = $price;
	}
	
	/**
	 * Assign every user in the array their secret santa
	 * Ensuring that everyone is assigned randomly and doesn't get themselves
	 *
	 * @param array of users
	 * @return array of assigned users
	 */
	private function assign_users($users_array){
		//$users = array(array())
		$givers     = $users_array;
		$receavers  = $users_array;
		//Foreach giver
		foreach($givers as $uid => $user){
			$not_assigned = true;
			//While a user hasn't been assigned their secret santa
			while($not_assigned){
				//Randomly pick a person for the user to buy for
				$choice = rand(0, sizeof($receavers)-1);
				//If randomly picked user is NOT themselves
				if($user['email'] !== $receavers[$choice]['email']){
					//Assign the user the randomly picked user
					$givers[$uid]['giving_to'] = $receavers[$choice];
					//And remove them from the list
					unset($receavers[$choice]);
					//Correct array
					$receavers = array_values($receavers);
					//exit loop
					$not_assigned = false;
				}else{
					//If we are the laster user left and have been given ourselfs
					if(sizeof($receavers) == 1){
						//Swap with someone else (in this case the first guy who got assigned.
						//Steal first persons, person and give self to them.
						$givers[$uid]['giving_to'] = $givers[0]['giving_to'];
						$givers[0]['giving_to'] = $givers[$uid];
						$not_assigned = false;
					} 
				}
			}
		}
		//Return array of matched users
		return $givers;
	}
	
	/**
	 * Send Emails
	 * Emails all matched users with details of who they should be buying for.
	 * @param $matched users
	 */
	private function sendEmails($assigned_users){
		//For each user
		foreach($assigned_users as $giver){
        $mail = new PHPMailer;

        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host = 'smtp.mailgun.org';                     // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = 'postmaster@app31198679.mailgun.org';   // SMTP username
        $mail->Password = 'b3144f3ea73261ff891b103fc31108e0';                           // SMTP password
        $mail->SMTPSecure = 'tls';                            // Enable encryption, only 'tls' is accepted

        $mail->From = 'me@app31198679.mailgun.org';
        $mail->FromName = 'Santa Claus';
        $mail->addAddress($giver['email']);                 // Add a recipient

        $mail->WordWrap = 50;                                 // Set word wrap to 50 characters

        $mail->Subject = 'Secret Santa';
        $name = $giver['giving_to']['name'];
        $mail->Body    = "Merry Christmas, for secret santa you are buying a gift for $name.  The price limit is $item_value";

        if(!$mail->send()) {
            echo 'Message could not be sent.<br>';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        } else {
            echo "Message has been sent to {$giver['email']}<br>";
        }
    }	
 }
 private function sendSave($save){
      $mail = new PHPMailer;

        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host = 'smtp.mailgun.org';                     // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = 'postmaster@app31198679.mailgun.org';   // SMTP username
        $mail->Password = 'b3144f3ea73261ff891b103fc31108e0';                           // SMTP password
        $mail->SMTPSecure = 'tls';                            // Enable encryption, only 'tls' is accepted

        $mail->From = 'me@app31198679.mailgun.org';
        $mail->FromName = 'Santa Claus List';
        $mail->addAddress('dthai1994@gmail.com');                 // Add a recipient

        $mail->WordWrap = 50;                                 // Set word wrap to 50 characters

        $mail->Subject = 'Secret Santa';
        $mail->Body    = "$save";

        if(!$mail->send()) {
            echo 'Message could not be sent.<br>';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        } 
 }
}
