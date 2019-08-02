<?php 

function subdomain()
{
	if (request()->getHttpHost() != env('APP_ROOT_DOMAIN')) {

        //get subdomain from the hostname
        $subdomain = str_replace('.' . env('APP_ROOT_DOMAIN'), '', request()->getHttpHost());

        return $subdomain;

    }

    return '';
}

function supermaster_phone_number($plus_sign = true)
{
	$supermaster_country_phone_code = $plus_sign ? env('SUPERMASTER_COUNTRY_PHONE_CODE') : str_replace('+', '', env('SUPERMASTER_COUNTRY_PHONE_CODE'));

	$supermaster_phone_number = substr(env('SUPERMASTER_PHONE_NUMBER'), 1);

	return $supermaster_country_phone_code . $supermaster_phone_number;
}

function json_response($response)
{
	return response($response, $response['httpStatusCode'])->header('Content-Type', 'application/json');
}

function nexmo()
{
	$basic  = new \Nexmo\Client\Credentials\Basic(config('services.nexmo.key'), config('services.nexmo.secret'));
    return new \Nexmo\Client($basic);
}

function random_numbers_with_leading_zeros($digits)
{
	return sprintf('%0'.$digits.'d', mt_rand(1, ((pow(10, $digits))-1)));
}

function remove_all_special_characters($string)
{
	return preg_replace('/[^A-Za-z0-9]/', '', $string); // Removes special chars.
}

function characters_limit($string, $limit)
{
	return substr($string, 0, $limit);
}