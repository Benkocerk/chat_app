Overview
This chat application is built using PHP and MySQL. The application allows users to log in, chat in a shared space, and have admins who can add new users. The passwords are stored in plain text (note: this is not recommended for real-world applications).

Database Schema
The database schema consists of two tables: users and messages.

Users Table
id: Unique identifier for each user (auto-incremented).
username: Username of the user (must be unique).
password: Password of the user (stored in plain text).
is_admin: Boolean indicating if the user is an admin.

Messages Table
id: Unique identifier for each message (auto-incremented).
user_id: Foreign key referencing the id in the users table.
message: The message text.
timestamp: Timestamp when the message was created.
