<div class="page-wrapper">
            <div class="content container-fluid">
               <div class="page-header">
                  <div class="row align-items-center">
                     <div class="col">
                        <h3 class="page-title">Subjects</h3>
                        <ul class="breadcrumb">
                           <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                           <li class="breadcrumb-item active">Subjects</li>
                        </ul>
                     </div>
                     <div class="col-auto text-right float-right ml-auto">
                        <a href="add-subject.php" class="btn btn-primary"><i class="fas fa-plus"></i></a>
                     </div>
                  </div>
               </div>

               <table>
              
               </table>

               <div class="row">
                  <div class="col-sm-12">
                     <div class="card card-table">
                        <div class="card-body">
                           <div class="table-responsive">
                              <table class="table table-hover table-center mb-0 datatable">
                                 <thead>
                                    <tr>

                                   
                                       <th>Name</th>
                                       <th>Action</th> 
                                       </tr>
                                       </thead>
                                       <tbody>
                                    
<?php 
            for ($i=0;$i<count($subjects);$i++){
            ?>
            <tr>
         <td><?php echo "{$subjects[$i]["Module_Name"]}"; ?></td>
         
        
         <td class="text-right">
            <div class="actions">
               <a href="index.php?action=updatestudent&id=<?php echo $students[$i]["Student_Id"]; ?>" class="btn btn-sm bg-success-light mr-2">
                  <i class="fas fa-pen"></i>
               </a>
               <a href="index.php?action=deletesubject&id=<?php echo $subjects[$i]["Module_Id"]; ?>" class="btn btn-sm bg-danger-light">
                  <i class="fas fa-trash"></i>
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