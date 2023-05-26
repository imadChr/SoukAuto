<div class="page-wrapper">
   <div class="content container-fluid">
      <div class="page-header">
         <div class="row align-items-center">
            <div class="col">
               <h3 class="page-title">Edit Students</h3>
               <ul class="breadcrumb">
                  <li class="breadcrumb-item"><a href="students.php">Students</a></li>
                  <li class="breadcrumb-item active">Edit Students</li>
               </ul>
            </div>
         </div>
      </div>
      <div class="row">
         <div class="col-sm-12">
            <div class="card">
               <div class="card-body">
                  <form method="POST">
                     <div class="row">
                        <div class="col-12">
                           <h5 class="form-title"><span>Student Information</span></h5>
                        </div>
                        <div class="col-12 col-sm-6">
                           <div class="form-group">
                              <label>First Name</label>
                              <input type="text" class="form-control" name="Student_FirstName" value="<?php echo $row[2] ?>">
                           </div>
                        </div>
                        <div class="col-12 col-sm-6">
                           <div class="form-group">
                              <label>Last Name</label>
                              <input type="text" class="form-control" name="Student_LastName" value="<?php echo $row[3] ?>">
                           </div>
                        </div>
                        <div class="col-12 col-sm-6">
                           <div class="form-group">
                              <label>Student email</label>
                              <input type="Student_Mail" class="form-control" name="Student_Mail" value="<?php echo $row[4] ?>">
                           </div>
                        </div>
                        <div class="col-12 col-sm-6">
                           <div class="form-group">
                              <label>Date of Birth</label>
                              <div>
                                 <input type="date" class="form-control" name="Student_Birthday" value="<?php echo $row[5] ?>">
                              </div>
                           </div>
                        </div>

                     </div>
                     <div class="col-12 col-sm-6">
                        <div class="form-group">
                           <label>Mobile Number</label>
                           <input type="text" class="form-control" name="Student_Phone_number" value="<?php echo $row[8] ?>">
                        </div>
                     </div>

                     <div class="col-12 col-sm-6">
                        <div class="form-group">
                           <label>Student Image</label>
                           <input type="file" class="form-control" name="image">
                        </div>
                     </div>
                     <div class="col-12">
                        <h5 class="form-title"><span>Parent Information</span></h5>
                     </div>
                     <div class="col-12 col-sm-6">
                        <div class="form-group">
                           <label>Father's Name</label>
                           <input type="text" class="form-control" value="<?php echo $row2[2] ?>">
                        </div>
                     </div>

                     <div class="col-12 col-sm-6">
                        <div class="form-group">
                           <label>Father's Mobile</label>
                           <input type="text" class="form-control" value="<?php echo $row2[6] ?>">
                        </div>
                     </div>
                     <div class="col-12 col-sm-6">
                        <div class="form-group">
                           <label>Father's id</label>
                           <input type="Student_Mail" class="form-control" name="Supervisor_Id" value="<?php echo $row2[0] ?>">
                        </div>
                     </div>
                     <div class="col-12 col-sm-6">
                        <div class="form-group">
                           <label> Student_Password</label>
                           <input type="Student_Password" class="form-control" name="Student_Password" value="<?php echo $row2[5] ?>">
                        </div>
                     </div>

                     <div class="col-12 col-sm-6">
                        <div class="form-group">
                           <label>Present Student_address</label>
                           <input class="form-control" name="Student_address" value="<?php echo $row[7] ?>"></textarea>
                        </div>
                     </div>
                     <div class="col-12">
                        <input type="submit" class="btn btn-primary" name="SUBMIT" VALUES="update">
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