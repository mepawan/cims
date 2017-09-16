<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('secure_random_int'))
{
	// http://php.net/manual/en/function.openssl-random-pseudo-bytes.php#104322
	function secure_random_int($min=0,$max=32)
	{
		$range = $max - $min;
		if ($range == 0) return $min; // not so random...
		$log = log($range, 2);
		$bytes = (int) ($log / 8) + 1; // length in bytes
		$bits = (int) $log + 1; // length in bits
		$filter = (int) (1 << $bits) - 1; // set all lower bits to 1
		do {
		    $rnd = hexdec(bin2hex(openssl_random_pseudo_bytes($bytes, $s)));
		    $rnd = $rnd & $filter; // discard irrelevant bits

		    if($s === FALSE)
		    {
		    	throw new Exception("openssl_random_pseudo_bytes generated non secure bytes!");
		    }

		} while ($rnd >= $range);
		return $min + $rnd;
	}
}

if ( ! function_exists('secure_random_string'))
{
	function secure_random_string($type = 'alnum', $len = 8)
	{
		switch($type)
		{
			case 'basic'	: return mt_rand();
				break;
			case 'alnum'	:
			case 'numeric'	:
			case 'nozero'	:
			case 'alpha'	:

					switch ($type)
					{
						case 'alpha'	:	$pool = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
							break;
						case 'alnum'	:	$pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
							break;
						case 'numeric'	:	$pool = '0123456789';
							break;
						case 'nozero'	:	$pool = '123456789';
							break;
					}

					$str = '';
					for ($i=0; $i < $len; $i++)
					{
						$str .= substr($pool, secure_random_int(0, strlen($pool) -1), 1);
					}
					return $str;
				break;
			case 'unique'	:
			case 'md5'		:

						return md5(uniqid(secure_random_int()));
				break;
			case 'encrypt'	:
			case 'sha1'	:

						$CI =& get_instance();
						$CI->load->helper('security');

						return do_hash(uniqid(secure_random_int(), TRUE), 'sha1');
				break;
		}
	}
}
