<?php

class Database
{
    public static $host = '127.0.0.1';
    public static $dbName = 'student_management';
    public static $userName = 'root';
    public static $password = '123456';

    private static function connect()
    {
        $pdo = new PDO('mysql:host=' . self::$host . ';dbname=' . self::$dbName . ';charset=utf8', self::$userName, self::$password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        return $pdo;
    }

    public static function query($query, $params = [])
    {
        $statement = self::connect()->prepare($query);
        $statement->execute($params);

        $data = $statement->fetchAll();

        return $data;

    }

    function fetchAllAssoc($query, $bindData=null)
    {
        $statement = self::connect()->prepare($query);

        $statement->execute($bindData);

        return $statement->fetchAll(PDO::FETCH_ASSOC);

    }

    function fetchSingle($query, $bindData=null)
    {
        $statement = self::connect()->prepare($query);

        $statement->execute($bindData);

        return $statement->fetch();

    }

    function insertStudent($data, $masterDataSubjects)
    {
        $studentName = $data['name'];
        $studentSex =$data['sex'];
        $studentBirthday = $data['birthday'];
        $class = $data['class'];
        $score = $data['subjects'];

        $sql = 'INSERT INTO students(id_class, name, sex, birthday) VALUES (?, ?, ?, ?)';
        $query = self::connect()->prepare($sql)->execute([(int)$class, $studentName, $studentSex, $studentBirthday]);

        if ($query) {
            foreach ($masterDataSubjects as $key => $value) {
                $scoreSubject = (int)$score[$key];
                $subjectName = $value['name'];

                $sql = 'INSERT INTO student_subjects(id_student, id_subject, score)
                    SELECT students.id, subjects.id, ?
                    FROM students, subjects
                    WHERE students.name= ? AND subjects.name= ?';
                self::connect()->prepare($sql)->execute([$scoreSubject, $studentName, $subjectName]);
            }
        }
    }
}
