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

namespace Plenta\NewsLikeBundle\Controller;

use Contao\CoreBundle\Controller\AbstractController;
use Plenta\NewsLikeBundle\Helper\NewsLikeHelper;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

#[Route('_plenta')]
class AjaxController extends AbstractController
{
    #[Route('/news/like', methods: ['POST'])]
    public function likeNews(Request $request, NewsLikeHelper $helper)
    {
        if (!$newsId = $request->request->get('newsId')) {
            throw new BadRequestException();
        }

        return $helper->like($newsId);
    }
}
