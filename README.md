Overview

This project is a comprehensive Human Resources system built with PHP and MySQL, aimed at managing all aspects of HR processes efficiently. The system is designed with a focus on high-quality and attractive UI, responsiveness, and a modular architecture that supports both RTL and LTR languages. The features are organized into different modules to ensure easy management of employees, companies, payroll, leaves, attendance, and more.

Features

A. Employee Management

Add Employee: Add new employees via add_employee.php, which includes all required fields such as name, email, phone, address, etc.

View Employees: Display all registered employees using view_employees.php.

Edit Employee: Update employee details using edit_employee.php.

Delete Employee: Delete employees through a delete option available in view_employees.php.

B. Company Management

Add Company: Add new companies using add_company.php.

View Companies: Display all registered companies via view_companies.php.

Edit Company: Update company information using edit_company.php.

C. Leave Management

Add Leave: Employees can request leaves via add_leave.php.

View Leaves: Display all leave requests using view_leaves.php.

Edit Leaves: Update leave details using edit_leave.php.

Leave Approval System: Managers can approve or reject leave requests, and email notifications are sent accordingly.

D. Salary Management

Add Salary: Add employee salaries via add_salary.php.

View Salaries: Display all registered salaries using view_salaries.php.

Edit Salary: Update salary details using edit_salary.php.

Salary Details: Manage salary details and loans through new tables and models.

E. User Management

Add User: Add new users and set their passwords via add_user.php.

Edit Users: Update user details using edit_user.php.

Delete Users: Remove users registered in the system.

Login & Logout: Secure login system using AuthController.php.

F. Dashboard

General Statistics: Display information about employees, salaries, leaves, etc.

Charts: Display daily attendance, payroll data, and more using enhanced charts.

Improved Sidebars: Sidebar is split into sub-menus covering all system features.

G. Attendance Management

Attendance Records: Create pages like view_attendance.php to display attendance records.

Attendance Reports: Generate detailed attendance reports for each employee or department, with export options to Excel or PDF.

H. Performance Management

Performance Reviews: View employee performance reviews through view_reviews.php.

Performance Reports: Generate detailed employee performance reports, with export capabilities.

I. Training & Development Management

Training Evaluations: Record training evaluations for employees.

Training Reports: Generate detailed training reports.

J. Document Management

Upload Documents: Upload employee documents via the user interface.

View Documents: Display uploaded documents for each employee.

K. Department Management

Assign Employees to Departments: Interface to assign employees to different departments.

Department Reports: Generate detailed reports on department performance.

L. Notification Management

System Notifications: In-system notifications for specific activities.

Email Notifications: Email alerts for attendance logging, leave requests, and approvals.

M. Roles & Permissions System

Add Roles: Add new roles with custom permissions.

Set Permissions: Allow users to set custom permissions for each role via the user interface.

Advanced Permissions System: Granular control over access to different features based on roles and permissions.

Setup Instructions

Clone the repository.

Set up the database using the provided SQL scripts in the /db folder.

Configure database connection details in config.php.

Deploy the system on your server and use a browser to access the login page.

Requirements

PHP >= 7.4

MySQL >= 5.7

Apache/Nginx server

Composer for dependency management

Contribution

Feel free to submit a pull request or raise issues. All contributions are welcome, whether they involve adding features, improving the design, fixing bugs, or enhancing documentation.

License

This project is licensed under the Apache License 2.0 - see the LICENSE file for details.

Author

Developed by WAI Soft
wai-soft.com
