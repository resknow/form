<?php

use Form\Form;
use Form\JSON;
use Form\Plugin;

/**
 * @subpackage Form
 * @version 2.2.2
 * @package Boilerplate (4.0.0 or higher)
 * @author Chris Galbraith
 */

require_once __DIR__ . '/classes/Plugin.php';
new Plugin();

// Add core filters
require_once __DIR__ . '/inc/filters.php';

// Load Assets
require_once __DIR__ . '/inc/assets.php';

// Include Form Classes
require_once __DIR__ . '/classes/Bundler.php';
require_once __DIR__ . '/classes/Form.php';
require_once __DIR__ . '/classes/JSON.php';

// Include functions
require_once __DIR__ . '/inc/functions.php';

// Include Render functions
require_once __DIR__ . '/inc/render.php';