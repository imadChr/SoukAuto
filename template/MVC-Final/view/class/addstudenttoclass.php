<script>$('select').selectpicker(); </script>
<div class="page-wrapper">
<div class="content container-fluid">

<div class="page-header">
<div class="row align-items-center">
<div class="col">
<h3 class="page-title">Add Student to class</h3>
<ul class="breadcrumb">
<li class="breadcrumb-item"><a href="departments.html"></a></li>
<li class="breadcrumb-item active"></li>
</ul>
</div>
</div>
</div>

<div class="row">
<div class="col-sm-12">
<div class="card">
<div class="card-body">
<form action='index.php?action=doaddstudenttoclass' method ='POST'>
<div class="row">
<div class="col-12">
<h5 class="form-title"><span>Class Details</span></h5>
</div>

<div class="col-12 col-sm-6">
<div class="form-group">
<label>Select the students to add </label>
<input type="hidden" name="classid" value="<?php echo isset($_GET['id']) ? $_GET['id'] : ''; ?>">
<select class="form-control selectpicker" multiple data-live-search="true" name='selectedClasses[]'>
<?php 
           for ($i=0;$i<count($students);$i++){
      ?>
        <option  value =<?php echo $students[$i]['Student_Id'] ?>>  <?php echo $students[$i]['Student_FirstName'] .' ' . $students[$i]['Student_LastName']  ?></option>;
        <?php
            }
      ?>
</select>
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.8.1/css/bootstrap-select.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.8.1/js/bootstrap-select.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
