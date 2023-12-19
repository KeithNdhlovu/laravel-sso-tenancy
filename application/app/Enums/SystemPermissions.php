<?php

namespace App\Enums;

enum SystemPermissions: string
{
    case ViewIncidents = 'view_incidents';
    case CreateIncidents = 'create_incidents';
    case ManageIncidents = 'manage_incidents';

    case ViewUsers = 'view_users';
    case CreateUsers = 'create_users';
    case ManageUsers = 'manage_users';

    case ViewAudits = 'view_audits';
    case CreateAudits = 'create_audits';
    case ManageAudits = 'manage_audits';

    case ViewSettings = 'view_settings';
    case CreateSettings = 'create_settings';
    case ManageSettings = 'manage_settings';

    case ViewDashboard = 'view_dashboard';
    case CreateDashboard = 'create_dashboard';
    case ManageDashboard = 'manage_dashboard';

    case ViewAllOrganisationsData = 'view_all_organisations_data';

    case ViewSystemAuditTrail = 'view_system_audit_trail';

    /**
     * The description for this Permission.
     *
     * @return string
     */
    public function description(): string
    {
        return static::getDescription($this);
    }

    /**
     * The description for this Permission.
     *
     * @param self $value
     * @return string
     */
    public function getDescription(self $value): string
    {
        return match ($value) {
            SystemPermissions::ViewIncidents => 'Can View Incidents',
            SystemPermissions::CreateIncidents => 'Can Create Incidents',
            SystemPermissions::ManageIncidents => 'Can Manage Incidents',

            SystemPermissions::ViewUsers => 'Can View Users',
            SystemPermissions::CreateUsers => 'Can Create Users',
            SystemPermissions::ManageUsers => 'Can Manage Users',

            SystemPermissions::ViewAudits => 'Can View Audits',
            SystemPermissions::CreateAudits => 'Can Create Audits',
            SystemPermissions::ManageAudits => 'Can Manage Audits',

            SystemPermissions::ViewSettings => 'Can View Settings',
            SystemPermissions::CreateSettings => 'Can Create Settings',
            SystemPermissions::ManageSettings => 'Can Manage Settings',

            SystemPermissions::ViewDashboard => 'Can View Dashboard',
            SystemPermissions::CreateDashboard => 'Can Create Dashboard',
            SystemPermissions::ManageDashboard => 'Can Manage Dashboard',

            SystemPermissions::ViewSystemAuditTrail => 'Can View System Audit Trail',

            SystemPermissions::ViewAllOrganisationsData => 'Can View All Organisations Data',
        };
    }
}
