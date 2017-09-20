<?php namespace AdView;

use GuzzleHttp\Client as Guzzle;
use GuzzleHttp\Exception\RequestException;

class FeedApi extends Request {

	const API_URL = 'https://adview.online/api/v1/jobs.json';

	/**
	 * @return mixed
	 * @throws \Exception
	 */
	public function getJobs()
	{
		$uri = (string)$this->formUri();

		try
		{
			$response = (object)$this->makeRequestToApi($uri);
		}
		catch (RequestException $exception)
		{
			throw new \Exception('Failed to connect to API: ' . self::API_URL);
		}

		$jobs = $response->getBody()->getContents();

		return $this->decodeJobs($jobs)->data;
	}

	/**
	 * @return string
	 */
	private function formUri()
	{
		$query = $this->formQuery();

		return self::API_URL . $query;
	}

	/**
	 * @return string
	 */
	private function formQuery()
	{
		return
			'?publisher=' . $this->getPublisherId() .
			'&keyword=' . $this->getKeyword() .
			'&location=' . $this->getLocation() .
			'&ip=' . $this->getIp() .
			'&useragent=' . urlencode($this->getUseragent()) .
			'&page=' . $this->getCurrentPage();
	}

	/**
	 * @param $jobs
	 *
	 * @return mixed
	 */
	private function decodeJobs($jobs)
	{
		return json_decode($jobs);
	}

	/**
	 * @return string
	 */
	public function generateTrackingScript()
	{
		$channel = $this->getChannel();
		$publisher_id = $this->getPublisherId();

		// TODO: not generating right URI..
		// <script type="text/javascript" src="https://adview.online/js/pub/tracking.js?publisher=" 7"&channel="" &source="feed&quot;"></script>

		return '<a target="_blank" href="https://adview.online" title="Job Search">jobs</a> by <a target="_blank" title="Job Search" href="https://adview.online"><img alt="AdView job search" style="border: 0; vertical-align: middle;" src="https://adview.online/job-search.png"></a>' .

		       '<script type="text/javascript" src="https://adview.online/js/pub/tracking.js?publisher="' . $publisher_id . '"&channel="' . $channel . '"&source=feed"></script>';
	}

	public static function create()
	{
		return new self(new Validator(), new Guzzle());
	}
}


