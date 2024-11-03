<div class="sidebar">
    <a href="/views/dashboard/index.php">Dashboard</a>
    
    <h3 onclick="toggleSubmenu('usersRolesSubmenu')">Users & Roles</h3>
    <div id="usersRolesSubmenu" class="submenu">
        <a href="/views/users/view_users.php">View Users</a>
        <a href="/views/users/add_user.php">Add New User</a>
        <a href="/views/roles/view_roles.php">View Roles</a>
        <a href="/views/roles/add_role.php">Add New Role</a>
    </div>
    
    <h3 onclick="toggleSubmenu('employeesSubmenu')">Employees</h3>
    <div id="employeesSubmenu" class="submenu">
        <a href="/views/employees/view_employees.php">View Employees</a>
        <a href="/views/employees/add_employee.php">Add New Employee</a>
        <a href="/views/employees/edit_employee.php">Edit Employee</a>
        <a href="/views/employees/profile.php">Employee Profile</a>
    </div>
    
    <h3 onclick="toggleSubmenu('attendanceLeavesSubmenu')">Attendance & Leaves</h3>
    <div id="attendanceLeavesSubmenu" class="submenu">
        <a href="/views/attendance/attendance.php">Record Attendance</a>
        <a href="/views/attendance/view_attendance.php">View Attendance</a>
        <a href="/views/attendance/attendance_report.php">Attendance Report</a>
        <a href="/views/leaves/request_leave.php">Request Leave</a>
        <a href="/views/leaves/view_leaves.php">View Leaves</a>
        <a href="/views/leaves/approve_leave.php">Approve Leave</a>
        <a href="/views/leaves/add_leave_type.php">Add Leave Type</a>
        <a href="/views/leaves/view_leave_types.php">View Leave Types</a>
        <a href="/views/leaves/leave_report.php">Leave Report</a>
    </div>
    
    <h3 onclick="toggleSubmenu('performanceTrainingSubmenu')">Performance & Training</h3>
    <div id="performanceTrainingSubmenu" class="submenu">
        <a href="/views/performance/performance_review.php">Performance Review</a>
        <a href="/views/performance/view_reviews.php">View Reviews</a>
        <a href="/views/performance/performance_report.php">Performance Report</a>
        <a href="/views/training/add_training.php">Add Training</a>
        <a href="/views/training/view_training.php">View Training</a>
        <a href="/views/training/training_report.php">Training Report</a>
    </div>
    
    <h3 onclick="toggleSubmenu('documentsDepartmentsSubmenu')">Documents & Departments</h3>
    <div id="documentsDepartmentsSubmenu" class="submenu">
        <a href="/views/documents/upload_document.php">Upload Document</a>
        <a href="/views/documents/view_documents.php">View Documents</a>
        <a href="/views/departments/add_department.php">Add Department</a>
        <a href="/views/departments/view_departments.php">View Departments</a>
        <a href="/views/departments/assign_department.php">Assign Department</a>
        <a href="/views/departments/department_report.php">Department Report</a>
    </div>
    
    <h3 onclick="toggleSubmenu('salariesLoansSubmenu')">Salaries & Loans</h3>
    <div id="salariesLoansSubmenu" class="submenu">
        <a href="/views/salaries/add_salary.php">Add Salary</a>
        <a href="/views/salaries/view_salaries.php">View Salaries</a>
        <a href="/views/salaries/salary_report.php">Salary Report</a>
        <a href="/views/loans/add_loan.php">Add Loan</a>
        <a href="/views/loans/view_loans.php">View Loans</a>
    </div>
    
    <h3 onclick="toggleSubmenu('jobsGoalsSubmenu')">Job Postings & Goals</h3>
    <div id="jobsGoalsSubmenu" class="submenu">
        <a href="/views/jobs/add_job_posting.php">Add Job Posting</a>
        <a href="/views/jobs/view_job_postings.php">View Job Postings</a>
        <a href="/views/goals/add_goal.php">Add Goal</a>
        <a href="/views/goals/view_goals.php">View Goals</a>
    </div>
    
    <h3 onclick="toggleSubmenu('notificationsSessionsSubmenu')">Notifications & Sessions</h3>
    <div id="notificationsSessionsSubmenu" class="submenu">
        <a href="/views/notifications/view_notifications.php">View Notifications</a>
        <a href="/views/sessions/manage_sessions.php">Manage Sessions</a>
    </div>
    
    <h3 onclick="toggleSubmenu('settingsSubmenu')">Settings</h3>
    <div id="settingsSubmenu" class="submenu">
        <a href="/views/settings/customize_interface.php">Customize Interface</a>
    </div>
</div>

<script>
function toggleSubmenu(id) {
    var submenu = document.getElementById(id);
    if (submenu.style.display === "block") {
        submenu.style.display = "none";
    } else {
        submenu.style.display = "block";
    }
}
</script>
