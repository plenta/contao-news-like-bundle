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

namespace Plenta\NewsLikeBundle\Helper;

use Contao\CoreBundle\Exception\PageNotFoundException;
use Contao\CoreBundle\Framework\ContaoFramework;
use Contao\NewsModel;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RequestStack;

class NewsLikeHelper
{
    public const COOKIE_IDENTIFIER = 'plenta_news_like';

    protected ?string $cookie = null;

    public function __construct(protected RequestStack $requestStack, protected ContaoFramework $framework)
    {
    }

    public function getCookie()
    {
        if (null === $this->cookie) {
            $this->cookie = $this->requestStack->getCurrentRequest()->cookies->get(self::COOKIE_IDENTIFIER, '');
        }

        return $this->cookie;
    }

    public function isLiked($newsId): bool
    {
        $newsItems = explode(',', $this->getCookie());

        return \in_array((string) $newsId, $newsItems, true);
    }

    public function like($newsId): JsonResponse
    {
        $newsModel = $this->framework->getAdapter(NewsModel::class);
        if (!$news = $newsModel->findByPk($newsId)) {
            throw new PageNotFoundException();
        }

        if ($this->isLiked($newsId)) {
            throw new BadRequestException();
        }

        if ($this->getCookie()) {
            $val = $this->getCookie().','.$newsId;
        } else {
            $val = (string) $newsId;
        }

        ++$news->plenta_likes;
        $news->save();

        $response = new JsonResponse(['likes' => $news->plenta_likes]);
        $response->headers->setCookie(new Cookie(self::COOKIE_IDENTIFIER, $val, new \DateTime('+ 1 year')));

        return $response;
    }
}
