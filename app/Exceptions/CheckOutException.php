<?php

namespace App\Exceptions;

use Exception;

class CheckOutException extends Exception
{
    public function render()
    {
        return response()->view(
            'errors.minimal',
            array(
                'exception' => $this
            )
        );
    }
}
