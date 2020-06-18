<!DOCTYPE html>
<html>
<head>
    <title>Add Student</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../public/css/index.css">
</head>

<body>
<h1>Add Student</h1>
<a href="admin">Back</a>
<br/><br/>
<form method="POST" action="store">
    <table class="table table-border width-table">
        <tr>
            <td class="table-border">Name</td>
            <td class="table-border">
                <input type="text" name="name"/>

            </td>
        </tr>

        <tr>
            <td class="table-border">Class</td>
            <td class="table-border">
                <select name="class">
                    <?php
                    foreach ($classes as $val) {
                        echo '<option value="' . $val['id'] . '">' . $val['name'] . '</option>';
                    }
                    ?>
                </select>
            </td>
        </tr>

        <tr>
            <td class="table-border">Gender</td>
            <td class="table-border">
                <select name="sex">
                    <option value="Nam">Nam</option>
                    <option value="Nu">Nu</option>
                </select>
            </td>
        </tr>
        <tr>
            <td class="table-border">Birthday</td>
            <td class="table-border">
                <input type="text" name="birthday"/>
            </td>
        </tr>

        <tr>
            <td class="table-border">Score</td>
            <td class="table-border">
                <p>
                    <label>Math: </label>
                    <input type="text" name="subject_math"/>
                </p>
                <p>
                    <label>Physics: </label>
                    <input type="text" name="subject_physics"/>
                </p>
                <p>
                    <label>Chemistry: </label>
                    <input type="text" name="subject_chemistry"/>
                </p>
            </td>
        </tr>

        <tr>
            <td class="table-border"></td>
            <td class="table-border">
                <input type="submit" name="add_student" value="Save"/>
            </td>
        </tr>
    </table>
</form>
</body>
</html>
