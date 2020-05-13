<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static Admin()
 * @method static static Employer()
 * @method static static Guest()
 */
final class UserRoles extends Enum
{
    const Admin = 1;
    const Employer = 2;
    const Guest = 3;
}
