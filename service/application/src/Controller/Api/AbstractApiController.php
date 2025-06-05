<?php

namespace Application\Controller\Api;

use Concrete\Core\Controller\AbstractController;
use Concrete\Core\Logging\LoggerFactory;

abstract class AbstractApiController extends AbstractController
{
    public function __construct(protected readonly LoggerFactory $logger)
    {
        parent::__construct();
    }
}
