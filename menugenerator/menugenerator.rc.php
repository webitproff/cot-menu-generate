<?php
/* ====================
[BEGIN_COT_EXT]
Hooks=rc
[END_COT_EXT]
==================== */

/**
 * Menu Generator for Cotonti CMF
 */
defined('COT_CODE') or die('Wrong URL');

if(cot::$cfg['plugin']['menugenerator']['css']) {
    Resources::addFile(cot::$cfg['plugins_dir'] . '/menugenerator/tpl/menugenerator.css', 'css');
}