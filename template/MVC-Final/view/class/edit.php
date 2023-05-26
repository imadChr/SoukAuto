
<div class="page-wrapper">
<div class="content container-fluid">

<div class="page-header">
<div class="row align-items-center">
<div class="col">
<h3 class="page-title">Edit Class</h3>
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
<form action='index.php?action=doupdateclass' method ='POST'>
<div class="row">
<div class="col-12">
<h5 class="form-title"><span>Class Details</span></h5>
</div>
<div class="col-12 col-sm-6">
<div class="form-group">
<label>Class Name</label>
<input type="text" required class="form-control" name='className' value ="<?php echo $classtoedit['class_name'] ?>" >
</div>
</div>
<input name= 'id' type= 'hidden' value= "<?php echo $_GET['id']; ?>">
<div class="col-12 col-sm-6">
    <div class="form-group">
    <label>Class Start Date</label>
    <input type="date" class="form-control" required name='startDate' value ="<?php echo $classtoedit['Starting_Date'] ?>">
    </div>
    </div>
<div class="col-12 col-sm-6">
    <div class="form-group">
    <label>Class End Date</label>
    <input type="date" class="form-control" required name='endDate' value ="<?php echo $classtoedit['Finishing_Date'] ?>">
    </div>
    </div>
<div class="col-12 col-sm-6">
<div class="form-group">
<label>No of sessions</label>
<input type="text" class="form-control" required name='numSessions' value ="<?php echo $classtoedit['Number_Of_Sections'] ?>">
</div>
</div>
<div class="col-12 col-sm-6">
<div class="form-group">
<label>Price</label>
<input type="text" class="form-control" required name='Price' value ="<?php echo $classtoedit['Class_Price'] ?>">
</div>
</div>
<div class="col-12 col-sm-6">
    <div class="form-group">
    <label>Capacity</label>
    <input type="text" class="form-control" required name='Capacity' value ="<?php echo $classtoedit['Class_Capacity'] ?>">
    </div>
    </div>
<div class="col-12">
<button type="submit" name='submit' class="btn btn-primary">Edit</button>
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