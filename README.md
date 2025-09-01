<div align="center">
<h1>Schoolio</h1>
<p><strong>Multi-tenant school management SaaS platform for institutions, staff, students, and parents.</strong></p>
</div>

## Overview
Schoolio is a multi-tenant education management platform. A central operations layer provisions and governs isolated tenant environments (schools) while each tenant manages its own users, classes, announcements, and support tickets. The platform includes a bi-directional support channel between tenants and the central team, secure impersonation for diagnostics, and role-targeted communications.

## Key Features
- Multi-tenancy (isolated DB + storage per tenant using stancl/tenancy v3)
- Central admin console (tenant lifecycle: create, suspend, activate, delete, impersonate)
- Secure impersonation (time-limited token based)
- Role-based access (Spatie roles: tenant_admin, teacher, student, parent, plus central custom permissions)
- Academic structure (teachers, classes, enrollment, guardians)
- Student & parent onboarding with automatic credential emails
- Announcements with role targeting, activation toggles, expiry & attachments
- Cross-context support tickets (tenant record ↔ central authoritative ticket) with internal notes
- Attachment management (tenant and central sides with safe path resolution)
- Dashboard metrics & recent activity feed (extensible)

## Architecture
| Layer | Purpose |
|-------|---------|
| Central Plane | Governance, provisioning, support triage, permissions, impersonation |
| Tenant Plane | Daily operations: users, classes, announcements, tickets |
| Storage & Cache | Scoped by tenant (filesystem + cache bootstrappers enabled) |
| Support Sync | Tenant ticket mirrors central ticket; status propagated back |
| RBAC | Spatie roles inside tenant DB; custom permission arrays for central admins |

### Core Models
- `Tenant` with domains, plan, trial, locale, theming, status
- `User` plus role-specific related models (`TenantTeacher`, `TenantStudents`, `TenantParents`)
- `TenantClasses` (teacher -> class -> many students)
- `Announcement` (role-based visibility, attachments)
- `SupportTicket` (central) ↔ `TenantSupportTicket` (tenant mirror)
- `SupportTicketReply` (public & internal streams)
- `ImpersonationToken` (central-only, 15 min lifetime)

### Flows (Condensed)
1. Central admin creates tenant (domain + trial) → isolated DB provisioned.
2. Central admin impersonates tenant via ephemeral token.
3. Tenant admin onboards teacher/student; system assigns roles & emails credentials.
4. Tenant creates support ticket → central record + tenant mirror.
5. Central updates status or replies → status sync + visible conversation for tenant.
6. Announcements filtered by user roles (active + not expired).

## Technology Stack
- PHP 8.2, Laravel 12
- stancl/tenancy v3 (DB, filesystem, cache isolation)
- spatie/laravel-permission (tenant RBAC)
- Blade UI icon sets
- Pest for testing

## Getting Started
### Prerequisites
- PHP 8.2+
- Composer
- Node.js & npm (for asset pipeline)
- MySQL (central + tenant DB server)

### Installation (Development)
```powershell
git clone <repo-url> schoolio
cd schoolio
cp .env.example .env  # or copy manually on Windows
composer install
php artisan key:generate
php artisan migrate --seed
npm install
npm run dev
php artisan serve
```

### Tenancy Notes
- Central domain defined in `config/tenancy.php` (`schoolio.test`).
- Each tenant gets: separate DB (prefix tenant), storage path suffix, cache tag.
- Add a tenant via central panel (once you have a central admin) or seed script.

### Creating a Tenant (CLI Example)
If you have a custom command (not shown here) you can alternatively create via UI: Central → Tenants → Create.

### Impersonation
Central admin clicks “Impersonate” → token generated (`ImpersonationToken`) → redirected to tenant domain `/impersonate` → validated → session established. Token expires after 15 minutes or single use.

## Project Structure (Highlights)
```
app/
	Models/                # Core domain models
	Http/Controllers/      # Central vs Tenants namespacing
config/tenancy.php       # Tenancy bootstrappers & central domains
routes/web.php           # Central + shared
routes/tenant.php        # Tenant-only routes (InitializeTenancyByDomain)
storage/tenant{ID}/...   # Per-tenant filesystem roots (auto-suffixed)
```

## Environment Variables (Essentials)
| Key | Purpose |
|-----|---------|
| DB_CONNECTION | Central DB connection name |
| TENANCY_DB_... | (If customizing database managers) |
| MAIL_... | Outbound onboarding emails |

## Roles & Permissions
Tenant context: managed via Spatie roles. Central: `central_admins` table stores `role` + `permissions` array (super_admin bypass). Align future features by unifying permission strategy if needed.

## Support Ticketing
- Tenant ticket creation mirrors to central `support_tickets`.
- Replies stored centrally; tenant fetches filtered (non-internal) replies.
- Status updates sync back to tenant mirror.

## Announcements
- Target roles stored as JSON array.
- Visibility: active + not expired + role intersection.
- Attachment metadata captured (name, path, size, mime).

## Testing
Run test suite:
```powershell
php artisan test
```
Add Pest tests for: impersonation flow, tenant provisioning, ticket sync, announcement visibility.

## Roadmap (Suggested)
- Attendance implementation (model placeholder exists)
- Billing & subscription enforcement
- Event/audit log persistence (replace synthetic activity feed)
- External storage (S3) for attachments
- Unified permission abstraction (central + tenant)
- Real-time notifications (WebSockets)

## Security
- Guard separation (`central_admin` vs default auth)
- Explicit authorization checks (403 aborts) in controllers
- Time-limited impersonation tokens
- Sanitized, generated filenames for attachments

## Contributing
Open issues or submit PRs. Add tests for new multi-tenant behaviors. Follow PSR-12 and run `pint` before committing.

## License
MIT. See `LICENSE` if present, otherwise the standard Laravel MIT applies.

## Disclaimer
This project builds on Laravel & ecosystem packages. Some operational/billing features are scaffolds only (status fields, plan, payment_method) and require implementation before production use.

