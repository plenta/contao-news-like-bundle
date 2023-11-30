<?php

declare(strict_types=1);

/**
 * Plenta News Like Bundle for Contao Open Source CMS
 *
 * @copyright     Copyright (c) 2023, Plenta.io
 * @author        Plenta.io <https://plenta.io>
 * @license       http://opensource.org/licenses/lgpl-3.0.html
 * @link          https://github.com/plenta/
 */

use Contao\System;

$GLOBALS['TL_BODY']['PLENTA_NEWS_LIKE_JS'] = '<script src="'.System::getContainer()->get('assets.packages')->getUrl('plentanewslike/layout.js', 'plentanewslike').'" defer></script>';
