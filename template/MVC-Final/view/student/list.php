<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Absence</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item active">Absence</li>
                    </ul>
                </div>
                <div class="col-auto text-right float-right ml-auto">
                    <a href="index.php?action=add-absence" class="btn btn-primary"><i class="fas fa-plus"></i></a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card card-table">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-center mb-0 datatable">
                                <thead>
                                    <tr>
                                        <th>StudentName</th>
                                        <th>ClassName</th>
                                        <th>SessionTime</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    include 'connexion.php';
                                    $query = "SELECT * FROM absence JOIN session_ ON absence.Session_Id = session_.Session_Id JOIN (SELECT Class_Id FROM class WHERE school_Id = $school_id) c ON session_.Class_Id = c.Class_Id ORDER BY session_.Class_Id, session_.Session_Start ASC;";
                                    $res = mysqli_query($db, $query);
                                    while ($fetched = mysqli_fetch_assoc($res)) {
                                        $class_id = $fetched['Class_Id'];
                                        $student_id = $fetched['Student_Id'];
                                        $absent = $fetched['absent'];
                                        $class_name = mysqli_query($db, "SELECT class_name FROM class WHERE Class_Id = $class_id");
                                        $cls_name = mysqli_fetch_row($class_name);
                                        $c_name = $cls_name[0];
                                        $student_name = mysqli_query($db, "SELECT CONCAT(Student_LastName,' ',Student_FirstName) AS Fullname FROM Student WHERE Student_Id=$student_id");
                                        $std_name = mysqli_fetch_row($student_name);
                                        $s_name = $std_name[0];
                                        $session_id = $fetched['Session_Id'];
                                        $session_time = mysqli_query($db, "SELECT Session_Start FROM session_ WHERE Session_Id= $session_id");
                                        $sess_time = mysqli_fetch_row($session_time);
                                        $s_time  = $sess_time[0];
                                    ?>
                                        <tr>
                                            <td><?php echo $s_name ?></td>
                                            <td><?php echo $c_name ?></td>
                                            <td><?php echo $s_time ?></td>
                                            <td>
                                                <form method="post">
                                                    <input type="radio" name='marker' value="true#<?php echo "" . $student_id . "#" . $session_id; ?>" id="rad1" onclick="clickedradio(this)" <?php if (($absent)) {
                                                                                                                                                                                                    echo "checked";
                                                                                                                                                                                                } ?> />Absent
                                                    <input type="radio" name='marker' value="false#<?php echo "" . $student_id . "#" . $session_id; ?>" id="rad2" onclick="clickedradio(this)" <?php if ((!($absent))) {
                                                                                                                                                                                                    echo "checked";
                                                                                                                                                                                                } ?> />Not Absent
                                                </form>
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function clickedradio(radio) {
        const str = radio.value;
        const [boolVar, numVar, strVar] = str.split("#");
        $.ajax({
            type: 'post',
            data: {
                stat: boolVar,
                id_s: numVar,
                id_c: strVar
            },
            success: function(response) {
                console.log("Absenteism :", boolVar);
                console.log("id_s : ", numVar);
                console.log("id_c: ", strVar);
            }
        });
    }
</script>