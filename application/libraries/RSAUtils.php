<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

/**
 * RSA工具类 RSAUtils
 *
 * 基于openssl扩展
 * 加密过程为先RSA加密再base64加密，解密过程为先base64解密再RSA解密
 * 
 * @author		Mc(376780162@qq.com)
 * @date 		2015/4
 */
class RSAUtils
{
	private static $private_key_str = '-----BEGIN RSA PRIVATE KEY-----
MIICWwIBAAKBgQC2U8/A8zuX+EHIK/iTk3V6iHEA+XkksFAdgq0vIlqMOTtwTSG3
j9UtOWO4qU+NiUBoDtW9cXH6zs37ZDSc1Cerfb2IpsA2+hXeGgFw6cGN1Y06GSWP
pHnstUIUY8NK7S7BtGocXs3znqJwv5fMAFWthHE6jeFuJq25xd7j45tO1wIDAQAB
AoGAWYpVeAO724ku/RgjDo6XXiLNpFXgGZWA8s0vMfukDkM5HpCyo0w+u+P4RkLX
78Fc4P2QGGYzPKH9ZJ00fWRvSiPVFlnjnSvBZaK712VRwEBDs4UU7vk0L4I2ctum
pfbNv1e8Q36jSQeWCJFybyP5hxBgJ8tU77p75HuD4ytNjOECQQDY8cvSVR9oYXQj
N+69jGxMrK44By283ML/Yk3966C0NiVxQTTiIfAYz2aePWh07hI/VLElf21cfNHX
8kU+n1KnAkEA1yaieGgTt2sNCUS7J2sF2sWly5dtHGEtEFn0wMbUT8UHBnc/3WcH
/nJPPzJP1MyO/2ifnpNfiOI1jq4SY8mYUQJAU9DXVmPcxo8gN5scec8O6HCuvqbH
XPhNvi1UxI2MgROKU79FlzhVcsBufSRsfwCbvCwUZNBeiCURTcUkS5VycQJAD9fe
evNfEFCnwxj2ly6AXd3UGavq8v4M7XlSVqfNlpoxrD43y7v8kLYmM8cmrcrqdNBl
gK3liRTvULRs0kBUIQJANNRH5PYcdaqSOKLa8ycOSdhV2kX6frSradgTzGcYPA0V
KTKVldQO4YQEmiVIdi3IEAQ45DUAL/xRiDDjpR2Wbw==
-----END RSA PRIVATE KEY-----';

	private static $public_key_str = '-----BEGIN PUBLIC KEY-----
MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQC2U8/A8zuX+EHIK/iTk3V6iHEA
+XkksFAdgq0vIlqMOTtwTSG3j9UtOWO4qU+NiUBoDtW9cXH6zs37ZDSc1Cerfb2I
psA2+hXeGgFw6cGN1Y06GSWPpHnstUIUY8NK7S7BtGocXs3znqJwv5fMAFWthHE6
jeFuJq25xd7j45tO1wIDAQAB
-----END PUBLIC KEY-----';

	private static $private_key;
	private static $public_key;
	private $use_private;

	/**
	 * 构造方法
	 * @param $use_private boolean 是否使用私钥
	 *		否则使用公钥
	 */
	function __construct($use_private = TRUE)
	{
		if($use_private)
		{
			if(self::$private_key === NULL)
				self::$private_key = openssl_pkey_get_private(self::$private_key_str);
		}
		elseif(self::$public_key === NULL)
			self::$public_key = openssl_pkey_get_public(self::$public_key_str);

		$this->use_private = $use_private;
	}

	/**
	 * RSA加密
	 * @param $plaintext string 明文
	 * @return string 密文
	 */
	function encrypt($plaintext)
	{
		$pack = '';
		foreach(str_split($plaintext, 117) as $str)
		{
			$crypted = '';
			if($this->use_private)
				openssl_private_encrypt($str, $crypted, self::$private_key);
			else
				openssl_public_encrypt($str, $crypted, self::$public_key);
			$pack .= $crypted;
		}
		$pack = $this->base64url_encode($pack);
		return $pack;
	}

	/**
	 * RSA解密
	 * @param $ciphertext string 密文
	 * @return string 明文
	 */
	function decrypt($ciphertext)
	{
		$ciphertext = $this->base64url_decode($ciphertext);
		$text = '';
		foreach (str_split($ciphertext, 128) as $str)
		{
			$decrypted = '';
			if($this->use_private)
				openssl_private_decrypt($str, $decrypted, self::$private_key);
			else
				openssl_public_decrypt($str, $decrypted, self::$public_key);
			$text .= $decrypted;
		}
		return $text;
	}

	/**
	 * URL安全的base64加密
	 * @param $data string 明文
	 * @return string 密文
	 */
	function base64url_encode($data)
	{
		return rtrim(strtr(base64_encode($data), '+/', '-_'), '='); 
	}

	/**
	 * URL安全的base64解密
	 * @param $data string 密文
	 * @return string 明文
	 */
	function base64url_decode($data)
	{
		return base64_decode(str_pad(strtr($data, '-_', '+/'), strlen($data) % 4, '=', STR_PAD_RIGHT)); 
	}
}
// END RSAUtils CLASS

/* End of file RSAUtils.php */
/* Location: ./application/libraries/RSAUtils.php */