<?php namespace AdView;

class FeedApi
{

	const API_URL = 'https://adview.online/api/v1/jobs.json';

	/**
	 * FeedApi constructor.
	 *
	 * @param Request $request
	 */
	public function __construct(Request $request)
	{
		$this->request = $request;
	}

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
		$request = self::API_URL . $query;

		if (! $jobs = @file_get_contents($request))
		{
			throw new \Exception('Failed to connect to API: ' . self::API_URL);
		}

		return $jobs;
	}

	/**
	 * @return string
	 */
	private function formQuery()
	{
		return
			'?publisher=' . $this->request->getPublisherId() .
			'&keyword=' . $this->request->getKeyword() .
			'&location=' . $this->request->getLocation() .
			'&ip=' . $this->request->getIp() .
			'&useragent=' . urlencode($this->request->getUseragent()) .
			'&page=' . $this->request->getCurrentPage();
	}

	/**
	 *
	 */
	public function enableClickTracking()
	{
		$channel = $this->request->getChannel();
		$publisher_id = $this->request->getPublisherId();

		echo '<a target="_blank" href="https://adview.online" title="Job Search">jobs</a> by <a target="_blank" title="Job Search" href="https://adview.online"><img alt="AdView job search" style="border: 0; vertical-align: middle;" src="https://adview.online/job-search.png"></a>' .

		     '<script type="text/javascript" src="https://adview.online/js/pub/tracking.js?publisher="' . $publisher_id . '"&channel="' . $channel . '"EXTERNAL_FRAGMENT&source=feed"></script>';
	}
}


