<?php namespace AdView;

class Validator
{
	/**
	 * @param $ip
	 *
	 * @return bool
	 */
	public function isLocalhost($ip)
	{
		return $ip === '127.0.0.1';
	}

	/**
	 * @param $ip
	 *
	 * @return mixed
	 */
	public function isValidIp($ip)
	{
		return filter_var($ip, FILTER_VALIDATE_IP);
	}

	/**
	 * @param $publisher_id
	 *
	 * @return bool
	 */
	public function isValidPublisherId($publisher_id)
	{
		return is_int($publisher_id);
	}
}
