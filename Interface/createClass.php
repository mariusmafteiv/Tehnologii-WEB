<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
        header('Location: connection.php');
        exit;
    }

    if (!isset($_POST['title']) || empty($_POST['title'])) {
        header('Location: myclasses.php');
        exit;
    }

    include 'db_connection.php';

    $title = $_POST['title'];
    $teachers = $_POST['teachs'];
    $students = $_POST['studs'];
    $userId = $_SESSION['user']['ID'];

    $queryCheck = "SELECT ID FROM classes WHERE Title = ?";
    $stmtCheck = $conn->prepare($queryCheck);
    $stmtCheck->bind_param('s', $title);
    $stmtCheck->execute();
    $resultCheck = $stmtCheck->get_result();

    if ($resultCheck->num_rows > 0) {
        // Clasa există deja în baza de date
        header('Location: myclasses.php');
        exit;
    }

    $query = "INSERT INTO classes (Title, CreatedAt, CreatedBy) VALUES (?, NOW(), ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('si', $title, $userId);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        $classId = $stmt->insert_id;

        if (!empty($teachers)) {
            $teachersArr = explode(",", $teachers);
            foreach ($teachersArr as $teacher) {
                $teacher = trim($teacher);

                // Check if the teacher exists in users table
                $checkTeacherQuery = "SELECT ID FROM users WHERE Email = ?";
                $stmtCheckTeacher = $conn->prepare($checkTeacherQuery);
                $stmtCheckTeacher->bind_param('s', $teacher);
                $stmtCheckTeacher->execute();
                $resultCheckTeacher = $stmtCheckTeacher->get_result();

                if ($resultCheckTeacher->num_rows > 0) {
                    $rowCheckTeacher = $resultCheckTeacher->fetch_assoc();
                    $teacherId = $rowCheckTeacher['ID'];

                    // Check if the teacher is already in the class
                    $checkTeacherClassQuery = "SELECT COUNT(*) as numTeachers FROM classmembers WHERE ClassID = ? AND StudentID = ?";
                    $stmtCheckTeacherClass = $conn->prepare($checkTeacherClassQuery);
                    $stmtCheckTeacherClass->bind_param('ii', $classId, $teacherId);
                    $stmtCheckTeacherClass->execute();
                    $resultCheckTeacherClass = $stmtCheckTeacherClass->get_result();
                    $rowCheckTeacherClass = $resultCheckTeacherClass->fetch_assoc();

                    $numTeachers = $rowCheckTeacherClass['numTeachers'];

                    if ($numTeachers == 0) {
                        // Insert the teacher into the class
                        $insertTeacherQuery = "INSERT INTO classmembers (ClassID, StudentID) VALUES (?, ?)";
                        $stmtInsertTeacher = $conn->prepare($insertTeacherQuery);
                        $stmtInsertTeacher->bind_param('ii', $classId, $teacherId);
                        $stmtInsertTeacher->execute();
                    }
                }
            }
        }

        if (!empty($students)) {
            $studentsArr = explode(",", $students);
            foreach ($studentsArr as $student) {
                $student = trim($student);

                // Check if the student exists in users table
                $checkStudentQuery = "SELECT ID FROM users WHERE Email = ?";
                $stmtCheckStudent = $conn->prepare($checkStudentQuery);
                $stmtCheckStudent->bind_param('s', $student);
                $stmtCheckStudent->execute();
                $resultCheckStudent = $stmtCheckStudent->get_result();

                if ($resultCheckStudent->num_rows > 0) {
                    $rowCheckStudent = $resultCheckStudent->fetch_assoc();
                    $studentId = $rowCheckStudent['ID'];

                    // Check if the student is already in the class
                    $checkStudentClassQuery = "SELECT COUNT(*) as numStudents FROM classmembers WHERE ClassID = ? AND StudentID = ?";
                    $stmtCheckStudentClass = $conn->prepare($checkStudentClassQuery);
                    $stmtCheckStudentClass->bind_param('ii', $classId, $studentId);
                    $stmtCheckStudentClass->execute();
                    $resultCheckStudentClass = $stmtCheckStudentClass->get_result();
                    $rowCheckStudentClass = $resultCheckStudentClass->fetch_assoc();

                    $numStudents = $rowCheckStudentClass['numStudents'];

                    if ($numStudents == 0) {
                        // Insert the student into the class
                        $insertStudentQuery = "INSERT INTO classmembers (ClassID, StudentID) VALUES (?, ?)";
                        $stmtInsertStudent = $conn->prepare($insertStudentQuery);
                        $stmtInsertStudent->bind_param('ii', $classId, $studentId);
                        $stmtInsertStudent->execute();
                    }
                }
            }
        }
    }

    header('Location: myclasses.php');
    exit;
}
?>
