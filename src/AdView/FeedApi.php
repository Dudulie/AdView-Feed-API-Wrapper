<?php namespace AdView;

use GuzzleHttp\Client as Guzzle;
use GuzzleHttp\Exception\RequestException;

class FeedApi extends Request
{

	const API_URL = 'https://adview.online/api/v1/jobs.json';

	/**
	 * @return mixed
	 */
	public function getJobs()
	{
		$jobs = $this->sendRequest();

		return $this->decodeJobs($jobs)->data;
	}

	private function decodeJobs($jobs)
	{
		return json_decode($jobs);
	}

	/**
	 * @return string
	 * @throws \Exception
	 */
	public function sendRequest()
	{
		$query = $this->formQuery();
		$uri = self::API_URL . $query;

		try
		{
			$jobs = $this->guzzle->request('GET', $uri, ['connect_timeout' => 5]);
		}
		catch (RequestException $exception)
		{
			throw new \Exception('Failed to connect to API: ' . self::API_URL);
		}

		return $jobs->getBody()->getContents();
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

	public function enableClickTracking()
	{
		$channel = $this->getChannel();
		$publisher_id = $this->getPublisherId();

		echo '<a target="_blank" href="https://adview.online" title="Job Search">jobs</a> by <a target="_blank" title="Job Search" href="https://adview.online"><img alt="AdView job search" style="border: 0; vertical-align: middle;" src="https://adview.online/job-search.png"></a>' .

		     '<script type="text/javascript" src="https://adview.online/js/pub/tracking.js?publisher="' . $publisher_id . '"&channel="' . $channel . '"EXTERNAL_FRAGMENT&source=feed"></script>';
	}

	public static function create()
	{
		return new self(new Validator(), new Guzzle());
	}
}


