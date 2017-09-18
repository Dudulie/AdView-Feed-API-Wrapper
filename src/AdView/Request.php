<?php namespace AdView;

class Request
{
	public $current_page;
	public $publisher_id;

	private $ip;
	private $keyword;
	private $location;
	private $useragent;
	private $channel;

	/**
	 * @var Validator
	 */
	private $validator;

	/**
	 * @var array
	 */
	private $messages = [
		'invalid_ip'           => 'Invalid IP address provided.',
		'localhost_ip_used'    => 'The IP address provided is 127.0.0.1. The URLs wont validate please use real IP address if testing on live site',
		'invalid_publisher_id' => 'Invalid publisher id has been provided, please make sure it is an integer',
		'no_tracking_set'      => 'Tracking has not been enabled, it can be enabled by invoking enableClickTracking() method. ',
	];

	/**
	 * Request constructor.
	 *
	 * @param Validator $validator
	 */
	public function __construct(Validator $validator)
	{
		$this->validator = $validator;
		$this->init();
	}

	/**
	 * Bootstrap
	 */
	public function init()
	{
		$this->setIp();
		$this->setKeyword();
		$this->setLocation();
		$this->setUseragent();
		$this->setCurrentPage();
	}

	/**
	 * @throws \Exception
	 */
	private function setIp()
	{
		$ip = $_SERVER['REMOTE_ADDR'];

		if ($this->validator->isLocalhost($ip))
		{
			trigger_error($this->getMessage('localhost_ip_used'), E_USER_WARNING);
		}

		if (! $this->validator->isValidIp($ip))
		{
			throw new \Exception($this->getMessage('invalid_ip'));
		}
		$this->ip = $ip;
	}

	private function setKeyword()
	{
		$this->keyword = $this->parseFromGET('keyword');
	}

	private function setLocation()
	{
		$this->location = $this->parseFromGET('location');
	}

	private function setUseragent()
	{
		$this->useragent = $_SERVER['HTTP_USER_AGENT'];
	}

	private function setCurrentPage()
	{
		$this->current_page = $this->parseFromGET('current_page');
	}

	/**
	 * @param $channel
	 */
	public function setChannel($channel)
	{
		$this->channel = $channel;
	}

	/**
	 * @param $publisher_id
	 *
	 * @throws \Exception
	 */
	public function setPublisherId($publisher_id)
	{
		if (! $this->validator->isValidPublisherId($publisher_id))
		{
			throw new \Exception($this->getMessage($this->getMessage('invalid_publisher_id')));
		}

		$this->publisher_id = $publisher_id;
	}

	/**
	 * @return mixed
	 */
	public function getIp()
	{
		return $this->ip;
	}

	/**
	 * @return mixed
	 */
	public function getChannel()
	{
		return $this->channel;
	}

	/**
	 * @return mixed
	 */
	public function getKeyword()
	{
		return $this->keyword;
	}

	/**
	 * @return mixed
	 */
	public function getLocation()
	{
		return $this->location;
	}

	/**
	 * @return mixed
	 */
	public function getUseragent()
	{
		return $this->useragent;
	}

	/**
	 * @return mixed
	 */
	public function getCurrentPage()
	{
		return $this->current_page;
	}

	/**
	 * @return mixed
	 */
	public function getPublisherId()
	{
		return $this->publisher_id;
	}

	/**
	 * @param $key
	 *
	 * @return mixed
	 */
	private function getMessage($key)
	{
		return $this->messages[$key];
	}

	/**
	 * @param $get_parameter
	 *
	 * @return string
	 */
	private function parseFromGET($get_parameter)
	{
		return isset($_GET[$get_parameter]) ? $_GET[$get_parameter] : '';
	}
}
