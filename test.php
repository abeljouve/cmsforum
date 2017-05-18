<?php

/* Validate an email address. */
function jValidateEmailUsingSMTP($sToEmail, $sFromDomain = "gmail.com", $sFromEmail = "email@gmail.com", $bIsDebug = false) {

    $bIsValid = true; // assume the address is valid by default..
    $aEmailParts = explode("@", $sToEmail); // extract the user/domain..
    getmxrr($aEmailParts[1], $aMatches); // get the mx records..

    if (sizeof($aMatches) == 0) {
        return false; // no mx records..
    }

    foreach ($aMatches as $oValue) {

        if ($bIsValid && !isset($sResponseCode)) {

            // open the connection..
            $oConnection = @fsockopen($oValue, 25, $errno, $errstr, 30);
            $oResponse = @fgets($oConnection);

            if (!$oConnection) {

                $aConnectionLog['Connection'] = "ERROR";
                $aConnectionLog['ConnectionResponse'] = $errstr;
                $bIsValid = false; // unable to connect..

            } else {

                $aConnectionLog['Connection'] = "SUCCESS";
                $aConnectionLog['ConnectionResponse'] = $errstr;
                $bIsValid = true; // so far so good..

            }

            if (!$bIsValid) {

                if ($bIsDebug) print_r($aConnectionLog);
                return false;

            }

            // say hello to the server..
            fputs($oConnection, "HELO $sFromDomain\r\n");
            $oResponse = fgets($oConnection);
            $aConnectionLog['HELO'] = $oResponse;

            // send the email from..
            fputs($oConnection, "MAIL FROM: <$sFromEmail>\r\n");
            $oResponse = fgets($oConnection);
            $aConnectionLog['MailFromResponse'] = $oResponse;

            // send the email to..
            fputs($oConnection, "RCPT TO: <$sToEmail>\r\n");
            $oResponse = fgets($oConnection);
            $aConnectionLog['MailToResponse'] = $oResponse;

            // get the response code..
            $sResponseCode = substr($aConnectionLog['MailToResponse'], 0, 3);
            $sBaseResponseCode = substr($sResponseCode, 0, 1);

            // say goodbye..
            fputs($oConnection,"QUIT\r\n");
            $oResponse = fgets($oConnection);

            // get the quit code and response..
            $aConnectionLog['QuitResponse'] = $oResponse;
            $aConnectionLog['QuitCode'] = substr($oResponse, 0, 3);

            if ($sBaseResponseCode == "5") {
                $bIsValid = false; // the address is not valid..
            }

            // close the connection..
            @fclose($oConnection);

        }

    }

    if ($bIsDebug) {
        print_r($aConnectionLog); // output debug info..
    }

    return $bIsValid;

}
$email = "contaiuytrct@abeljouve.fr";

//var_dump(jValidateEmailUsingSMTP($email, "gmail.com", "email@gmail.com"));

var_dump(parse_url($_SERVER['REQUEST_URI']));
