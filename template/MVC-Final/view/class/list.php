<div class="page-wrapper">
   <div class="content container-fluid">

      <div class="page-header">
         <div class="row align-items-center">
            <div class="col">
               <h3 class="page-title">Classes</h3>
               <ul class="breadcrumb">
                  <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                  <li class="breadcrumb-item active">Classes</li>
               </ul>
            </div>
            <div class="col-auto text-right float-right ml-auto">
               <a href="#" class="btn btn-outline-primary mr-2"><i class="fas fa-download"></i> Download</a>
               <a href="index.php?action=addclass" class="btn btn-primary"><i class="fas fa-plus"></i></a>
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
                              <th>Name</th>
                              <th>Teacher</th>
                              <th>Module</th>
                              <th>Price</th>
                              <th>Start date</th>
                              <th>End date</th>
                              <th>Class capacity</th>
                              <th>Number of sessions</th>
                              <th class="text-right">Action</th>
                           </tr>
                        </thead>
                        <tbody>
                           <?php
                           for ($i = 0; $i < count($classes); $i++) {
                           ?>
                              <tr>
                                 <td><?php echo "{$classes[$i]["class_name"]}"; ?></td>
                                 <td><?php echo "{$classes[$i]["Teacher_FirstName"]}"; ?></td>
                                 <td><?php echo "{$classes[$i]["Module_Name"]}"; ?></td>
                                 <td><?php echo "{$classes[$i]["Class_Price"]}"; ?></td>
                                 <td><?php echo "{$classes[$i]["Starting_Date"]}"; ?></td>
                                 <td><?php echo "{$classes[$i]["Finishing_Date"]}"; ?></td>
                                 <td><?php echo "{$classes[$i]["Class_Capacity"]}"; ?></td>
                                 <td><?php echo "{$classes[$i]["Number_Of_Sections"]}"; ?></td>

                                 <td class="text-right">
                                    <div class="actions">
                                       <a href="index.php?action=updateclass&id=<?php echo $classes[$i]["Class_Id"]; ?>" class="btn btn-sm bg-success-light mr-2">
                                          <i class="fas fa-pen"></i>
                                       </a>
                                       <a href="index.php?action=deleteclass&id=<?php echo $classes[$i]["Class_Id"]; ?>" class="btn btn-sm bg-danger-light mr-2">
                                          <i class="fas fa-trash"></i>
                                       </a>
                                       <a href="index.php?action=addstudenttoclass&id=<?php echo $classes[$i]["Class_Id"]; ?>" class="btn btn-sm bg-primary-light mr-2">
                                          <i class="fas fa-user-plus"></i>
                                       </a>
                                       <a href="index.php?action=showclassstudents&id=<?php echo $classes[$i]["Class_Id"]; ?>" class="btn btn-sm bg-info-light mr-2">
                                          <i class="fas fa-list"></i>
                                       </a>
                                       <a href="index.php?action=addsession&id=<?php echo $classes[$i]["Class_Id"]; ?>" class="btn btn-sm bg-warning-light mr-2">
                                          <i class="fas fa-calendar-alt"></i>
                                       </a>
                                    </div>
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