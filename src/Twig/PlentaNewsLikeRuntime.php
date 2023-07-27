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

use Contao\CoreBundle\Csrf\ContaoCsrfTokenManager;
use Plenta\NewsLikeBundle\Helper\NewsLikeHelper;
use Twig\Extension\RuntimeExtensionInterface;

class PlentaNewsLikeRuntime implements RuntimeExtensionInterface
{
    public function __construct(
        protected ContaoCsrfTokenManager $tokenManager,
        protected NewsLikeHelper $newsLikeHelper,
    ) {
    }

    public function hasLiked(array $news)
    {
        return $this->newsLikeHelper->isLiked($news['id']) ? 'liked' : 'not-liked';
    }

    public function requestToken()
    {
        return $this->tokenManager->getDefaultTokenValue();
    }
}
