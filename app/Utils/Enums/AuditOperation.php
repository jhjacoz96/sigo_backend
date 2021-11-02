<?php

namespace App\Utils\Enums;

/**
 * class AuditOperation
 *
 * @package App\Utils\Enums;
 * @author Alejandro Pérez <alejandroprz2011@gmail.com>
 */
class AuditOperation
{
    /**
     * @string
     */
    const CREATE = 'CREATE';

    /**
     * @string
     */
    const UPDATE = 'UPDATE';

    /**
     * @string
     */
    const DELETE = 'DELETE';

    /**
     * @string
     */
    const RESTORE = 'RESTORE';

    /**
     * @string
     */
    const LOGIN = 'LOGIN';

    /**
     * @string
     */
    const LOGOUT = 'LOGOUT';
}
