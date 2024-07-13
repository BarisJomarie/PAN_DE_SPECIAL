
<?php
$host = "localhost";  
$username = "root"; 
$password = ""; 
$database = "pandespecial"; 


$conn = new mysqli($host, $username, $password, $database);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$delay = 5000;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $date_of_visit = $_POST["date_of_visit"];
    $age = $_POST["age"];
    $gender = $_POST["gender"];
    $branch_visited = $_POST["branch_visited"];

    if (isset($_POST["about_pds"]) && !empty($_POST["about_pds"])) {
        $about_pds = implode(", ", $_POST["about_pds"]);
    } else {
        $about_pds = ""; 
    }

    $visit_pds = $_POST["visit_pds"];
    $problem_report = $_POST["problem_report"];

    if (isset($_POST["problem_cause"]) && !empty($_POST["problem_cause"])) {
        $problem_cause = implode(", ", $_POST["problem_cause"]);
    } else {
        $problem_cause = ""; 
    }
    
    $satisfacton = $_POST["satisfaction"];
    $comments = $_POST["comments"];
    

    $sql = "INSERT INTO survey (date_of_visit, age, gender, branch_visited, about_pds, visit_pds, problem_report, problem_cause, satisfaction, comments) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sissssssss", $date_of_visit, $age, $gender, $branch_visited, $about_pds, $visit_pds, $problem_report, $problem_cause, $satisfacton, $comments);
    

    if ($stmt->execute()) {
        echo "New record created successfully! Redirecting you back in 5 seconds...";
        echo "<script>
        setTimeout(function() {
            window.location.href = '../survey.php';
        }, $delay);
        </script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    
    $stmt->close();
    $conn->close();
}
?>
