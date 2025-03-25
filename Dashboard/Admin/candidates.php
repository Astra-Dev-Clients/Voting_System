<?php
include '../../includes/header.php';
require_once '../../Database/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['Adm_No']) && !isset($_POST['position'])) {
        // Fetch user details based on Adm_No (for AJAX request)
        $Adm_No = $_POST['Adm_No'];
        $stmt = $conn->prepare("SELECT First_Name, Last_Name, Course, Year_of_Study FROM users WHERE Adm_No = ?");
        $stmt->bind_param("s", $Adm_No);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();
        echo json_encode($user);
        exit;
    }

    // Handle form submission to add a new candidate
    $Adm_No = $_POST['Adm_No'];
    $position = $_POST['position'];
    $manifesto = $_POST['manifesto'];
    $photo = $_POST['photo']; // Assuming photo is a URL or file path

    // Check if candidate already exists
    $stmt = $conn->prepare("SELECT * FROM candidates WHERE Adm_No = ?");
    $stmt->bind_param("s", $Adm_No);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "<div class='alert alert-danger'>Candidate already exists!</div>";
    } else {
        // Fetch user details from the database
        $stmt = $conn->prepare("SELECT First_Name, Last_Name, Course, Year_of_Study FROM users WHERE Adm_No = ?");
        $stmt->bind_param("s", $Adm_No);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        if ($user) {
            $first_name = $user['First_Name'];
            $last_name = $user['Last_Name'];
            $course = $user['Course'];
            $year_of_study = $user['Year_of_Study'];

            // Insert candidate into database
            $sql = "INSERT INTO candidates (Adm_No, First_Name, Last_Name, Position, Course, Year_of_Study, Manifesto, Photo) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sssssiss", $Adm_No, $first_name, $last_name, $position, $course, $year_of_study, $manifesto, $photo);

            if ($stmt->execute()) {
                echo "<div class='alert alert-success'>Candidate added successfully!</div>";
            } else {
                echo "<div class='alert alert-danger'>Error adding candidate: " . $conn->error . "</div>";
            }
        } else {
            echo "<div class='alert alert-danger'>Invalid Admission Number!</div>";
        }
    }
}
?>

<div class="container py-5">
    <h1 class="text-center mb-5">Add New Candidate</h1>
    <form method="POST" action="">
        <div class="mb-3">
            <label for="Adm_No" class="form-label">Admission Number</label>
            <select class="form-control" id="Adm_No" name="Adm_No" required>
                <option value="">Select Admission Number</option>
                <?php
                $result = $conn->query("SELECT Adm_No FROM users");
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row['Adm_No'] . "'>" . $row['Adm_No'] . "</option>";
                }
                ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="position" class="form-label">Position</label>
            <select class="form-control" id="position" name="position" required>
                <option value="" disabled selected>Select Position</option>
                <option value="President">President</option>
                <option value="Welfare">Welfare</option>
                <option value="Sports">Sports</option>
                <option value="Academics">Academics</option>
            </select>
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
