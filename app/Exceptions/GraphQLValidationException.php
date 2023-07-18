<?php

namespace App\Exceptions;

use Exception;
use Nuwave\Lighthouse\Exceptions\RendersErrorsExtensions;

/**
 * Class GraphQLValidationException.
 */
class GraphQLValidationException extends Exception implements RendersErrorsExtensions
{
    /**
     * @var
     */
    public $errors;

    /**
     * The category.
     *
     * @var string
     */
    protected $category = 'validation';

    /**
     * ValidationException constructor.
     *
     * @param $validator
     * @param string $message
     * @param mixed  $errors
     */
    public function __construct($errors, string $message = '')
    {
        parent::__construct($message);

        $this->errors = $errors;
    }

    /**
     * Returns true when exception message is safe to be displayed to a client.
     *
     * @api
     *
     * @return bool
     */
    public function isClientSafe(): bool
    {
        return true;
    }

    /**
     * @return string
     */
    public function getCategory(): string
    {
        return 'validation';
    }

    /**
     * @return array
     */
    public function extensionsContent(): array
    {
        return ['errors' => $this->errors];
    }
}
