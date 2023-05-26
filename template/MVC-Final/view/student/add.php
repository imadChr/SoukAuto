<div class="page-wrapper">
            <div class="content container-fluid">
               <div class="page-header">
                  <div class="row align-items-center">
                     <div class="col">
                        <h3 class="page-title">Add Students</h3>
                        <ul class="breadcrumb">
                           <li class="breadcrumb-item"><a href="students.php">Students</a></li>
                           <li class="breadcrumb-item active">Add Students</li>
                        </ul>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-sm-12">
                     <div class="card">
                        <div class="card-body">
                        <form  method="POST">
                              <div class="row">
                                 <div class="col-12">
                                    <h5 class="form-title"><span>Student Information</span></h5>
                                 </div>
                                 <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                       <label>First Name</label>
                                       <input type="text" class="form-control" name="Student_FirstName">
                                    </div>
                                 </div>
                                 <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                       <label>Last Name</label>
                                       <input type="text" class="form-control" name="Student_LastName">
                                    </div>
                                 </div>
                                 
                                 <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                       <label>Student email</label>
                                       <input type="Student_Mail" class="form-control" name="Student_Mail">
                                    </div>
                                 </div>
                                 <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                       <label>Date of Birth</label>
                                       <div>
                                          <input type="date" class="form-control" name="Student_Birthday">
                                       </div>
                                    </div>
                                 </div>

                                 <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                       <label>Mobile Number</label>
                                       <input type="text" class="form-control" name="Student_Phone_number">
                                    </div>
                                 </div>
                                 <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                       <label>Student Image</label>
                                       <input type="file" class="form-control" name="image">
                                    </div>
                                 </div>
                                 <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                       <label> Student_Password</label>
                                       <input type="Student_Password" class="form-control" name="Student_Password">
                                    </div>
                                 </div>
                                 <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                       <label>Confirm Student_Password</label>
                                       <input type="Student_Password" class="form-control">
                                    </div>
                                 </div>
                                 <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                       <label>Current Student_address</label>
                                       <textarea class="form-control" name="Student_address"></textarea>
                                    </div>
                                 </div>
                                 <div class="col-12 col-sm-6" id="sup_list" style="display:none;">
                                                <div class="form-group">
                                                    <label>Supervisor_Name</label>
                                                    <input  class="form-control" type="text" onkeyup="lister(this)" autocomplete="off" name="s_name" id="searchbox">
                                                    <div id="response"> </div>
                                                    
                                                                  
       
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                       <input type="radio" name="choice" onclick="choose(this)" id="choice" value="1"/>Supervised<input type="radio" value="0" name="choice" onclick="choose(this)" id="choice"/>Not SuperVised
                                    </div>
                                 </div>
                                 <div class="col-12">
                                    <button type="submit" class="btn btn-primary" name="Register">Add</button>
                                 </div>
                              </div>
                           </form>
                        </div>
                     </div>
                  </div>
               </div>