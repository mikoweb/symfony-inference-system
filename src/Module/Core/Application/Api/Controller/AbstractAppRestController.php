<?php

namespace App\Module\Core\Application\Api\Controller;

use App\Module\Core\Application\Api\Controller\Trait\CreateErrorViewTrait;
use App\Module\Core\Application\Api\Controller\Trait\CreateSuccessViewTrait;
use FOS\RestBundle\Controller\AbstractFOSRestController;

abstract class AbstractAppRestController extends AbstractFOSRestController
{
    use CreateSuccessViewTrait;
    use CreateErrorViewTrait;

    protected const string COMMON_EXCEPTION_MESSAGE = 'Something went wrong...';
}
