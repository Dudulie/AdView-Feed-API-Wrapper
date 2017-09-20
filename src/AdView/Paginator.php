<?php namespace AdView;

class Paginator
{

	/**
	 * @var FeedApi
	 */
	private $feed_api;

	/**
	 * Paginator constructor.
	 *
	 * @param FeedApi $feed_api
	 */
	public function __construct(FeedApi $feed_api)
	{
		$this->feed_api = $feed_api;
	}

	/**
	 * @return mixed
	 */
	public function getCurrentPage()
	{
		return $this->feed_api->getCurrentPage();
	}

	/**
	 * @return string
	 */
	public function nextPageLink()
	{
		if ($this->getCurrentPage() === '')
		{
			$next_page = $this->feed_api->current_page + 2;

			return $this->generateLink((int) $next_page);
		}

		$next_page = $this->feed_api->current_page + 1;

		return $this->generateLink((int) $next_page);
	}

	/**
	 * @return string
	 */
	public function previousPageLink()
	{
		if ($this->getCurrentPage() === '')
		{
			$previous_page = $this->current_page = '';

			return $this->generateLink((int) $previous_page);
		}

		$previous_page = $this->feed_api->current_page - 1;

		return $this->generateLink((int) $previous_page);
	}

	/**
	 * @param $to_which_page
	 *
	 * @return string
	 */
	private function generateLink($to_which_page)
	{
		return '?keyword=' . $this->feed_api->getKeyword() .
		       '&location=' . $this->feed_api->getLocation() .
		       '&current_page=' . $to_which_page;
	}

	/**
	 * @param FeedApi $feed_api
	 *
	 * @return Paginator
	 */
	public static function create(FeedApi $feed_api)
	{
		return new self($feed_api);
	}

}
