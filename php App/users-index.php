<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">
    <title>Pluto - Responsive Bootstrap Admin Panel Templates</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="images/logo/logo_icon.png" type="image/png" />
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="css/responsive.css" />
    <link rel="stylesheet" href="css/bootstrap-select.css" />
    <link rel="stylesheet" href="css/perfect-scrollbar.css" />
    <link rel="stylesheet" href="css/custom.css" />
    <link rel="stylesheet" href="js/semantic.min.js" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">
</head>

<?php
session_start();
$error_message = "";

include "db_conn.php";
if (isset($_SESSION['id']) && isset($_SESSION['user_name'])) {
?>

    <body class="inner_page contact_page">
        <div class="full_container">
            <!-- Create POP UP FORM (Bootstrap MODAL) -->
            <div class="modal fade" id="viewmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel"> Active User Data </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="active-user.php" method="POST">
                            <div class="modal-body">
                                <h4>Do you want to Active this Data ??</h4>
                                <input type="hidden" name="id" id="view_id">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal"> CLOSE </button>
                                <button type="submit" name="activedata" class="btn btn-primary"> Yes !! Active it. </button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
            <!-- update is active DELETE POP UP FORM (Bootstrap MODAL) -->
            <div class="modal fade" id="deletemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel"> Inactive User Data </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="delete-user.php" method="POST">
                            <div class="modal-body">
                                <input  type="hidden" name="id" id="delete_id">
                                <h4> Do you want to Inactive  this Data ??</h4>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal"> NO </button>
                                <button type="submit" name="deletedata" class="btn btn-danger"> Yes !! Inactive  it. </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="inner_container">
                <?php include "header.php"; ?>
                <div id="content">
                    <?php include "header-top.php"; ?>
                    <div class="midde_cont">
                        <div class="container-fluid">
                            <div class="row column_title">
                                <div class="col-md-12">
                                    <div class="page_title">
                                        <h2>User Table</h2>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="white_shd full margin_bottom_30">
                                        <div class="table_section padding_infor_info">
                                            <div class="table-responsive-sm">
                                                <a type="button" href="user-create.php" class="btn cur-p btn-success mb-3">
                                                    Create User
                                                </a>
                                                <?php if (isset($_GET['success'])) { ?>
                                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                                        <?php echo $_GET['success']; ?>
                                                    </div>
                                                <?php } ?>
                                                <table id="datatableid" class="table table-bordered table-dark">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Image User</th>
                                                            <th> User Name</th>
                                                            <th> Name</th>
                                                            <th> Number Phone</th>
                                                            <th>User Type</th>
                                                            <th>Active</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <?php
                                                    include "db_conn.php";
                                                    $query = "SELECT * FROM users";
                                                    $stmt = $conn->prepare($query);
                                                    if ($stmt->execute()) {
                                                        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                                        if (!empty($result)) {
                                                            foreach ($result as $row) {
                                                                if ($row['image'] == '') {
                                                                    $user_image = "
                                                                    <img class='img-fluid' width='150' class='img-responsive rounded-circle'  
                                                                    src='upload/imageProfile/user_icon.png' alt='User image'>";
                                                                } else {
                                                                    $user_image = "
                                                                    <img class='img-fluid' width='150' class='img-responsive rounded-circle' 
                                                                    src='upload/imageProfile/{$row['image']}' alt='User image'>";
                                                                }
                                                    ?>
                                                                <tbody>
                                                                    <tr>
                                                                        <td> <?php echo $row['id']; ?> </td>
                                                                        <td> <?php echo $user_image; ?></td>
                                                                        <td> <?php echo $row['user_name']; ?> </td>
                                                                        <td> <?php echo $row['name']; ?> </td>
                                                                        <td> <?php echo $row['phone']; ?> </td>
                                                                        <td><?php echo $row['type_user']; ?> </td>
                                                                        <td>
                                                                        <?php
                                                                            if ($row['is_Active'] == 0) {
                                                                                echo '<h6 style="font-size: 15px;" class=" rounded-pill badge badge-success">Active</h6>';
                                                                            } else if ($row['is_Active'] == 1) {
                                                                                echo '<h6 style="font-size: 15px;" class=" rounded-pill badge badge-danger">Inactive</h6>';
                                                                            }
                                                                            ?>
                                                                        </td>
                                                                        <td>
                                                                            <a href="user-update.php?id=<?php echo $row['id']; ?>" class="btn btn-warning editbtn"><i class="fa fa-edit"></i></a>
                                                                            <button type="button" class="btn btn-danger deletebtn"><i class="fa fa-thumbs-down"></i></button>
                                                                            <button type="button" class="btn btn-info viewbtn"><i class="fa fa-thumbs-up"></i></button>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            <?php
                                                            }
                                                        } else { ?>
                                                            <tbody>
                                                                <tr>
                                                                    <td colspan="8" class="text-center text-capitalize  fs-1">No Record Found </td>
                                                                </tr>
                                                            </tbody>
                                                    <?php  }
                                                    } else {
                                                        // Handle the error if the query execution fails
                                                        echo "Query execution failed: " . print_r($stmt->errorInfo(), true);
                                                    } ?>
                                                </table>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="container-fluid">
                            <div class="footer">
                                <p>Copyright © 2018 Designed by html.design. All rights reserved.<br><br>
                                    Distributed By: <a href="https://themewagon.com/">ThemeWagon</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="js/jquery.min.js"></script>
        <script src="js/popper.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/animate.js"></script>
        <script src="js/bootstrap-select.js"></script>
        <script src="js/owl.carousel.js"></script>
        <script src="js/Chart.min.js"></script>
        <script src="js/Chart.bundle.min.js"></script>
        <script src="js/utils.js"></script>
        <script src="js/analyser.js"></script>
        <script src="js/perfect-scrollbar.min.js"></script>
        <script>
            var ps = new PerfectScrollbar('#sidebar');
        </script>
        <script src="js/custom.js"></script>
        <script src="js/semantic.min.js"></script>

        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>

        <script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>




        <script>
            $(document).ready(function() {

                $('#datatableid').DataTable({
                    "pagingType": "full_numbers",
                    "lengthMenu": [
                        [5,10, 25, 50, -1],
                        [5,10, 25, 50, "All"]
                    ],
                    responsive: true,
                    language: {
                        search: "_INPUT_",
                        searchPlaceholder: "Search Your Data",
                    }
                });

            });
        </script>

        <script>
            $(document).ready(function() {
                $('.deletebtn').on('click', function() {
                    $('#deletemodal').modal('show');
                    $tr = $(this).closest('tr');
                    var data = $tr.children("td").map(function() {
                        return $(this).text();
                    }).get();
                    console.log(data);
                    $('#delete_id').val(data[0]);

                });
            });
        </script>
        <script>
            $(document).ready(function() {
                $('.viewbtn').on('click', function() {
                    $('#viewmodal').modal('show');
                    $tr = $(this).closest('tr');
                    var data = $tr.children("td").map(function() {
                        return $(this).text();
                    }).get();
                    console.log(data);
                    $('#view_id').val(data[0]);
                });
            });
        </script>

        <script>
            $(document).ready(function() {

                $('.editbtn').on('click', function() {

                    $('#editmodal').modal('show');

                    $tr = $(this).closest('tr');

                    var data = $tr.children("td").map(function() {
                        return $(this).text();
                    }).get();

                    console.log(data);

                    $('#update_id').val(data[0]);
                    $('#fname').val(data[1]);
                });
            });
        </script>


    </body>

</html>
<?php
} else if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
} else {
    header("Location: index.php");
    exit();
}
?>