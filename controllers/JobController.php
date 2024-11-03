<?php
include '../config/db_connection.php';
include '../models/JobPosting.php';
include '../models/JobApplication.php';

$action = $_GET['action'];

if ($action == 'add' && $_SERVER["REQUEST_METHOD"] == "POST") {
    $job = new JobPosting($conn);
    $job->title = $_POST['title'];
    $job->description = $_POST['description'];
    $job->requirements = $_POST['requirements'];
    $job->posted_date = $_POST['posted_date'];
    $job->status = 'open';

    if ($job->create()) {
        echo "<script>alert('Job posting added successfully'); window.location.href='/views/jobs/view_job_postings.php';</script>";
    } else {
        echo "<script>alert('Error: " . $conn->error . "'); window.location.href='/views/jobs/add_job_posting.php';</script>";
    }
}

if ($action == 'edit' && $_SERVER["REQUEST_METHOD"] == "POST") {
    $job = new JobPosting($conn);
    $job->id = $_POST['id'];
    $job->title = $_POST['title'];
    $job->description = $_POST['description'];
    $job->requirements = $_POST['requirements'];
    $job->posted_date = $_POST['posted_date'];
    $job->status = $_POST['status'];

    if ($job->update()) {
        echo "<script>alert('Job posting updated successfully'); window.location.href='/views/jobs/view_job_postings.php';</script>";
    } else {
        echo "<script>alert('Error: " . $conn->error . "'); window.location.href='/views/jobs/edit_job_posting.php?id=" . $_POST['id'] . "';</script>";
    }
}

if ($action == 'delete' && isset($_GET['id'])) {
    $job = new JobPosting($conn);
    $job->id = $_GET['id'];

    if ($job->delete()) {
        echo "<script>alert('Job posting deleted successfully'); window.location.href='/views/jobs/view_job_postings.php';</script>";
    } else {
        echo "<script>alert('Error: " . $conn->error . "'); window.location.href='/views/jobs/view_job_postings.php';</script>";
    }
}

if ($action == 'apply' && $_SERVER["REQUEST_METHOD"] == "POST") {
    $application = new JobApplication($conn);
    $application->job_posting_id = $_POST['job_posting_id'];
    $application->applicant_name = $_POST['applicant_name'];
    $application->applicant_email = $_POST['applicant_email'];
    $application->resume_path = $_POST['resume_path'];
    $application->application_date = $_POST['application_date'];
    $application->status = 'pending';

    if ($application->create()) {
        echo "<script>alert('Application submitted successfully'); window.location.href='/views/jobs/view_job_postings.php';</script>";
    } else {
        echo "<script>alert('Error: " . $conn->error . "'); window.location.href='/views/jobs/apply_job.php?id=" . $_POST['job_posting_id'] . "';</script>";
    }
}
?>
