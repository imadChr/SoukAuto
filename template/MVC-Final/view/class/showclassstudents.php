
<div class="page-wrapper">
<div class="content container-fluid">

<div class="page-header">
<div class="row">
<div class="col">
<h3 class="page-title">Class Student List</h3>
<ul class="breadcrumb">
<li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
<li class="breadcrumb-item active">Class Student List</li>
</ul>
</div>
</div>
</div>

<div class="row">
<div class="col-sm-12">
<div class="card">
<div class="card-header">
<h5 class="card-title mb-2"><?php  
 include 'connexion.php';

if(isset($_GET["namo"])){
    $nclass = $_GET["namo"];
    echo $nclass ;
}
?></h5>

</div>
<div class="card-body">
<div class="table-responsive">
<table class="datatable table table-stripped">
<thead>
<tr>
<th>First Name</th>
<th>Last Name</th>
<th>Student Mail</th>
<th>Birthday</th>
<th>Start date</th>
<th>Action</th>


<th></th>
</tr>
</thead>
<tbody>
<?php 
            for ($i=0;$i<count($classstudents);$i++){
      ?>
            <tr>
         <td><?php echo "{$classstudents[$i]["Student_FirstName"]}"; ?></td>
         <td><?php echo "{$classstudents[$i]["Student_LastName"]}"; ?></td>
         <td><?php echo "{$classstudents[$i]["Student_Mail"]}"; ?></td>
         <td><?php echo "{$classstudents[$i]["Student_Birthday"]}"; ?></td>
         <td><?php echo "{$classstudents[$i]["Student_Starting_Date"]}"; ?></td>
                <td>
         <a href="index.php?action=deletestudentfromclass&id=<?php echo $classstudents[$i]["Student_Id"]; ?>&cid=<?php echo $idclass; ?>" class="btn btn-sm bg-danger-light mr-2">
                  <i class="fas fa-trash"></i>
               </a>
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