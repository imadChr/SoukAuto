<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Fees</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item active">Fees</li>
                    </ul>
                </div>
                <div class="col-auto text-right float-right ml-auto">
                    <a href="#" class="btn btn-outline-primary mr-2"><i class="fas fa-download"></i> Download</a>
                    <a href="index.php?action=addfees" class="btn btn-primary"><i class="fas fa-plus"></i></a>
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
                                        <th>Student ID</th>
                                        <th>Student Name</th>
                                        <th>Class</th>
                                        <th>Amount</th>
                                        <th>Paying Date</th>
                                        <th>Status</th>
                                        <th class="text-right">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($fees as $fee) : ?>
                                        <tr>
                                            <td><?php echo $fee['Student_Id']; ?></td>
                                            <td>
                                                <h2>
                                                    <a><?php echo $fee['Student_Name']; ?></a>
                                                </h2>
                                            </td>
                                            <td><?php echo $fee['Class_Name']; ?></td>
                                            <td><?php echo $fee['Fees_Amount']; ?></td>
                                            <td><?php echo $fee['Fees_Date']; ?></td>
                                            <td class="text-right">
                                                <?php if ($fee['Fees_Status'] == 1) : ?>
                                                    <span class="badge badge-success">Paid</span>
                                                <?php else : ?>
                                                    <span class="badge badge-danger">Unpaid</span>
                                                <?php endif; ?>
                                            </td>
                                            <td class="text-right">
                                                <div class="actions">
                                                    <a href="index.php?action=updatefees&id=<?php echo $fee['Fees_Id']; ?>" class="btn btn-sm bg-success-light mr-2">
                                                        <i class="fas fa-pen"></i>
                                                    </a>
                                                    <a href="index.php?action=deletefees&id=<?php echo $fee['Fees_Id']; ?>" class="btn btn-sm bg-danger-light mr-2">
                                                        <i class="fas fa-trash"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
