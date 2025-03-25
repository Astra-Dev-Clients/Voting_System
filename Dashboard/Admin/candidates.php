<?php
include '../../includes/header.php';
require_once '../../Database/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Handle form submission to add a new candidate
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $position = $_POST['position'];
    $course = $_POST['course'];
    $year_of_study = $_POST['year_of_study'];
    $manifesto = $_POST['manifesto'];
    $photo = $_POST['photo']; // Assuming photo is a URL or file path

    $sql = "INSERT INTO candidates (First_Name, Last_Name, Position, Course, Year_of_Study, Manifesto, Photo) 
            VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssiss", $first_name, $last_name, $position, $course, $year_of_study, $manifesto, $photo);

    if ($stmt->execute()) {
        echo "<div class='alert alert-success'>Candidate added successfully!</div>";
    } else {
        echo "<div class='alert alert-danger'>Error adding candidate: " . $conn->error . "</div>";
    }
}
?>

<div class="container py-5">
    <h1 class="text-center mb-5">Add New Candidate</h1>
    <form method="POST" action="">
        <div class="mb-3">
            <label for="first_name" class="form-label">First Name</label>
            <input type="text" class="form-control" id="first_name" name="first_name" required>
        </div>
        <div class="mb-3">
            <label for="last_name" class="form-label">Last Name</label>
            <input type="text" class="form-control" id="last_name" name="last_name" required>
        </div>
        <div class="mb-3">
            <label for="position" class="form-label">Position</label>
            <input type="text" class="form-control" id="position" name="position" required>
        </div>
        <div class="mb-3">
            <label for="course" class="form-label">Course</label>
            <input type="text" class="form-control" id="course" name="course" required>
        </div>
        <div class="mb-3">
            <label for="year_of_study" class="form-label">Year of Study</label>
            <input type="number" class="form-control" id="year_of_study" name="year_of_study" required>
        </div>
        <div class="mb-3">
            <label for="manifesto" class="form-label">Manifesto</label>
            <textarea class="form-control" id="manifesto" name="manifesto" rows="4" required></textarea>
        </div>
        <div class="mb-3">
            <label for="photo" class="form-label">Photo URL</label>
            <input type="text" class="form-control" id="photo" name="photo">
        </div>
        <button type="submit" class="btn btn-primary">Add Candidate</button>
    </form>
</div>

<?php
include '../../includes/footer.php';
?>
