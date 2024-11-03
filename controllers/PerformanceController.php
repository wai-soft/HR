<?php
include '../config/db_connection.php';
include '../models/PerformanceReview.php';

$action = $_GET['action'];

if ($action == 'review' && $_SERVER["REQUEST_METHOD"] == "POST") {
    $review = new PerformanceReview($conn);
    $review->employee_id = $_POST['employee_id'];
    $review->review_date = $_POST['review_date'];
    $review->score = $_POST['score'];
    $review->comments = $_POST['comments'];

    if ($review->create()) {
        echo "<script>alert('Performance review submitted successfully'); window.location.href='/views/performance/view_reviews.php';</script>";
    } else {
        echo "<script>alert('Error: " . $conn->error . "'); window.location.href='/views/performance/performance_review.php';</script>";
    }
}

if ($action == 'report' && $_SERVER["REQUEST_METHOD"] == "POST") {
    $review = new PerformanceReview($conn);
    $review->employee_id = $_POST['employee_id'];
    $review->start_date = $_POST['start_date'];
    $review->end_date = $_POST['end_date'];

    $result = $review->generate_report();

    if ($result->num_rows > 0) {
        echo "<h1>Performance Report</h1>";
        echo "<table class='table'>";
        echo "<tr><th>ID</th><th>Employee</th><th>Review Date</th><th>Score</th><th>Comments</th></tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['id']}</td>
                    <td>{$row['employee_id']}</td>
                    <td>{$row['review_date']}</td>
                    <td>{$row['score']}</td>
                    <td>{$row['comments']}</td>
                  </tr>";
        }
        echo "</table>";
    } else {
        echo "<script>alert('No performance reviews found for the selected period'); window.location.href='/views/performance/performance_report.php';</script>";
    }
}
?>
