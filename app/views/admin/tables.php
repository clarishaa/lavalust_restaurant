<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>La MinSU</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="public/admin/css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="/">ADMIN</a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
        <!-- Navbar Search-->
        <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
            <div class="input-group">
                <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
                <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
            </div>
        </form>
        <!-- Navbar-->
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li>
                        <hr class="dropdown-divider" />
                    </li>
                    <li><a class="dropdown-item" href="#!">Logout</a></li>
                </ul>
            </li>
        </ul>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading">Admin</div>
                        <a class="nav-link" href="/admin">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Dashboard
                        </a>
                        <div class="sb-sidenav-menu-heading">Interface</div>
                        <a class="nav-link collapsed" href="/manage-menu" aria-expanded="false" aria-controls="collapseLayouts">
                            <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                            Inventory Management
                        </a>
                        <a class="nav-link collapsed" href="/pos" aria-expanded="false" aria-controls="collapseLayouts">
                            <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                            Order Management
                        </a>
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                            <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                            User Management
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="/manage-staff">Staff Management</a>
                                <a class="nav-link" href="/manage-customer">Customer Management</a>
                            </nav>
                        </div>
                        <a class="nav-link collapsed" href="/manage-reservation" data-bs-toggle="collapse" data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                            <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                            Reservations
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                <a class="nav-link collapsed" href="/tables" aria-expanded="false" aria-controls="pagesCollapseAuth">
                                    Table Management
                                </a>
                                <a class="nav-link collapsed" href="/bookings"  aria-expanded="false" aria-controls="pagesCollapseError">
                                    Reservation Management
                                </a>
                            </nav>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Tables</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">Table Management</li>
                    </ol>
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            Tables
                            <a href="<?= site_url('add-staff/') ?>" class="btn btn-primary float-end" data-toggle="modal" data-target="#addModal">Add</a>
                        </div>
                        <div class="card-body">
                            <table id="datatablesSimple">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Table No.</th>
                                        <th>Description</th>
                                        <th>Availability</th>
                                        <th>Capacity</th>
                                        <th>Price</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>No.</th>
                                        <th>Table No.</th>
                                        <th>Description</th>
                                        <th>Availability</th>
                                        <th>Capacity</th>
                                        <th>Price</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php
                                    $counter = 1; ?>
                                    <?php foreach ($data as $staffs) : ?>
                                        <tr>
                                            <td><?= $counter++ ?></td>
                                            <td><?= $staffs['table_number'] ?></td>
                                            <td><?= $staffs['description'] ?></td>
                                            <td><?= $staffs['availability'] ?></td>
                                            <td><?= $staffs['capacity'] ?></td>
                                            <td>₱ <?= $staffs['price'] ?></td>
                                            <td class="action-buttons">
                                                <a href="<?= site_url('table-delete/' . $staffs['table_id']) ?>" class="btn btn-danger">Delete</a>
                                                <a href="<?= site_url('table-edit/' . $staffs['table_id']) ?>" class="btn btn-primary" data-toggle="modal" data-target="#editModal<?= $staffs['table_id'] ?>">Edit</a>
                                            </td>
                                        </tr>
                                        <div class="modal fade" id="editModal<?= $staffs['table_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="editModalLabel<?= $staffs['table_id'] ?>" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="editModalLabel">Edit Staff</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="<?= site_url('table-update/') . $staffs['table_id']?>" method="post" enctype="multipart/form-data">
                                                            <div class="form-group">
                                                                <label for="tableNo">Table No:</label>
                                                                <input type="text" class="form-control" id="tableNo" name="tableNo" value="<?= $staffs['table_number'] ?>">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="description">Description:</label>
                                                                <textarea class="form-control" id="description" name="description"><?= $staffs['description'] ?></textarea>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="availability">Availability:</label>
                                                                <select class="form-control" id="availability" name="availability" required>
                                                                    <option value="" disabled>Select availability</option>
                                                                    <option value="0" <?= ($staffs['is_available'] == '0') ? 'selected' : '' ?>>Not Available</option>
                                                                    <option value="1" <?= ($staffs['is_available'] == '1') ? 'selected' : '' ?>>Available</option>
                                                                </select>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="capacity">Capacity:</label>
                                                                <input type="number" class="form-control" id="capacity" name="capacity" value="<?= $staffs['capacity'] ?>">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="price">Price:</label>
                                                                <input type="number" class="form-control" id="price" name="price" value="<?= $staffs['price'] ?>">
                                                            </div>
                                                            <div class="form-group">
                                                            </div>
                                                            <input class="btn btn-primary float-end" type="submit" value="<?= "Update" ?>">
                                                        </form>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="addModalLabel">Add Table</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="<?= site_url('table-add/')?>" method="post" enctype="multipart/form-data">
                                                        <div class="form-group">
                                                            <label for="tableNo">Table No:</label>
                                                            <input type="text" class="form-control" id="tableNo" name="tableNo" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="description">Description:</label>
                                                            <textarea class="form-control" id="description" name="description" required></textarea>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="availability">Availability:</label>
                                                            <select class="form-control" id="availability" name="availability" required>
                                                                <option value="" disabled selected>Select availability</option>
                                                                <option value="0">Not Available</option>
                                                                <option value="1">Available</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="capacity">Capacity:</label>
                                                            <input type="number" class="form-control" id="capacity" name="capacity" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="price">Price:</label>
                                                            <input type="number" class="form-control" id="price" name="price" required>
                                                        </div>

                                                        <input class="btn btn-primary float-end" type="submit" value="Submit">
                                                    </form>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </main>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="public/admin/js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="public/admin/assets/demo/chart-area-demo.js"></script>
        <script src="public/admin/assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="public/admin/js/datatables-simple-demo.js"></script>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

</body>

</html>