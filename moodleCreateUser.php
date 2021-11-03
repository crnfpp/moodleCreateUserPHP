<?php
require_once("./MoodleRest.php");
//https://github.com/llagerlof/MoodleRest
// Parameters
$uri = "YOUR_MOODLE_INSTALLATION_URL/webservice/rest/server.php"; // Url of your service
$token = "YOUR_TOKEN"; // Auth token
$username = "USER.I.WANT.TO.CREATE"; // Required
$firstname = "FIRSTNAME"; // Required
$lastname = "LASTNAME"; // Required
$mail = "YOUR_USER@EMAIL.SOMETHING"; // Required
$SOME_CUSTOM_FIELD_VALUE = "1234"; // Just as an example
// 
$auth = "shibboleth"; // or just skip this
$SOME_CUSTOM_FIELD_LABEL = "MY-CUSTOM-FIELD";
$MoodleRest = new MoodleRest(); // Let's setup the call
// Setting URI and Token in our MoodleRest API
$MoodleRest->setServerAddress($uri);
$MoodleRest->setToken($token);
// Handling parameters based on the Moodle documentation
$new_user = array('users' => array(array('username' => $username, 'auth' => $auth, 'firstname' => $firstname, 'lastname' => $lastname,'email'=> $mail,'customfields' => array((array('type'=>$SOME_CUSTOM_FIELD_LABEL,'value'=> $SOME_CUSTOM_FIELD_VALUE))))));
//debug on-off
$MoodleRest->setDebug();
// Doing the REST call
$return = $MoodleRest->request('core_user_create_users', $new_user, MoodleRest::METHOD_POST);
// Now some basic response/error handling. If return is 0 everything is ok! 
// Else print "Something was wrong". It's possibile to user $return to populate an e-mail to know if something went wrong.
if ($return[0]['id']): print('ok');
        else: print('something was wrong');
endif;
?>
