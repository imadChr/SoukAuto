<div class="page-wrapper">
    <div class="content container-fluid">

        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Add Class</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="departments.html">Class</a></li>
                        <li class="breadcrumb-item active">Add Class</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <form action='index.php?action=doaddclass' method='POST'>
                            <div class="row">
                                <div class="col-12">
                                    <h5 class="form-title"><span>Class Details</span></h5>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label>Class Name</label>
                                        <input type="text" required class="form-control" name='className'>
                                    </div>
                                </div>

                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label>Module Name</label>

                                        <select class="form-control" required name='moduleName'>
                                            <?php
                                            for ($i = 0; $i < count($modules); $i++) {
                                            ?>
                                                <option value=<?php echo $modules[$i]['Module_Id'] ?>> <?php echo $modules[$i]['Module_Name'] ?></option>';
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label>Teacher Name</label>
                                        <select class="form-control" name='teacherName'><?php
                                                                                        for ($i = 0; $i < count($teachers); $i++) {
                                                                                        ?>
                                                <option value=<?php echo $teachers[$i]['Teacher_Id'] ?>> <?php echo $teachers[$i]['Teacher_FirstName'] . ' ' . $teachers[$i]['Teacher_LastName'] ?></option>';
                                            <?php
                                                                                        }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label>Class Start Date</label>
                                        <input type="date" class="form-control" required name='startDate'>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label>Class End Date</label>
                                        <input type="date" class="form-control" required name='endDate'>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label>No of sessions</label>
                                        <input type="text" class="form-control" required name='numSessions'>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label>Price</label>
                                        <input type="text" class="form-control" required name='Price'>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label>Capacity</label>
                                        <input type="text" class="form-control" required name='Capacity'>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button type="submit" name='submit' class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</div>