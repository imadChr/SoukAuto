
<div class="page-wrapper">
            <div class="content container-fluid">

            
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <form method="POST">
                                    <div class="row">

                                        <div class="col-12">
                                            <h5 class="form-title"><span>Add A session</span></h5>
                                        </div>
                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label>Session Start Date</label>
                                                <input type="datetime-local" class="form-control" name="session_start" >
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label>Session End Date</label>
                                                <input type="datetime-local" class="form-control" name="session_end" >
                                            </div>
                                        </div>



                                        <div class="col-12">
                                            <input type="submit" class="btn btn-primary" value="Add" name="sub">
                                        </div>

                                    </div>
                                </form>


                            </div>
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
                                                    <th>SessionNumber</th>
                                                    <th>Session Start date</th>
                                                    <th>Session End date</th>
                                                    <th>Class</th>
                                                    <th class="text-right">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php/*
                                            while($row=mysqli_fetch_assoc($res)){
                                                
                                                $session_start = $row['Session_Start'];
                                                $session_end = $row['Session_End'];
                                            
                                                

                                            
                                    


                                             ?>
                                                <tr>

                                                    <td>
                                                         <?php  echo "Session ".$i;  ?>
                                                    </td>
                                                    <td>
                                                        <?php  echo $session_start  ?>
                                                    </td>
                                                    <td>
                                                        <?php  echo $session_end  ?>
                                                    </td>
                                                    <td>
                                                        <?php  echo $class_name  ?>
                                                    </td>

                                                    <td class="text-right">
                                                        <div class="actions">
                                                            <a href="edit-session.php?s_id='<?php echo $row['Session_Id'] ?>'&c_id='<?php echo $class_id ?>'"
                                                                class="btn btn-sm bg-success-light mr-2">
                                                                <i class="fas fa-pen"></i>
                                                            </a>
                                                            <a href="delete-session.php?s_id='<?php echo $row['Session_Id'] ?>'&c_id='<?php echo $class_id ?>'"
                                                                class="btn btn-sm bg-danger-light mr-2">
                                                                <i class="fas fa-trash"></i>
                                                            </a>
                                                            
                                                           

                                                        </div>
                                                    </td>
                                                </tr>
                                                <?php
                                            $i++;

                                            }*/
                                            ?>

                                            
                                </div>




                                </tbody>
                                </table>
                            </div>

                        </div>

                    </div>
                </div>

            </div>

            <footer>
                <p>G6 21 guys.</p>
            </footer>

        </div>

    </div>
