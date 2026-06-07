## 1. Project Title & Group Info

- Title: DailyWin — Task Management App
- Framework: Laravel 12+
- Group members:
  - Member 1: Zahrah Vermaak — 221406395
  - Member 2: Amanda Msutu — 222428600
  - Member 3: Uyathandwa Ngomana — 231173229
- Course code: ICE360/1/2S
- Date: June 2026

## 2. Technologies & Frameworks Used

- Laravel 12.x
- PHP 8.3+
- Laravel Breeze (authentication)
- Blade Templating Engine
- Tailwind CSS 3.x
- SQLite (recommended for local development)
- MySQL (supported as alternative)
- Composer
- Node.js / npm / Vite
- Laravel Pint
- Laravel Sail
- Alpine.js
- Axios
- Tailwind CSS Forms plugin
- Laravel Vite Plugin

## 3. Template Source (CRITICAL — assignment requires this)

The HTML/CSS UI structure was generated using Google Stitch and manually converted into Laravel Blade templates. All backend logic, database architecture, routing, controllers, policies, and authorization systems are original work developed for this assignment.

Template source URL: https://stitch.withgoogle.com/projects/8581600866462572146

## 4. Database Schema

The application uses a relational schema with the following tables:

- `users`
- `tasks`
- `categories`
- `category_task`
- `password_reset_tokens`
- `sessions`

### users

| Column | Type | Notes |
|---|---|---|
| id | unsigned bigint | Primary key |
| name | string | User full name |
| email | string | Unique email address |
| email_verified_at | timestamp|null | Verification timestamp (not required for login) |
| password | string | Hashed password |
| role | enum | `admin`, `team_member`, `guest` |
| remember_token | string|null | Authentication remember token |
| created_at | timestamp | Record creation timestamp |
| updated_at | timestamp | Record update timestamp |

### tasks

| Column | Type | Notes |
|---|---|---|
| id | unsigned bigint | Primary key |
| title | string | Task title |
| description | text|null | Optional task details |
| status | enum | `pending`, `in_progress`, `completed` |
| priority | enum | `low`, `medium`, `high` |
| due_date | date|null | Deadline date |
| created_by | unsigned bigint | References `users.id` |
| assigned_to | unsigned bigint|null | References `users.id` |
| created_at | timestamp | Record creation timestamp |
| updated_at | timestamp | Record update timestamp |

### categories

| Column | Type | Notes |
|---|---|---|
| id | unsigned bigint | Primary key |
| name | string | Unique category label |
| slug | string | URL-safe identifier |
| created_at | timestamp | Record creation timestamp |
| updated_at | timestamp | Record update timestamp |

### category_task

| Column | Type | Notes |
|---|---|---|
| id | unsigned bigint | Primary key |
| category_id | unsigned bigint | References `categories.id` |
| task_id | unsigned bigint | References `tasks.id` |
| created_at | timestamp | Record creation timestamp |
| updated_at | timestamp | Record update timestamp |

### password_reset_tokens

| Column | Type | Notes |
|---|---|---|
| email | string | Primary key for password reset record |
| token | string | Reset token |
| created_at | timestamp|null | Token creation timestamp |

### sessions

| Column | Type | Notes |
|---|---|---|
| id | string | Primary key |
| user_id | unsigned bigint|null | References `users.id` |
| ip_address | string|null | Session IP address |
| user_agent | text|null | Browser user agent |
| payload | longText | Session payload data |
| last_activity | integer | Last activity timestamp |

### Relationships

- `User` hasMany `Task` through `created_by`
- `User` hasMany `Task` through `assigned_to`
- `Task` belongsTo `User` as creator via `created_by`
- `Task` belongsTo `User` as assignee via `assigned_to`
- `Task` belongsToMany `Category` through `category_task`
- `Category` belongsToMany `Task` through `category_task`

### Database ERD

```text
users
  ├─< created_by
  ├─< assigned_to
  |
tasks
  └─< category_task >─ categories
```

## 5. Setup & Installation Instructions

Follow these exact commands to install and run DailyWin locally.

1. Clone repository

```bash
git clone <repository-url>
```

2. Change into the project folder

```bash
cd DailyWin
```

