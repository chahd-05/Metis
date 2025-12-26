# Metis

# Project Manager (Metis) – PHP CLI Application

## Description
This project is a PHP CLI application for managing members, projects, and activities using OOP and PDO.

## Requirements
- PHP
- XAMPP or any local server
- MySQL

## Database creation
1. Open phpMyAdmin
2. Create a database named `Metis`
3. Import the file `database.sql`

## How to run the project
1. Open VS Code
2. Open the terminal
3. Go to the app folder
3. And to the public folder
4. Then to the index.php
5. Run:


## Main features
- Member management (CRUD)
- Project management (short and long projects)
- Activity management
- Activities history
- Projects history
- Delete a project
- Exit;

## Business rules
- A member cannot be deleted if they have projects
- Email must be unique
- Description required
- Full_name required
- Password required
