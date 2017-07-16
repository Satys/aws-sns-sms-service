<?php 
	
	include 'vendor/autoload.php';
	use Aws\Sns\SnsClient;

	function send_message($phone, $message) {
		$client = new SnsClient([
					    'version'     => 'latest',
					    'region'      => 'us-west-2',
					    'credentials' => [
					        'key'    => 'KEY',
					        'secret' => 'SECRET KEY',
					    ],
					]);
		$options = array(
				'MessageAttributes' => array(
					'AWS.SNS.SMS.SenderID' => array(
		                'DataType' => 'String',
		                'StringValue' =>  'SenderID'
	            	),
					'AWS.SNS.SMS.SMSType' => array(
		                'DataType' => 'String',
		                'StringValue' =>  'SMSType' // Transactional/Promotional
	            	)
				),	
				'Message' => $message,
				'PhoneNumber' => $phone
			);
		$result = $client->publish($options);
		return $result;
	}
?>