3. Install PHP dependencies with Composer

```bash
composer install
```

4. Install frontend dependencies with npm

```bash
npm install
```

5. Copy the example environment file

```bash
cp .env.example .env
```

6. Generate the application key

```bash
php artisan key:generate
```

7. Configure `.env`

Open `.env` and set at minimum:

```env
DB_CONNECTION=sqlite
MAIL_MAILER=log
```

If using SQLite, also set:

```env
DB_CONNECTION=sqlite
DB_DATABASE=/full/path/to/database/database.sqlite
```

8. Create the SQLite database file

```bash
touch database/database.sqlite
```

9. Run migrations and seed initial data

```bash
php artisan migrate --seed
```

10. Start the Laravel development server

```bash
php artisan serve
```

11. Start the Vite development build in a separate terminal

```bash
npm run dev
```

Each step prepares the environment: dependencies are installed, environment variables are configured, the database is created, schema is migrated, and the app is served locally.

## 6. How to Use the Application (User Guide)

### As a Team Member

- Register by opening the application and choosing the register page.
- Enter a name, email, password, and select `Team Member` from the role dropdown.
- Log in using the email and password provided during registration.
- Create a task by navigating to the task creation page and entering a title, deadline, category, priority, and optional description.
- Edit a task or update its status from the task list or task detail page.
- View tasks assigned to you under the personal task list or dashboard sections.
- You cannot manage categories, change other users, or access admin-only controls.

### As an Admin

- Admin accounts are provisioned through seeded data or by an existing administrator updating a user role to `admin`.
- Log in with an admin account to access the admin dashboard.
- View all tasks in the system from the dashboard and task management pages.
- Assign tasks to any user when editing or creating tasks.
- Manage categories using the categories section, including create, edit, and delete actions.
- Manage users from the user management panel, including viewing all users and changing roles.
- Review system analytics on the admin dashboard, including task counts and status summaries.

### Email Reminders

- Deadline reminders are generated automatically for tasks due tomorrow.
- For local testing, email output is written to `storage/logs/laravel.log` using the log mail driver.
- To trigger reminders manually, run:

```bash
php artisan tasks:send-reminders-azu
```

- On a deployed system, the scheduler runs the reminder command daily at 09:00.

## 7. Features Implemented

- [x] User authentication (register, login, logout) via Laravel Breeze
- [x] Role-based access control (Admin, Team Member)
- [x] Task CRUD (create, read, update, delete)
- [x] Task assignment to specific users
- [x] Task categories and priorities
- [x] Task status workflow (Pending → In Progress → Completed)
- [x] Deadline email reminders
- [x] Admin dashboard with analytics
- [x] Team Member dashboard with personal stats
- [x] User management (Admin only)
- [x] Category management (Admin only)
- [x] Profile management (update info, change password, delete account)
- [x] Responsive design
- [x] Form validation with custom error messages
- [x] Custom middleware for logging and access control
- [x] Eloquent relationships, scopes, accessors, observers
- [x] Database seeding with factories

## 8. Screenshots

### Admin Dashboard
![Admin Dashboard](screenshots/admin-dashboard.png)

### Team Member Dashboard
![Team Member Dashboard](screenshots/team-member-dashboard.png)

### Task List
![Task List](screenshots/task-list.png)

### Create Task Form
![Create Task Form](screenshots/create-task.png)

### User Management
![User Management](screenshots/user-management.png)


## 9. Security Features

- CSRF protection is enabled on all forms using Laravel middleware.
- XSS prevention is enforced by Blade `{{ }}` escaping.
- SQL injection is prevented by Eloquent ORM and query binding.
- Authorization is enforced via policies, gates, and role middleware.
- Route rate limiting is available for authentication actions.

## 10. Known Limitations / Notes

- The app is configured for local development using SQLite and the `log` mail driver.
- For production deployment, switch to MySQL or another production database and configure a real SMTP provider.
- Admin accounts are typically provisioned by seeded data or by updating a user role to `admin`.
- The current project does not expose admin role selection directly on registration.
- Automated reminders depend on the scheduler or manual command execution.

## 11. License

This project was developed for academic purposes only as part of the ICE362S Web Frameworks course.
