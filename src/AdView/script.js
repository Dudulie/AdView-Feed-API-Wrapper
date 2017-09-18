 /* Little snippet to disable previous button/link */

$(document).ready(function ()
{
	$current_page = $('#previous_page').data('current-page');

	if ($current_page <= 1 || $current_page == '')
	{
		$('#previous_page').addClass('disabled');
	}
});
