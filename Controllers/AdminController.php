<?php

class AdminController extends Controller
{
    public static function getAllStudents()
    {
        $students = [];
        $counter=0;

        $sql = 'SELECT students.*, class.name AS class_name, subjects.name AS subject_name, student_subjects.score
                FROM students 
                INNER JOIN student_subjects ON student_subjects.id_student = students.id
                INNER JOIN subjects ON subjects.id = student_subjects.id_subject
                INNER JOIN class ON students.id_class = class.id';

        $result = self::fetchAllAssoc($sql);

        foreach ($result as $key => $val) {
            $students[$val['id']]['id'] = $val['id'];
            $students[$val['id']]['name'] = $val['name'];
            $students[$val['id']]['id_class'] = $val['id_class'];
            $students[$val['id']]['sex'] = $val['sex'];
            $students[$val['id']]['birthday'] = $val['birthday'];
            $students[$val['id']]['class_name'] = $val['class_name'];
            $students[$val['id']]['subjects'][$counter]['subject_name'] = $val['subject_name'];
            $students[$val['id']]['subjects'][$counter]['score'] = $val['score'];
            $counter++;
        }

        return self::view('indexAdmin', compact('students'));
    }

    public static function createStudent()
    {
        $sql = 'SELECT * FROM class';
        $classes = self::fetchAllAssoc($sql);

        return self::view('create', compact('classes'));
    }

    public static function store()
    {
        $data['name'] = isset($_POST['name']) ? $_POST['name'] : '';
        $data['class'] = isset($_POST['class']) ? $_POST['class'] : '';
        $data['sex'] = isset($_POST['sex']) ? $_POST['sex'] : '';
        $data['birthday'] = isset($_POST['birthday']) ? $_POST['birthday'] : '';
        $data['subjects'][0] = isset($_POST['subject_math']) ? $_POST['subject_math'] : '';
        $data['subjects'][1] = isset($_POST['subject_physics']) ? $_POST['subject_physics'] : '';
        $data['subjects'][2] = isset($_POST['subject_chemistry']) ? $_POST['subject_chemistry'] : '';

        if (self::createStudentRequest($data)) {
            //get classes
            $sql = 'SELECT * FROM subjects';
            $subjects = self::fetchAllAssoc($sql);

            self::insertStudent($data, $subjects);
            self::getAllStudents();
        }
    }

    private static function createStudentRequest($data)
    {
        // Validate
        $errors = [];
        if (empty($data['name'])) {
            $errors['student_name'] = 'The student name required';
        }

        if (empty($data['class'])) {
            $errors['student_class'] = 'Class of student not selected';
        }

        if (empty($data['sex'])) {
            $errors['student_sex'] = 'Student gender not selected';
        }

        if (empty($data['birthday'])) {
            $errors['student_birthday'] = 'The student birthday required';
        }

        if (empty($data['subjects'][0])) {
            $errors['subject_math'] = 'Score math required';
        }

        if (empty($data['subjects'][1])) {
            $errors['subject_physics'] = 'Score physics required';
        }

        if (empty($data['subjects'][2])) {
            $errors['subject_chemistry'] = 'Score chemistry required';
        }

        if ($errors) {
            echo '<script>alert("Create error!"); window.location.href="./create";</script>';
        }

        return true;
    }
}
