<?php

/********************************
 * Theme Setup
 ***************************** */
require_once('includes/setup.php'); // Loads theme styles and scripts.

/********************************
 * Theme Functions
 ***************************** */
require_once('includes/functions/calc-readtime.php'); // Loads read time calculator.
require_once('includes/functions/live-search.php'); // Loads live search functions.
require_once('includes/functions/breadcrumbs.php'); // Loads breadcrumbs functions.

/********************************
 * Theme Classes
 ***************************** */

// Loads custom walker class for menu.
require_once('includes/classes/mega-menu.php');
