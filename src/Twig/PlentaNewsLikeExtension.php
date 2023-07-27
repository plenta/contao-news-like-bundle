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

namespace Plenta\NewsLikeBundle\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

class PlentaNewsLikeExtension extends AbstractExtension
{
    public function getFilters()
    {
        return [
            new TwigFilter('hasLiked', [PlentaNewsLikeRuntime::class, 'hasLiked']),
        ];
    }

    public function getFunctions()
    {
        return [
            new TwigFunction('request_token', [PlentaNewsLikeRuntime::class, 'requestToken']),
        ];
    }
}
