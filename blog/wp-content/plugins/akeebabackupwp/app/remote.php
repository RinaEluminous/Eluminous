<?php
/**
 * @package        solo
 * @copyright Copyright (c)2014-2018 Nicholas K. Dionysopoulos / Akeeba Ltd
 * @license        GNU GPL version 3 or later
 */

/**
 * This file is an alias to index.php
 *
 * Why do we need this?
 *
 * Some servers are configured to rewrite all /index.php addresses without index.php. For example:
 * http://www.example.com/solo/index.php?view=remote&key=something
 * gets rewritten (HTTP 301 redirected) to
 * http://www.example.com/solo/?view=remote&key=something
 * Typically this is not a problem since legacy front-end backup and remote JSON API consumers know how to deal with
 * redirects. But in some rare occasions this redirection will cause a 404 Not Found, presumably because even through
 * the redirection code is in place the server administrator has NOT made index.php the default directory index file.
 *
 * Introducing this file, named remote.php, lets us write the URL above as
 * http://www.example.com/solo/remote.php?view=remote&key=something
 * which will NOT be redirected, therefore solving this issue.
 */

require_once 'index.php';
