<div class="page-wrapper">
   <div class="content container-fluid">
      <div class="page-header">
         <div class="row">
            <div class="col-sm-12">
               <h3 class="page-title">Welcome <?php echo $_COOKIE['schoolname'] ?></h3>

               <ul class="breadcrumb">
                  <li class="breadcrumb-item active">Dashboard</li>
               </ul>
            </div>
         </div>
      </div>
      <div class="row">
         <div class="col-xl-3 col-sm-6 col-12 d-flex">
            <div class="card bg-one w-100">
               <div class="card-body">
                  <div class="db-widgets d-flex justify-content-between align-items-center">
                     <div class="db-icon">
                        <i class="fas fa-user-graduate"></i>
                     </div>
                     <div class="db-info">




                        <h3>
                           <?php

                           echo ($studentscount[0]['total_instances'])  ?></h3>
                        <h6>Students</h6>

                     </div>
                  </div>
               </div>
            </div>
         </div>





         <div class="col-xl-3 col-sm-6 col-12 d-flex">
            <div class="card bg-two w-100">
               <div class="card-body">
                  <div class="db-widgets d-flex justify-content-between align-items-center">
                     <div class="db-icon">
                        <i class="fas fa-crown"></i>
                     </div>
                     <div class="db-info">
                        <h3>
                           <?php

                           echo ($teacherscount[0]['total_instances']);




                           ?>
                        </h3>
                        <h6>Teachers</h6>
                     </div>
                  </div>
               </div>
            </div>
         </div>



         <div class="col-xl-3 col-sm-6 col-12 d-flex">
            <div class="card bg-three w-100">
               <div class="card-body">
                  <div class="db-widgets d-flex justify-content-between align-items-center">
                     <div class="db-icon">
                        <i class="fas fa-building"></i>
                     </div>
                     <div class="db-info">
                        <h3> <?php

                              echo $classescount[0]['total_instances'];


                              ?></h3>
                        </h3>
                        <h6>classes</h6>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="col-xl-3 col-sm-6 col-12 d-flex">
            <div class="card bg-four w-100">
               <div class="card-body">
                  <div class="db-widgets d-flex justify-content-between align-items-center">
                     <div class="db-icon">
                        <i class="fas fa-file-invoice-dollar"></i>
                     </div>
                     <div class="db-info">
                        <h3><?php echo $modulescount[0]['total_instances']; ?></h3>
                        <h6>Modules</h6>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <br><br><br>
      <br><br><br>
      <div class="column">
         <div class="">
            <div class="card flex-fill">
               <div class="card-header">
                  <h5 class="card-title">Recently Joined Students</h5>
               </div>
               <div class="card-body">
                  <div class="table-responsive">
                     <table class="table table-hover table-center">
                        <thead class="thead-light">
                           <tr>
                              <th>First Name</th>
                              <th>Last Name</th>
                              <th class="text-center">Birthday</th>
                              <th class="text-center">Email</th>
                           </tr>
                        </thead>
                        <tbody>
                           <?php
                           for ($i = 0; $i < count($recentstudents); $i++) {
                           ?>
                              <tr>
                                 <td><?php echo "{$recentstudents[$i]["Student_FirstName"]}"; ?></td>
                                 <td><?php echo "{$recentstudents[$i]["Student_LastName"]}"; ?></td>
                                 <td><?php echo "{$recentstudents[$i]["Student_Birthday"]}"; ?></td>
                                 <td><?php echo "{$recentstudents[$i]["Student_Mail"]}"; ?></td>

                              <?php
                           }
                              ?>
                        </tbody>
                     </table>
                  </div>
               </div>
            </div>

            <div>
               <br><br><br>
               <div class="">
                  <div class="card flex-fill">
                     <div class="card-header">
                        <h5 class="card-title">Teachers </h5>
                     </div>
                     <div class="card-body">
                        <div class="table-responsive">
                           <table class="table table-hover table-center">
                              <thead class="thead-light">
                                 <tr>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th class="text-center">Email</th>
                                 </tr>
                              </thead>
                              <tbody>
                                 <?php
                                 for ($i = 0; $i < count($allteachers); $i++) {
                                 ?>
                                    <tr>
                                       <td><?php echo "{$allteachers[$i]["Teacher_FirstName"]}"; ?></td>
                                       <td><?php echo "{$allteachers[$i]["Teacher_LastName"]}"; ?></td>
                                       <td><?php echo "{$allteachers[$i]["Teacher_Mail"]}"; ?></td>

                                    <?php
                                 }
                                    ?>
                              </tbody>
                           </table>
                        </div>
                     </div>
                  </div>

                  <div>
                     </tbody>
                     </table>
                  </div>
               </div>
            </div>
         </div>

      </div>