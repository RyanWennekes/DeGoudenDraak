<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * There're two user-roles within this project. First we have an Admin-role.
 * This user can manage the website and has the highest access. The second Role
 * is the Employer-role. This user can create orders.
 *
 * @method static static Admin()
 * @method static static Employer()
 */
final class UserRoles extends Enum
{
    const Admin = 1;
    const Cashier = 2;
    const Waitress = 3;
    const Customer = 4;
}
