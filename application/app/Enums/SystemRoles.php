<?php

namespace App\Enums;

enum SystemRoles: string
{
    case RoleSystemUser = 'system_user';
    case RoleSystemAdmin = 'system_admin';
    case RoleSystemSherq = 'system_sherq';
    case RoleSystemAuditor = 'system_auditor';
    case RoleSystemHod = 'system_head_of_department';
    case RoleSystemHeadOffice = 'system_head_office';
    case RoleSystemHodHm = 'system_head_of_department_hospital_manager';
    case RoleSystemHodNsm = 'system_head_of_department_nursing_service_manager';

    /**
     * Get the description for the Role.
     *
     * @return string
     */
    public function description(): string
    {
        return static::getDescription($this);
    }

    /**
     * Get the permissions for this Role.
     *
     * @return array<SystemPermissions>
     */
    public function permissions(): array
    {
        return static::getPermissions($this);
    }

    /**
     * Get the description for the Role.
     *
     * @param self $value
     * @return string
     */
    public function getDescription(self $value): string
    {
        return match ($value) {
            SystemRoles::RoleSystemUser => 'General User',
            SystemRoles::RoleSystemAdmin => 'Admin User',
            SystemRoles::RoleSystemSherq => 'SHERQ Officer User',
            SystemRoles::RoleSystemAuditor => 'Auditor User',
            SystemRoles::RoleSystemHod => 'Head Of Department User',
            SystemRoles::RoleSystemHeadOffice => 'Head Office User',
            SystemRoles::RoleSystemHodHm => 'HOD Hospital Manager User',
            SystemRoles::RoleSystemHodNsm => 'HOD Nursing Service Manager User'
        };
    }

    /**
     * Get the permissions for this Role.
     *
     * @param self $value
     * @return array
     */
    public function getPermissions(self $value): array
    {
        return match ($value) {
            SystemRoles::RoleSystemUser => [
                SystemPermissions::ViewIncidents,
                SystemPermissions::CreateIncidents,
            ],
            SystemRoles::RoleSystemAdmin => SystemPermissions::cases(), // We are giving the Administrator all out system permissions
            SystemRoles::RoleSystemSherq => [
                SystemPermissions::ViewIncidents,
                SystemPermissions::CreateIncidents,
                SystemPermissions::ManageIncidents,
            ],
            SystemRoles::RoleSystemAuditor => [
                SystemPermissions::ViewIncidents,
                SystemPermissions::CreateIncidents,
                SystemPermissions::ManageIncidents,
            ],
            SystemRoles::RoleSystemHod => [
                SystemPermissions::ViewIncidents,
                SystemPermissions::CreateIncidents,
                SystemPermissions::ManageIncidents,
                SystemPermissions::ViewDashboard,
                SystemPermissions::ViewAudits,
                SystemPermissions::CreateAudits,
                SystemPermissions::ManageAudits,
            ],
            SystemRoles::RoleSystemHeadOffice => [
                SystemPermissions::ViewIncidents,
                SystemPermissions::CreateIncidents,
                SystemPermissions::ManageIncidents,
                SystemPermissions::ViewDashboard,
                SystemPermissions::ViewAudits,
                SystemPermissions::CreateAudits,
                SystemPermissions::ManageAudits,
                SystemPermissions::ViewAllOrganisationsData,
            ],
            SystemRoles::RoleSystemHodHm => [
                SystemPermissions::ViewIncidents,
                SystemPermissions::CreateIncidents,
                SystemPermissions::ManageIncidents,
                SystemPermissions::ViewDashboard,
                SystemPermissions::ViewAudits,
                SystemPermissions::CreateAudits,
                SystemPermissions::ManageAudits,
            ],
            SystemRoles::RoleSystemHodNsm => [
                SystemPermissions::ViewIncidents,
                SystemPermissions::CreateIncidents,
                SystemPermissions::ManageIncidents,
                SystemPermissions::ViewDashboard,
                SystemPermissions::ViewAudits,
                SystemPermissions::CreateAudits,
                SystemPermissions::ManageAudits,
            ],
        };
    }
}
