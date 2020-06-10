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
    [UserRoles.ADMIN]: 'fa-user-ninja',
    [UserRoles.CASHIER]: 'fa-user-tie',
    [UserRoles.WAITRESS]: 'fa-user-tie',
    [UserRoles.CUSTOMER]: 'fa-user-alt',
};

export {UserRoles, UserRolesText, UserRolesIcon};
