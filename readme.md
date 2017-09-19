## AdView Feed API Implementation

**Simple wrapper to help you interact with AdView Feed API. This will take care of reading required input like 'keyword', 'location' and automatically bootstrap other required data like useragent, user IP etc.., aswell as setting pagination.**

For usage examples refer to `adview/adview-feedapi/example/processor.php` and `adview/adview-feedapi/example/index.php` and also feel free to browse through `adview/src/AdView` for publicly available methods. If you'd like to try it out as is then copy contents of `adview/adview-feedapi/example/` to root directory of your project.

Note that this has'nt been tested on production so make sure you fully test everything before and after going live. Use at own risk.


**Example 1:**
```PHP
include  __DIR__  . '/../vendor/autoload.php';

use AdView\FeedApi;
use AdView\Paginator;

/* Create instances */
$feed_api = FeedApi::create();
$paginator = Paginator::create($feed_api);

/*
 * Set data.
 * Note that system will automatically set useragent and IP address.
 */
$feed_api->setPublisherId(7);
$feed_api->setChannel('sidebar');

/* Enable tracking. Tracking must always be enabled
 * It will automatically echo script code to whatever page this method in invoked on.
 */
$feed_api->enableClickTracking();

/* Get generated links
 * These links can be used to create pagination.
 * For example: <a href="<?PHP echo $paginator->previousPageLink(); ?>">Previous</a>
 */
$paginator->previousPageLink();
$paginator->nextPageLink();
$paginator->getCurrentPage();

/* Get data
 * Many uses for example echoing it in the HTML form for users convenience.
 */
$feed_api->getKeyword();
$feed_api->getLocation();
```

**Example 2:**
	```
  <?PHP include __DIR__ . '/processor.php'; ?>
	<!-- Loop through and show the jobs on site -->
	<?PHP foreach ($jobs as $job): ?>
    <h4>
      <a onmousedown="<?PHP echo $job->onmousedown ?>" href="<?PHP echo $job->url ?>">
        <?PHP echo $job->title; ?>
      </a>
    </h4>
    <h5> <?PHP echo $job->snippet; ?> </h5>
    <span class="fa fa-compass"> <?PHP echo $job->location; ?>  </span>
    <hr>
	<?PHP endforeach; ?>
  ```
