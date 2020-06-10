const UserRoles = {
    ADMIN: 1,
    CASHIER: 2,
    WAITRESS: 3,
    CUSTOMER: 4,
};

const UserRolesText = {
    [UserRoles.ADMIN]: 'Geen',
    [UserRoles.CASHIER]: 'Warm',
    [UserRoles.WAITRESS]: 'Heet',
    [UserRoles.CUSTOMER]: 'Extra heet',
};

const UserRolesIcon = {
    [UserRoles.ADMIN]: 'fa-circle',
    [UserRoles.CASHIER]: 'fa-tint-slash',
    [UserRoles.WAITRESS]: 'fa-fire',
    [UserRoles.CUSTOMER]: 'fa-pepper-hot',
};

export {UserRoles, UserRolesText, UserRolesIcon};
