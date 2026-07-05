# 🚀 SmartTask – AI-Powered Agile Task & Sprint Manager

[![Laravel Version](https://img.shields.io/badge/Laravel-v13.x-red.svg?style=for-the-badge&logo=laravel)](https://laravel.com)
[![PHP Version](https://img.shields.io/badge/PHP-%5E8.3%20%7C%208.4-blue.svg?style=for-the-badge&logo=php)](https://www.php.net)
[![TailwindCSS](https://img.shields.io/badge/TailwindCSS-v3.x-38bdf8.svg?style=for-the-badge&logo=tailwind-css)](https://tailwindcss.com)
[![Laravel AI](https://img.shields.io/badge/Laravel%20AI-Agentic-violet.svg?style=for-the-badge)](https://github.com/laravel/ai)

**SmartTask** is a modern, AI-augmented project management web application built on **Laravel 13**, **Tailwind CSS**, and the official **Laravel AI SDK**. It is designed to help teams and developers bridge the gap between initial software ideas and highly structured, actionable Agile sprints.

---

## 🌟 Key Features

### 📋 1. Complete Task CRUD & Board
*   **Intuitive Interface:** Create, view, update, delete, and filter tasks seamlessly.
*   **Quick Actions:** Toggle task completion with a single click.
*   **Task Filters:** Filter tasks by **Priority** (High, Medium, Low) and **Status** (Completed, Pending).

### 🤖 2. AI-Powered Task Breakdown
*   **Feature-to-Tasks Conversion:** Input any feature idea, description, or project spec.
*   **Agentic AI Analysis:** The underlying `TaskBreakdownAgent` decomposes the prompt into discrete tasks.
*   **Automatic Estimates:** Generates priority, estimated days from now, and due time.
*   **Bulk Import:** Select and import generated tasks directly into your task list with pre-calculated due dates.

### 🔄 3. AI-Powered Agile Backlog & Sprint Planner
*   **Sprint Generation:** Enter a project goal and specify the number of sprints (up to 6).
*   **Smart Scheduling:** The `AgileBacklogAgent` structures the backlog, defining specific sprint names, sprint goals, story points, and task lists.
*   **Sprint Import:** Automatically creates sprints in the database and associates tasks with progressive due dates based on the sprint timeline.

### 📊 4. Developer Analytics Dashboard
*   **Task Summary Metrics:** High-level counters for total, pending, and completed tasks.
*   **Interactive Charts:** Dynamic visual progression of sprints and project tasks.
*   **Sprint Performance Tracker:** Shows progress percentage and stories allocation per sprint.

### 👤 5. Secure Authentication & Profiles
*   **Laravel Fortify:** Robust registration, login, session security, and password management.
*   **User Profiles:** Edit user details (Name, Username, Email) and upload custom avatars (stored securely using Laravel Storage).

---

## 🛠 Tech Stack

*   **Backend:** PHP 8.3 / 8.4, [Laravel 13.x](https://laravel.com)
*   **AI Integration:** [Laravel AI SDK](https://github.com/laravel/ai) (leveraging structured JSON schema responses)
*   **Security & Auth:** [Laravel Fortify](https://laravel.com/docs/fortify)
*   **Frontend:** Blade templates, Tailwind CSS, JavaScript
*   **Development Tools:** Laravel Pail (log streaming), Laravel Pint (code styling)

---

## ⚙️ Installation & Setup

We have made setting up the project extremely simple. Follow the steps below:

### 1. Prerequisites
Make sure you have PHP 8.3+, Composer, Node.js (with npm), and SQLite/MySQL/PostgreSQL installed.

### 2. Quick-Start Setup
Clone the repository, go into the directory, and run the automated composer setup script:
```bash
composer run setup
```
This script will automatically:
1. Install PHP dependencies (`composer install`).
2. Copy the `.env.example` to `.env` (if it doesn't exist).
3. Generate the application key (`php artisan key:generate`).
4. Run the database migrations (`php artisan migrate --force`).
5. Install and build frontend assets (`npm install && npm run build`).

### 3. Configure AI Provider
SmartTask uses the official Laravel AI SDK. Open your `.env` file and add your AI provider credentials. For example, if you are using OpenAI:
```env
AI_PROVIDER=openai
OPENAI_API_KEY=your-openai-api-key-here
```
Or if using Gemini:
```env
AI_PROVIDER=gemini
GEMINI_API_KEY=your-gemini-api-key-here
```

### 4. Link Storage (For profile avatars)
Ensure your storage is linked so that uploaded avatars can be served publicly:
```bash
php artisan storage:link
```

---

## 🚀 Running the Application

You can start the local development server, Vite watcher, and queue listener concurrently with a single command:

```bash
composer run dev
```

This starts:
*   **Local Web Server:** `http://127.0.0.1:8000`
*   **Vite Development Server:** Handles hot module reloading for assets.
*   **Queue Listener:** Processes background jobs.
*   **Laravel Pail:** Real-time console log streaming.

---

## 📂 Code Architecture Highlights

The codebase follows Laravel Best Practices strictly:

*   **Dedicated Form Requests:** All input validations are separated into custom Request files located in `app/Http/Requests`:
    *   `ProfileRequest.php` – Validates profile edits and avatar uploads.
    *   `TaskRequest.php` – Validates standard manual task inputs.
    *   `BreakdownRequest.php` – Validates the AI breakdown idea inputs.
    *   `ImportTasksRequest.php` – Validates bulk tasks imported from AI breakdown.
    *   `BacklogRequest.php` – Validates the Agile backlog sprint count and idea inputs.
    *   `ImportBacklogRequest.php` – Validates sprint backlog structures and story point arrays.
*   **AI Agent Layer:** Located under `app/Ai/Agents/`. These agents define custom system prompts and structured output requirements to ensure standard JSON responses from LLM services.
*   **Controllers:** Minimalist, type-hinting Form Requests to automate request validation before executing actions.

---

## 🧪 Running Tests

A comprehensive suite of feature tests is included to verify core functionalities (such as Agile sprint creation and AI backlog imports):

Run the test suite:
```bash
php artisan test
```

---

## 📄 License

This project is open-sourced software licensed under the [MIT license](LICENSE).
