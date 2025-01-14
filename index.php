<?php
session_start();
$conn = mysqli_connect("localhost", "root", '', "aasra");

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Save form data
    if (isset($_POST['save_form'])) {
        $name = $_POST['name'];
        $fname = $_POST['fname'];
        $mobile_no = $_POST['mobile_no'];
        $date_of_joining = $_POST['date_of_joining'];

        $query = "INSERT INTO baghat (name, fname, mobile_no, date_of_joining) VALUES ('$name', '$fname', '$mobile_no', '$date_of_joining')";
        if (mysqli_query($conn, $query)) {
            $_SESSION['status'] = "Record saved successfully!";
        } else {
            $_SESSION['status'] = "Error saving record!";
        }
        header("Location: index.php");
        exit();
    }

    // Edit record
    if (isset($_POST['edit_baghat'])) {
        $baghat_id = $_POST['baghat_id'];
        $name = $_POST['name'];
        $fname = $_POST['fname'];
        $mobile_no = $_POST['mobile_no'];
        $date_of_joining = $_POST['date_of_joining'];

        $query = "UPDATE baghat SET name='$name', fname='$fname', mobile_no='$mobile_no', date_of_joining='$date_of_joining' WHERE id='$baghat_id'";
        if (mysqli_query($conn, $query)) {
            $_SESSION['status'] = "Record updated successfully!";
        } else {
            $_SESSION['status'] = "Error updating record!";
        }
        header("Location: index.php");
        exit();
    }

    // Delete record
    if (isset($_POST['delete_baghat'])) {
        $baghat_id = $_POST['baghat_id'];
        $query = "DELETE FROM baghat WHERE id='$baghat_id'";
        if (mysqli_query($conn, $query)) {
            $_SESSION['status'] = "Record deleted successfully!";
        } else {
            $_SESSION['status'] = "Error deleting record!";
        }
        header("Location: index.php");
        exit();
    }
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ni Aasre Da Aasra</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.25/jspdf.plugin.autotable.min.js"></script>
</head>
<body>

<!-- Baghat Add Modal -->
<div class="modal fade" id="Baghat" tabindex="-1" aria-labelledby="Baghat" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="BaghatLabel">Baghat Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="index.php" method="POST">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" class="form-control" placeholder="Enter Name" required>
                    </div>
                    <div class="form-group">
                        <label for="fname">Father Name</label>
                        <input type="text" name="fname" class="form-control" placeholder="Father Name" required>
                    </div>
                    <div class="form-group">
                        <label for="mobile_no">Mobile Number</label>
                        <input type="text" name="mobile_no" class="form-control" placeholder="Mobile Number" required>
                    </div>
                    <div class="form-group">
                        <label for="date_of_joining">Date of Joining</label>
                        <input type="date" name="date_of_joining" class="form-control" placeholder="Date of Joining" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="save_form" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- View Baghat Modal -->
<div class="modal fade" id="ViewBaghat" tabindex="-1" aria-labelledby="ViewBaghatLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ViewBaghatLabel">View Baghat Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="view_name">Name</label>
                    <input type="text" id="view_name" class="form-control" disabled>
                </div>
                <div class="form-group">
                    <label for="view_fname">Father Name</label>
                    <input type="text" id="view_fname" class="form-control" disabled>
                </div>
                <div class="form-group">
                    <label for="view_mobile_no">Mobile Number</label>
                    <input type="text" id="view_mobile_no" class="form-control" disabled>
                </div>
                <div class="form-group">
                    <label for="view_date_of_joining">Date of Joining</label>
                    <input type="date" id="view_date_of_joining" class="form-control" disabled>
                </div>
                <button id="downloadPdf" class="btn btn-success">Download as PDF</button>
            </div>
        </div>
    </div>
</div>

