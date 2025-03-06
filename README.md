# Web4 Project

This is a web application for managing and displaying weapon data. The project is built using PHP, MySQL, HTML, CSS, and JavaScript.

## Project Structure

- `api/` - API endpoints for accessing data
- `assets/` - Static assets including images and icons
- `config/` - Configuration files
- `css/` - Stylesheets
- `includes/` - PHP includes for common functionality
- `js/` - JavaScript files
- `pages/` - PHP pages for different sections of the site

## Getting Started

1. Make sure you have a web server with PHP and MySQL installed (e.g., XAMPP)
2. Import the database structure using `database_structure.sql`
3. Configure your database connection in `config/database.php`
4. Access the site through your web server

## Git Usage

This project is now set up with Git for version control. Here are some common Git commands you might need:

```bash
# Check the status of your repository
git status

# Add changes to staging
git add .

# Commit changes
git commit -m "Your commit message"

# Create a new branch
git branch branch-name

# Switch to a branch
git checkout branch-name

# Create and switch to a new branch in one command
git checkout -b branch-name

# Push changes to a remote repository (if you have one set up)
git push origin branch-name
```

To set up a remote repository (e.g., on GitHub, GitLab, etc.), follow these steps:

1. Create a repository on the platform of your choice
2. Add the remote repository to your local Git repository:
   ```bash
   git remote add origin https://github.com/username/repository-name.git
   ```
3. Push your changes to the remote repository:
   ```bash
   git push -u origin master
