<?php

namespace App\Module\Core\Application\Controller;

use App\Module\Core\Application\Api\Controller\AbstractAppRestController;
use Symfony\Component\HttpFoundation\Response;

final class DefaultController extends AbstractAppRestController
{
    public function index(): Response
    {
        return $this->handleView($this->view());
    }
}
