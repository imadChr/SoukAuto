
<div class="page-wrapper">
<div class="content container-fluid">

<div class="page-header">
<div class="row align-items-center">
<div class="col">
<h3 class="page-title">Teachers</h3>
<ul class="breadcrumb">
<li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
<li class="breadcrumb-item active">Teachers</li>
</ul>
</div>
<div class="col-auto text-right float-right ml-auto">
<a href="index.php?action=addteteacher" class="btn btn-primary"><i class="fas fa-plus"></i></a>
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
<th>First Name</th>
<th>Last Name</th>
<th>Email</th>
</tr>
</thead>
<tbody>
<?php 
            for ($i=0;$i<count($teachers);$i++){
            ?>
            <tr>
         <td><?php echo "{$teachers[$i]["Teacher_FirstName"]}"; ?></td>
         <td><?php echo "{$teachers[$i]["Teacher_LastName"]}"; ?></td>
         <td><?php echo "{$teachers[$i]["Teacher_Mail"]}"; ?></td>
        
         <td class="text-right">
            <div class="actions">
               <a href="index.php?action=updateteacher&id=<?php echo $teachers[$i]["Teacher_Id"]; ?>" class="btn btn-sm bg-success-light mr-2">
                  <i class="fas fa-pen"></i>
               </a>
               <a href="index.php?action=deleteteacher&id=<?php echo $teachers[$i]["Teacher_Id"]; ?>" class="btn btn-sm bg-danger-light">
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