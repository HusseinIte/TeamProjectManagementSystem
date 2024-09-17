# System Management Project Team

## Overview

This is a project management system designed to help teams organize and manage projects, tasks, and roles. The system includes key features such as project assignments, task tracking, role-based permissions, and task filtering.

## Database Tables

### 1. `projects`
Stores information about the projects, including:
- `name`: Name of the project.
- `description`: Description of the project.

### 2. `tasks`
Stores task information such as:
- `title`: Title of the task.
- `description`: Description of the task.
- `status`: Current status (`new`, `in progress`, `completed`).
- `priority`: Priority level (`low`, `medium`, `high`).
- `date_due`: Due date for the task.

### 3. `users`
Stores user information:
- `name`: Name of the user.
- `email`: Email address.
- `password`: User's password (encrypted).

### 4. `user_project`
A pivot table linking users to projects, with additional fields:
- `role`: User role in the project (e.g., `manager`, `developer`, `tester`).
- `contribution_hours`: Number of hours contributed by the user.
- `last_activity`: Last active date of the user in the project.

## Key Features and Challenges

1. **Pivot Table Modifications**: Manage many-to-many relationships with the pivot table `user_project`, which also stores extra information such as `role` and `contribution_hours`.

2. **`hasManyThrough` Relationship**: Allow users to access tasks associated with the projects they are assigned to.

3. **Task Filtering**: Use `whereRelation` to filter tasks based on `status` or `priority`.

4. **Latest and Oldest Tasks**: Implement `latestOfMany` and `oldestOfMany` to retrieve the latest or oldest tasks based on creation or update timestamps.

5. **`ofMany` with Conditions**: Fetch the highest-priority task with specific conditions in the title.

## Permissions System

- **Manager**: Can add and modify tasks.
- **Developer**: Can update task status.
- **Tester**: Can add comments or feedback on tasks.

## Setup and Running the Project

 1. **Clone the repository:**
 
     ```bash
     git clone https://github.com/HusseinIte/TaskManagement.git
     cd TaskManagement
     ```
 
 2. **Install dependencies:**
 
     ```bash
     composer install
     npm install
     ```
 
 3. **Copy the `.env` file:**
 
     ```bash
     cp .env.example .env
     ```
 
 4. **Generate an application key:**
 
     ```bash
     php artisan key:generate
     ```
 
 5. **Configure the database:**
 
     Update your `.env` file with your database credentials.
 
 6. **Run the migrations:**
 
     ```bash
     php artisan migrate --seed
     ```
 7. **Run the seeders (Optional):**
 
     If you want to populate the database with sample data, use the seeder command:
 
     ```bash
     php artisan db:seed
     ```
 8. **Serve the application:**
 
     ```bash
     php artisan serve
     ```
## Postman Collection

A Postman collection is provided to help you easily test the API endpoints. Follow these steps to import and use the collection:

1. Open **Postman**.
2. Click on **Import**.
3. Select the provided `Postman Collection.json` file (included in the project files).
4. Use the collection to test the different API endpoints for managing projects, tasks, and users.
