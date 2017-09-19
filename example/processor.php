<?PHP

include __DIR__ . '/../vendor/autoload.php';

use AdView\FeedApi;
use AdView\Paginator;

$feed_api = FeedApi::create();
$paginator = Paginator::create($feed_api);

$feed_api->setPublisherId(7);
$feed_api->setChannel('sidebar');

$jobs = $feed_api->getJobs();
