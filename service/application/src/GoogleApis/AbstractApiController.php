<?php

namespace Application\GoogleApis;

use Concrete\Core\Controller\AbstractController;
use Concrete\Core\Logging\LoggerFactory;
use Symfony\Component\Serializer\Serializer;

abstract class AbstractApiController extends AbstractController
{
    public function __construct(
        protected readonly Serializer $serializer,
        protected readonly LoggerFactory $logger
    )
    {
        parent::__construct();
    }
}
