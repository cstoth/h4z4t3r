<?php

	function send_message($from, $to, $message, $access_token, $api_key) {
		$STREAM_XML = "<?xml version='1.0'?>". 
		  "<stream:stream ".
		  "from='-".$from."@chat.facebook.com' ".
		  "to='chat.facebook.com' ".
		  "version='1.0' ".
		  "xml:lang='en' ".
		  "xmlns='jabber:client' ".
		  "xmlns:stream='http://etherx.jabber.org/streams'>";
		  
		$START_TLS = "<starttls xmlns='urn:ietf:params:xml:ns:xmpp-tls'/>";
		
		$AUTH_XML = "<auth xmlns='urn:ietf:params:xml:ns:xmpp-sasl' ".
		  "mechanism='X-FACEBOOK-PLATFORM'></auth>";

		$RESOURCE_XML = "<iq id='0' type='set'>".
		  "<bind xmlns='urn:ietf:params:xml:ns:xmpp-bind'/></iq>";

		$MESSAGE_XML = "<message to='-".$to."@chat.facebook.com'>".
		   "<body>".$message."</body></message>";
		   
		$SESSION_XML = "<iq type='set' id='1' to='chat.facebook.com'>".
		  "<session xmlns='urn:ietf:params:xml:ns:xmpp-session'/></iq>";
		
		$CLOSE_XML = "</stream:stream>";

		$fp = stream_socket_client("chat.facebook.com:5222");
		if (!$fp) {
			return false;
		}
		fwrite($fp, $STREAM_XML);
		$finish = false;
		$status = "INIT";
		do
		{
			$xml = fread($fp,4096);
			$xml_parser = xml_parser_create();
			xml_parse_into_struct($xml_parser, $xml, $val, $index);
			xml_parser_free($xml_parser);
			if (array_key_exists("MECHANISM", $index) && $status == "INIT")
			{
				//init TLS
				fwrite($fp, $START_TLS);
				$status = "TLS-INIT";
				continue;
			}
			if (array_key_exists("PROCEED", $index) && $status == "TLS-INIT")
			{
				//finit TLS
				stream_socket_enable_crypto($fp, true, STREAM_CRYPTO_METHOD_TLS_CLIENT);
				fwrite($fp, $STREAM_XML);
				$status = "TLS";
				continue;
			}
			if (array_key_exists("MECHANISM", $index) && $status == "TLS")
			{
				//authorize
				fwrite($fp, $AUTH_XML);
				$status = "AUTH-STEP1";
				continue;
			}
			if (array_key_exists("CHALLENGE", $index) && $status == "AUTH-STEP1")
			{
				//respond to challenge
				$challenge = $val[$index["CHALLENGE"][0]]["value"];
				$challenge = base64_decode($challenge);
				$challenge = urldecode($challenge);
				parse_str($challenge, $challenge_array);

				// creates the response array
				$resp_array = array(
				'method' => $challenge_array['method'],
				'nonce' => $challenge_array['nonce'],
				'access_token' => $access_token,
				'api_key' => $api_key,
				'call_id' => 0,
				'v' => '1.0',
				);
				// creates signature
				$response = http_build_query($resp_array);
				// sends the response and waits for success
				$resp = '<response xmlns="urn:ietf:params:xml:ns:xmpp-sasl">'.
				base64_encode($response).'</response>';
				fwrite($fp, $resp);
				$status = "AUTH-STEP2";
				continue;
			}
			if (array_key_exists("SUCCESS", $index) && $status == "AUTH-STEP2")
			{
				//prepare stream
				fwrite($fp, $STREAM_XML);
				$status = "INIT-STREAM";
				continue;
			}
			if (array_key_exists("STREAM:FEATURES", $index) && $status == "INIT-STREAM")
			{
				//prepare resource
				fwrite($fp, $RESOURCE_XML);
				$status = "INIT-RESOURCE";
				continue;
			}
			if (array_key_exists("JID", $index) && $status == "INIT-RESOURCE")
			{
				//prepare session
				fwrite($fp, $SESSION_XML);
				$status = "INIT-SESSION";
				continue;				 
			}
			if (array_key_exists("SESSION", $index) && $status == "INIT-SESSION")
			{
				//send message
				fwrite($fp, $MESSAGE_XML);
				$status = "MESSAGE-SEND";
				continue;
			}
			if ($status == "MESSAGE-SEND")
			{
				//close connection
				fwrite($fp, $CLOSE_XML);
				fclose($fp);
				$finish = true;
			}
			if (array_key_exists("FAILURE", $index))
			{
				return false;
			}
			if (array_key_exists("ERROR", $index))
			{
				return false;
			}
			if (array_key_exists("STREAM:ERROR", $index))
			{
				return false;
			}		
			
			
		}while(!$finish);
		
		return true;
	}

function _main() {
  
  $app_id='HERE_GOES_YOUR_APPID';
  $fromuid = 'HERE_GOES_YOUR_USER_ID';
  $touid = 'HERE_GOES_THE_USER_ID_TO_WHICH_YOU_WANT_TO_SEND_A_MESSAGE';
  $access_token = "HERE_GOES_THE_ACCESS_TOKEN";

  if (send_message($fromuid,$touid,"This is a message", $access_token, $app_id)) {
    print "Done\n";
  } else {
    print "An error ocurred\n";
  }

}

_main();
