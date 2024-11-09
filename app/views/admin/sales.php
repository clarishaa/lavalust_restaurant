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
                            Point-of-Sale
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

            <!-- ========================= SECTION CONTENT ========================= -->
            <section class="section-content padding-y-sm bg-default m-3">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-7 card padding-y-sm card">
                            <ul class="nav bg radius nav-pills nav-fill mb-3 bg filters_menu" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active show" data-toggle="pill" href="#nav-tab-all">
                                        <i class="fa fa-tags"></i> All
                                    </a>
                                </li>
                                <?php foreach ($category_data as $categ) : ?>
                                    <li class="nav-item" data-filter=".<?= $categ['category_id'] ?>">
                                        <a class="nav-link" data-toggle="pill" href="#nav-tab-category-<?= $categ['category_id'] ?>">
                                            <i class="fa fa-cutlery"></i> <?= $categ['name'] ?>
                                        </a>
                                    </li>
                                <?php endforeach; ?>
                            </ul>

                            <span id="items">
                                <div class="row filters-content">
                                    <?php foreach ($menu_data as $item) : ?>
                                        <div class="col-md-3 all <?= $item['category_id'] ?>">
                                            <figure class="card card-product" style="height: 230px; border: 1px solid #ccc; border-radius: 10px; overflow: hidden; position: relative;">
                                                <div class="img-wrap" style="height: 70%;">
                                                    <img src="<?= $item['img_path'] ?>" alt="Product 1" class="img-fluid" style="object-fit: cover; width: 100%; height: 100%;">
                                                </div>
                                                <figcaption class="info-wrap" style="height: 30%; background-color: #f8f9fa; padding: 10px;">
                                                    <div class="row h-100">
                                                        <div class="col-md-12">
                                                            <a href="#" class="title mb-2" style="font-size: 14px;"><?= $item['name'] ?></a>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="action-wrap text-end">
                                                                <form action="/poscart" method="post">
                                                                    <input type="hidden" name="item" value="<?= $item['item_id'] ?>">
                                                                    <button type="submit" class="btn btn-primary btn-sm">
                                                                        <i class="fa fa-cart-plus"></i>
                                                                    </button>
                                                                </form>
                                                                <div class="price-wrap h5">
                                                                    <span class="price"></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </figcaption>
                                            </figure>


                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </span>


                        </div>

                        <div class="col-md-5">
                            <div class="card">
                                <div id="cart" class="p-3">
                                    <!-- Shopping cart table -->
                                    <table class="table table-hover shopping-cart-wrap">
                                        <!-- Table header -->
                                        <thead class="text-muted">
                                            <tr>
                                                <th scope="col">Item</th>
                                                <th scope="col" style="width: 120px;">Qty</th>
                                                <th scope="col" style="width: 120px;">Price</th>
                                                <th scope="col" class="text-end" style="width: 200px;">Delete</th>
                                            </tr>
                                        </thead>
                                        <!-- Table body -->
                                        <!-- Table body -->
                                        <tbody>
                                            <?php foreach ($cart_data as $item) : ?>
                                                <tr>
                                                    <td>
                                                        <div class="media">
                                                            <div class="img-wrap">
                                                                <img src="<?= $item['img_path'] ?>" class="img-xs" alt="" style="width: 50px; height: 50px;">
                                                            </div>
                                                            <div class="media-body" style="text-align: center; margin-top: 5px;">
                                                                <h6 class="title text-truncate"><?= $item['product_name'] ?></h6>
                                                            </div>
                                                        </div>

                                                    </td>
                                                    <td class="text-center">
                                                        <div class="btn-group" role="group" aria-label="Quantity Control">
                                                            <button type="button" class="btn btn-outline-secondary" onclick="changeQuantity('<?= site_url('decquantity/' . $item['cart_id']) ?>', -1, <?= $item['cart_id']; ?>)">
                                                                <i class="fa fa-minus"></i>
                                                            </button>
                                                            <button type="button" class="btn btn-outline-secondary" disabled id="quantity_<?= $item['cart_id']; ?>">
                                                                <?= $item['cart_quantity'] ?>
                                                            </button>
                                                            <button type="button" class="btn btn-outline-secondary" onclick="changeQuantity('<?= site_url('incquantity/' . $item['cart_id']) ?>', 1, <?= $item['cart_id']; ?>)">
                                                                <i class="fa fa-plus"></i>
                                                            </button>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="price-wrap">
                                                            <span class="price" id="totalValue_<?= $item['cart_id']; ?>" data-price="<?= $item['price']; ?>">
                                                                ₱<?= number_format($item['cart_quantity'] * $item['price'], 2) ?>
                                                            </span>
                                                        </div>
                                                    </td>

                                                    <td class="text-end">
                                                        <div class="btn-group" role="group" aria-label="Delete">
                                                            <a href="<?= site_url('deletepos/' . $item['cart_id']) ?>" class="btn btn-outline-danger"> <i class="fa fa-trash"></i></a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>

                                    </table>
                                </div>
                                <?php
                                $subtotal = 0;

                                foreach ($cart_data as $item) {
                                    $itemTotal = $item['cart_quantity'] * $item['price'];
                                    $subtotal += $itemTotal;
                                } ?>
                                <?php
                                $taxRate = 0.12;
                                $tax = $subtotal * $taxRate;
                                $total = $subtotal + $tax;
                                ?>
                                <!-- Totals and buttons -->
                                <div class="box m-3">
                                    <dl class="dlist-align">
                                        <dt class="fw-bold">Tax:</dt>
                                        <dd class="text-end">12%</dd>
                                    </dl>
                                    <dl class="dlist-align">
                                        <dt class="fw-bold">Sub Total:</dt>
                                        <dd class="text-end"><span id="total">₱<?= number_format($subtotal, 2) ?></span></dd>
                                    </dl>
                                    <dl class="dlist-align">
                                        <dt class="fw-bold">Total:</dt>
                                        <dd class="text-end h4 b"><span id="total-price">₱<?= number_format($total, 2) ?></span></dd>
                                    </dl>
                                    <form action="/posdel" method="post">
                                        <?php foreach ($cart_data as $item) : ?>
                                            <input type="hidden" name="cart_ids[]" value="<?= $item['cart_id'] ?>">
                                        <?php endforeach; ?>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <button type="submit" class="btn btn-danger btn-lg btn-block"><i class="fa fa-times-circle"></i> Cancel</button>
                                            </div>
                                            <div class="col-md-6">
                                                <button type="button" class="btn btn-primary btn-lg btn-block" data-toggle="modal" data-target="#myModal">
                                                    <i class="fa fa-shopping-bag"></i> Charge
                                                </button>
                                            </div>
                                        </div>
                                    </form>

                                </div> <!-- box -->
                            </div>
                            <form action="/pay" method="post">
                                <div class="input-group mt-2">
                                    <input type="text" class="form-control" name="invoice" id="qrCodeInput" placeholder="Scan QR or enter invoice number.">
                                    <button type="submit" class="btn btn-primary me-1">Submit</button>
                                    <button type="button" class="btn btn-success" onclick="initiateQRScanner()">Scan</button>
                                </div>
                            </form>
                            <video id="qrCodeScanner" style="display: none;" class="col-10"></video>
                        </div>
                    </div>
                </div><!-- container //  -->
            </section>
            <!-- ========================= SECTION CONTENT END// ========================= -->
            <input type="hidden" id="itemsInput" name="itemsInput" value="">
            <!-- Your modal -->
            <div class="modal" id="myModal">
                <div class="modal-dialog receipt-modal">
                    <div class="modal-content">
                        <form action="/checkoutpos" method="post" id="myForm">
                            <div id="rec">
                                <div class="modal-header">
                                    <?php
                                    $receiptNumber = 'LMCC' . date('YmdHis');
                                    ?>
                                    <h4 class="modal-title">Receipt No: <?php echo $receiptNumber; ?></h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>

                                <div class="modal-body">
                                    <input type="hidden" name="receipt_number" value="<?php echo $receiptNumber; ?>">

                                    <div class="row">
                                        <div class="col-md-12 text-center">
                                            <h5> <img src="favicon.ico" alt="La Minsu Logo" style="max-width: 10%; height: auto;">
                                                <strong>La Minsu</strong>
                                            </h5>
                                            <p>Masipit, Calapan City | Contact: (123) 456-7890</p>
                                        </div>
                                    </div>

                                    <hr>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>Product</th>
                                                        <th class="text-right">Quantity</th>
                                                        <th class="text-right">Unit Price</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $subtotal = 0;
                                                    foreach ($cart_data as $item) :
                                                        $itemTotal = $item['cart_quantity'] * $item['price'];
                                                        $subtotal += $itemTotal;
                                                    ?>
                                                        <tr>
                                                            <td><strong><?= $item['product_name'] ?></strong></td>
                                                            <td class="text-right"><?= $item['cart_quantity'] ?></td>
                                                            <td class="text-right">₱<?= $item['price']; ?></td>
                                                        </tr>
                                                        <input type="hidden" name="cart_ids[]" value="<?= $item['cart_id'] ?>">
                                                    <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    <hr>

                                    <?php
                                    $taxRate = 0.12;
                                    $tax = $subtotal * $taxRate;
                                    $total = $subtotal + $tax;
                                    ?>
                                    <div class="row text-end">
                                        <div class="col-md-12">
                                            <p><strong>Tax (12%):</strong> ₱<?= number_format($tax, 2) ?></p>
                                            <p><strong>Sub Total:</strong> ₱<?= number_format($subtotal, 2) ?></p>
                                            <p><strong>Total:</strong> ₱<?= number_format($total, 2) ?></p>
                                            <input type="hidden" name="tax" value="<?= $tax ?>">
                                            <input type="hidden" name="subtotal" value="<?= $subtotal ?>">
                                            <input type="hidden" name="total" value="<?= $total ?>">
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Pay</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>

        </div>
        <script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
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
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js" integrity="sha512-BNaRQnYJYiPSqHHDb58B0yaPfCu+Wgds8Gp/gU33kqBtgNS4tSPHuGibyoeqMV/TJlSKda6FXzoEyYGjTe+vXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

        <script>
            $(document).ready(function() {
                $('.nav-link').on('click', function() {
                    var filterClass = $(this).closest('li').data('filter');
                    if (filterClass) {
                        $('.filters-content .col-md-3').hide();
                        $('.filters-content ' + filterClass).show();
                    } else {
                        $('.filters-content .col-md-3').show();
                    }
                });
            });
        </script>
        <script>
            function displayError(message) {
                alert(message);
                window.location.reload();
            }


            function changeQuantity(url, amount, cartId) {
                var quantityElement = document.getElementById('quantity_' + cartId);
                var totalValueElement = document.getElementById('totalValue_' + cartId);

                var currentValue = parseInt(quantityElement.textContent, 10);
                var newQuantity = Math.max(0, currentValue + amount);

                quantityElement.textContent = newQuantity;

                var price = parseFloat(totalValueElement.dataset.price);
                var newTotal = newQuantity * price;
                totalValueElement.textContent = '₱' + newTotal.toFixed(2);

                var xhr = new XMLHttpRequest();
                xhr.open('POST', url, true);
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                xhr.onreadystatechange = function() {
                    if (xhr.status == 200) {
                        var response = JSON.parse(xhr.responseText);
                        if (!response.success) {
                            displayError(response.message);
                        }
                    } else {
                        displayError('Failed to update quantity. Please try again.');
                    }
                };

                xhr.send('quantity=' + newQuantity);
            }
        </script>
        <script>
            document.getElementById('myForm').addEventListener('submit', async function(event) {
                event.preventDefault();

                const cardElement = document.querySelector('#rec');

                if (cardElement) {
                    try {
                        const canvas = await html2canvas(cardElement);
                        const imageData = canvas.toDataURL('image/png');

                        const link = document.createElement('a');
                        link.href = imageData;
                        link.download = 'receipt.png';
                        link.click();
                    } catch (error) {
                        console.error('Error saving image:', error);
                    }
                }
                this.submit();
            });
        </script>
        <script src="https://unpkg.com/@zxing/library@0.23.0"></script>
        <script src="https://rawgit.com/sitepoint-editors/jsqrcode/master/src/qr_packed.js"></script>
        <script src="https://rawgit.com/sitepoint-editors/jsqrcode/master/src/grid.js"></script>
        <script src="https://rawgit.com/sitepoint-editors/jsqrcode/master/src/version.js"></script>
        <script src="https://rawgit.com/sitepoint-editors/jsqrcode/master/src/detector.js"></script>
        <script src="https://rawgit.com/sitepoint-editors/jsqrcode/master/src/formatinf.js"></script>
        <script src="https://rawgit.com/sitepoint-editors/jsqrcode/master/src/errorlevel.js"></script>
        <script src="https://rawgit.com/sitepoint-editors/jsqrcode/master/src/bitmat.js"></script>
        <script src="https://rawgit.com/sitepoint-editors/jsqrcode/master/src/datablock.js"></script>
        <script src="https://rawgit.com/sitepoint-editors/jsqrcode/master/src/bmparser.js"></script>
        <script src="https://rawgit.com/sitepoint-editors/jsqrcode/master/src/datamask.js"></script>
        <script src="https://rawgit.com/sitepoint-editors/jsqrcode/master/src/rsdecoder.js"></script>
        <script src="https://rawgit.com/sitepoint-editors/jsqrcode/master/src/gf256poly.js"></script>
        <script src="https://rawgit.com/sitepoint-editors/jsqrcode/master/src/gf256.js"></script>
        <script src="https://rawgit.com/sitepoint-editors/jsqrcode/master/src/decoder.js"></script>
        <script src="https://rawgit.com/sitepoint-editors/jsqrcode/master/src/qrcode.js"></script>
        <script src="https://rawgit.com/sitepoint-editors/jsqrcode/master/src/findpat.js"></script>
        <script src="https://rawgit.com/sitepoint-editors/jsqrcode/master/src/databr.js"></script>

        <script>
    function initiateQRScanner() {
        const qrCodeInput = document.getElementById('qrCodeInput');
        const qrCodeScanner = document.getElementById('qrCodeScanner');

        const scanner = new Instascan.Scanner({
            video: document.getElementById('qrCodeScanner')
        });

        scanner.addListener('scan', function(content) {
            qrCodeInput.value = content;
            scanner.stop(); // Stop the scanner after a successful scan
            qrCodeScanner.style.display = 'none';
        });

        Instascan.Camera.getCameras().then(function(cameras) {
            if (cameras.length > 0) {
                scanner.start(cameras[0]);
                qrCodeScanner.style.display = 'block';
            } else {
                console.error('No cameras found.');
                alert('No cameras found. Please make sure your camera is connected and accessible.');
            }
        }).catch(function(error) {
            console.error('Error accessing cameras:', error);
            alert('Error accessing cameras. Please try again.');
        });
    }
</script>

</body>

</html>