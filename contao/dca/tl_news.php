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

$GLOBALS['TL_DCA']['tl_news']['fields']['plenta_likes'] = [
    'eval' => [
        'doNotCopy' => true,
    ],
    'sql' => 'int(10) UNSIGNED NOT NULL default 0',
];
