<?PHP

include __DIR__ . '/../vendor/autoload.php';

use AdView\FeedApi;
use AdView\Request;
use AdView\Validator;
use AdView\Paginator;

/*
 * We will automatically read following values form the URL
 * $_GET['keyword'], $_GET['location] and $_GET['current_page'];
*/

/*
 * Create new request instance and inject validator
 */
$request = new Request(new Validator);

/*
 * Set publisher ID
 */
$request->setPublisherId(7);

/*
 * Set your channel name.
 */
$request->setChannel('sidebar');

/*
 * Start feed API creator and pass the request
 */
$feed_api = new FeedApi($request);

/*
 * Lets get the jobs form AdView Feed API.
 */
$jobs = $feed_api->getJobs();

/*
 * Create a Paginator instance
 */
$paginator = new Paginator($request);
