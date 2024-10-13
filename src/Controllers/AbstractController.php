<?php declare(strict_types=1);

namespace App\Agenda\Controllers;

use App\Agenda\Core\Response;
use Symfony\Component\Validator\Validation;

class AbstractController
{
    protected Response $response;
    protected $validator;

    public function __construct()
    {
        $this->response = new Response(get_class($this));
        $this->validator = Validation::createValidatorBuilder()->enableAttributeMapping()->getValidator();
    }
}
