<div class="page-wrapper">
<div class="content container-fluid">

<div class="page-header">
<div class="row align-items-center">
<div class="col">
<h3 class="page-title">Ressources Bank</h3>
<ul class="breadcrumb">
<li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
<li class="breadcrumb-item active">resources</li>
</ul>
</div>
<div class="col-auto text-right float-right ml-auto">
<a href="add-events.php" class="btn btn-primary"><i class="fas fa-plus"></i></a>
</div>
</div>
</div>

<?php
$sql = "SELECT * FROM resources WHERE Class_Id IN (SELECT Class_Id from class WHERE School_Id=$school_id)";
$result = mysqli_query($db, $sql);
$resources = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>


  <?php if (empty($resources)): ?>
    <p class="lead mt-3">There is no ressources</p>
  <?php endif; ?>

  <?php foreach ($resources as $item): ?>
    <div class="card my-3 w-75">
     <div class="card-body text-center">
       <?php echo $item['Resource_Text']; ?>
       <div class="text-secondary mt-2">to class <?php echo $item[
         'Class_Id'
       ]; ?> due <?php echo date_format(
   date_create($item['Resource_DueTime']),
   'l jS F Y'
 ); ?></div>
      <a href="edit-event.php?id=<?php echo $item['Resource_Id']; ?>" class="btn btn-primary mt-3">Edit</a>
      <button class="btn btn-danger mt-3" data-toggle="modal" data-target="#deleteModal-<?php echo $item['Resource_Id']; ?>" name="delete">Delete</button>
      <!-- Delete Modal -->
      <div class="modal fade" id="deleteModal-<?php echo $item['Resource_Id']; ?>" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel-<?php echo $item['Resource_Id']; ?>" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="deleteModalLabel-<?php echo $item['Resource_Id']; ?>" name="confirm">Confirm Delete</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              Are you sure you want to delete this resource?
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
              <a href="delete-event.php?id=<?php echo $item['Resource_Id']; ?>" class="btn btn-danger">Delete</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php endforeach; ?>