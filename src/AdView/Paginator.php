<?php namespace AdView;

class Paginator
{
	/**
	 * @var Request
	 */
	private $request;

	/**
	 * Paginator constructor.
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
	public function getCurrentPage()
	{
		return $this->request->getCurrentPage();
	}

	/**
	 * @return string
	 */
	public function nextPageLink()
	{
		if ($this->request->getCurrentPage() == '' || $this->request->getCurrentPage() <= 0)
		{
			$next_page = $this->request->current_page + 2;

			return '?keyword=' . $this->request->getKeyword() .
			       '&location=' . $this->request->getLocation() .
			       '&current_page=' . $next_page;
		}

		$next_page = $this->request->current_page + 1;

		return '?keyword=' . $this->request->getKeyword() . '&location=' . $this->request->getLocation() . '&current_page=' . $next_page;
	}

	/**
	 * @return string
	 */
	public function previousPageLink()
	{
		if ($this->request->getCurrentPage() == '' || $this->request->getCurrentPage() <= 0)
		{
			$previous_page = $this->current_page = '';

			return '?keyword=' . $this->request->getKeyword() .
			       '&location=' . $this->request->getLocation() .
			       '&current_page=' . $previous_page;
		}

		$previous_page = $this->request->current_page - 1;

		return '?keyword=' . $this->request->getKeyword() .
		       '&location=' . $this->request->getLocation() .
		       '&current_page=' . $previous_page;
	}

}