<!-- Main content -->
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <?php
                if (isset($_SESSION['status']) && $_SESSION['status'] != '') {
                    echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
                        <strong>Hey!</strong> <h5>{$_SESSION['status']}</h5>
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div>";
                    unset($_SESSION['status']);
                }
                ?>
                <div class="card-header">
                    <h1>Ni Aasre Da Aasra
                        <button type="button" class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#Baghat">
                            New Admission
                        </button>
                    </h1>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">#ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Father Name</th>
                            <th scope="col">Mobile No</th>
                            <th scope="col">Date of Joining</th>
                            <th scope="col">View</th>
                            <th scope="col">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $query = "SELECT * FROM baghat";
                        $result = mysqli_query($conn, $query);
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>
                                <td>{$row['id']}</td>
                                <td>{$row['name']}</td>
                                <td>{$row['fname']}</td>
                                <td>{$row['mobile_no']}</td>
                                <td>{$row['date_of_joining']}</td>
                                <td>
                                    <button class='btn btn-success view_btn' data-id='{$row['id']}' data-name='{$row['name']}' data-fname='{$row['fname']}' data-mobile_no='{$row['mobile_no']}' data-date_of_joining='{$row['date_of_joining']}'>View</button>
                                </td>
                                <td>
                                    <button class='btn btn-info edit_btn' data-id='{$row['id']}' data-name='{$row['name']}' data-fname='{$row['fname']}' data-mobile_no='{$row['mobile_no']}' data-date_of_joining='{$row['date_of_joining']}'>Edit</button>
                                    <button class='btn btn-danger delete_btn' data-id='{$row['id']}'>Delete</button>
                                </td>
                            </tr>";
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>

<script>
    $(document).ready(function () {
        // View Button click event
        $('.view_btn').click(function () {
            var name = $(this).data('name');
            var fname = $(this).data('fname');
            var mobile_no = $(this).data('mobile_no');
            var date_of_joining = $(this).data('date_of_joining');
            
            // Populate the modal fields
            $('#view_name').val(name);
            $('#view_fname').val(fname);
            $('#view_mobile_no').val(mobile_no);
            $('#view_date_of_joining').val(date_of_joining);

            $('#ViewBaghat').modal('show');
        });

        // Delete Button click event (with confirmation)
        $('.delete_btn').click(function () {
            var baghat_id = $(this).data('id');
            var confirmation = confirm("Are you sure you want to delete this record?");
            if (confirmation) {
                var form = $('<form>', {
                    action: 'index.php',
                    method: 'POST'
                }).append($('<input>', {
                    type: 'hidden',
                    name: 'baghat_id',
                    value: baghat_id
                })).append($('<input>', {
                    type: 'hidden',
                    name: 'delete_baghat',
                    value: true
                }));
                $('body').append(form);
                form.submit();
            }
        });

        // PDF Download functionality
        $('#downloadPdf').click(function () {
            const { jsPDF } = window.jspdf;
            const doc = new jsPDF();
            doc.setFont("helvetica", "bold");
            doc.setFontSize(18);
            doc.text("Ni Aasre Da Aasra", 105, 10, { align: "center" });
            
            doc.autoTable({
                startY: 20,
                head: [['Name', 'Father Name', 'Mobile No', 'Date of Joining']],
                body: [
                    [
                         $('#view_name').val(), 
                         $('#view_fname').val(),
                         $('#view_mobile_no').val(), 
                         $('#view_date_of_joining').val(),
                    ]
                ],
                theme: 'grid',
                styles: { fontSize: 12 }
            });

            doc.save('baghat_data.pdf');
        });

        // Edit Button click event
        $('.edit_btn').click(function () {
            var baghat_id = $(this).data('id');
            var name = $(this).data('name');
            var fname = $(this).data('fname');
            var mobile_no = $(this).data('mobile_no');
            var date_of_joining = $(this).data('date_of_joining');
            
            // Populate the modal with current data
            $('#Baghat').find('input[name="name"]').val(name);
            $('#Baghat').find('input[name="fname"]').val(fname);
            $('#Baghat').find('input[name="mobile_no"]').val(mobile_no);
            $('#Baghat').find('input[name="date_of_joining"]').val(date_of_joining);

            // Set the hidden input field for the baghat_id to update the record
            $('#Baghat').find('form').append('<input type="hidden" name="baghat_id" value="' + baghat_id + '">');
            $('#Baghat').find('button[type="submit"]').attr('name', 'edit_baghat');

            $('#Baghat').modal('show');
        });
    });
</script>

</body>
</html>
