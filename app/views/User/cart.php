<!DOCTYPE html>
<html>

<head>
    <!-- Basic -->
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!-- Site Metas -->
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <link rel="shortcut icon" href="public/user/images/favicon.png" type="">

    <title> La MinSU </title>

    <!-- bootstrap core css -->
    <link rel="stylesheet" type="text/css" href="public/user/css/bootstrap.css" />

    <!--owl slider stylesheet -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
    <!-- nice select  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/css/nice-select.min.css" integrity="sha512-CruCP+TD3yXzlvvijET8wV5WxxEh5H8P4cmz0RFbKK6FlZ2sYl3AEsKlLPHbniXKSrDdFewhbmBK5skbdsASbQ==" crossorigin="anonymous" />
    <!-- font awesome style -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Custom styles for this template -->
    <link href="public/user/css/style.css" rel="stylesheet" />
    <!-- responsive style -->
    <link href="public/user/css/responsive.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11">

</head>
<style>
    .custom_nav-container {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        z-index: 1000;
        background-color: #222831;
        box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.1);
        height: 80px;
    }

    .navbar-brand span {
        font-size: 24px;
        font-weight: bold;
        margin-left: 20px;
    }

    .navbar-nav {
        text-align: center;
    }

    .user_option {
        display: flex;
        align-items: center;
    }

    .navbar-toggler {
        border: none;
        background-color: transparent;
    }

    .navbar-nav .nav-link {
        font-size: 18px;
    }


    .order_online {
        margin-left: 10px;
        font-size: 18px;
        font-weight: bold;
    }

    @media (max-width: 576px) {
        .custom-img {
            max-width: 50%;
        }
    }

    /* Default styles for larger screens */
    .card.sticky-card {
        position: sticky;
        top: 100px;
        /* Adjust the top spacing as needed */
    }

    /* Custom styles for small screens */
    /* Custom styles for small screens */
    @media (max-width: 768px) {
        .sticky-card {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            padding: 15px;
            /* Add padding as needed */
            background-color: white;
            /* Add a background color if desired */
            box-shadow: 0 -2px 4px rgba(0, 0, 0, 0.1);
            /* Optional: Add a shadow to visually separate the card */
            z-index: 1000;
        }
    }
</style>

<body>

    <div class="hero_area">
        <div class="bg-box">
            <img src="public/user/images/hero-bg.jpg" alt="">
        </div>
        <!-- header section strats -->
        <header class="header_section">
            <div class="container">
                <nav class="navbar navbar-expand-lg custom_nav-container ">
                    <a class="navbar-brand" href="/">
                        <span>
                            La MinSU
                        </span>
                    </a>

                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class=""> </span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav  mx-auto ">
                            <li class="nav-item active">
                                <a class="nav-link" href="/">Home <span class="sr-only">(current)</span></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/menu">Menu</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/about">About</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/book">Book Table</a>
                            </li>
                        </ul>
                        <div class="user_option">
                            <a href="" class="user_link">
                                <i class="fa fa-user" aria-hidden="true"></i>
                            </a>
                            <a class="cart_link" href="/mycart">
                                <i class="fa badge fa-sm text-white" value=8>&#xf07a;</i>
                            </a>
                            <form class="form-inline">
                                <button class="btn  my-2 my-sm-0 nav_search-btn" type="submit">
                                    <i class="fa fa-search" aria-hidden="true"></i>
                                </button>
                            </form>
                            <a href="/logout" class="order_online">
                                Logout
                            </a>
                        </div>
                    </div>
                </nav>
            </div>
        </header>
        <!-- end header section -->
        <section class="h-100 bg-light">
            <div class="container py-5">
                <div class="row d-flex justify-content-center my-4">
                    <div class="col-md-8">
                        <div class="card mb-4">
                            <div class="card-header py-3">
                                <h5 class="mb-0">Cart - <?php echo count($data); ?> items</h5>
                            </div>
                            <div class="card-body">
                                <?php foreach ($data as $item) : ?>

                                    <!-- Single item -->
                                    <div class="row item-container" data-item-id="<?= $item['cart_id'] ?>">
                                        <div class="col-lg-3 col-md-12 mb-4 mb-lg-0">
                                            <!-- Image -->
                                            <div class="bg-image hover-overlay hover-zoom ripple rounded" data-mdb-ripple-color="light">
                                                <!-- Use class "img-fluid" to make the image responsive -->
                                                <img src="<?= $item['img_path'] ?>" class="img-fluid custom-img" alt="Blue Jeans Jacket" />

                                                <!-- Add margin utility classes for smaller screens -->
                                                <div class="mt-2 d-none d-sm-block"></div>

                                                <a href="#!">
                                                    <div class="mask" style="background-color: rgba(251, 251, 251, 0.2)"></div>
                                                </a>
                                            </div>

                                            <!-- Image -->
                                        </div>

                                        <div class="col-lg-5 col-md-6 mb-4 mb-lg-0">
                                            <!-- Data -->
                                            <p><strong><?= $item['product_name'] ?></strong></p>
                                            <p>Description: <?= $item['description'] ?></p>
                                            <p>Category: <?= $item['category_name'] ?></p>
                                            <a href="<?= site_url('delete/' . $item['cart_id']) ?>" class="btn btn-primary btn-sm me-1 mb-2" data-mdb-toggle="tooltip" title="Remove item">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                            <button type="button" class="btn btn-danger btn-sm mb-2" data-mdb-toggle="tooltip" title="Move to the wish list">
                                                <i class="fas fa-heart"></i>
                                            </button>
                                            <!-- Data -->
                                        </div>

                                        <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
                                            <!-- Quantity -->
                                            <div class="d-flex mb-4" style="max-width: 300px">
                                                <button class="btn btn-primary btn-sm p-2 me-2" onclick="changeQuantity('<?= site_url('decquantity/' . $item['cart_id']) ?>', -1, <?= $item['cart_id']; ?>)">
                                                    <i class="fas fa-minus"></i>
                                                </button>

                                                <div class="form-outline">
                                                    <input id="quantity_<?= $item['cart_id']; ?>" min="0" name="quantity" value="<?= $item['cart_quantity'] ?>" type="number" class="form-control" readonly />
                                                </div>

                                                <button class="btn btn-primary btn-sm p-2 ms-2" onclick="changeQuantity('<?= site_url('incquantity/' . $item['cart_id']) ?>', 1, <?= $item['cart_id']; ?>)">
                                                    <i class="fas fa-plus"></i>
                                                </button>
                                            </div>
                                            <!-- Quantity -->

                                            <!-- Price -->
                                            <p class="text-start text-md-center">
                                                <strong id="total_<?= $item['cart_id']; ?>">
                                                    ₱ <span id="totalValue_<?= $item['cart_id']; ?>">
                                                        <?php echo $item['cart_quantity'] * $item['price']; ?>
                                                    </span>
                                                </strong>
                                            </p>
                                            <!-- Price -->
                                        </div>
                                    </div>
                                    <!-- Single item -->
                                    <hr class="my-4" />
                                <?php endforeach; ?>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-4">
                        <div>

                        </div>
                        <div class="card mb-4 sticky-top sticky-card">
                            <div class="card-header py-3">
                                <h5 class="mb-0">Summary</h5>
                            </div>
                            <div class="card-body">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 pb-0">
                                        Products
                                        <span id="count">0</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 mb-3">
                                        <div>
                                            <strong>Total amount</strong>
                                            <strong>
                                                <p class="mb-0">(including VAT)</p>
                                            </strong>
                                        </div>
                                        <span><strong id="total-price"></strong></span>
                                    </li>
                                </ul>
                                <button type="button" class="btn btn-primary btn-lg btn-block" data-toggle="modal" data-target="#checkoutModal">
                                    Checkout
                                </button>
                            </div>
                            <hr class="my-4 bg-secondary">
                        </div>

                    </div>

                </div>
            </div>
        </section>
        <div class="modal fade" id="checkoutModal" tabindex="-1" role="dialog" aria-labelledby="checkoutModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="checkoutModalLabel">Checkout</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="/checkout" method="post" id="checkoutForm">
                            <!-- Order Type Dropdown -->
                            <div class="form-group">
                                <label for="orderType">Order Type:</label>
                                <select class="form-control" id="orderType" name="order_type" onchange="OrderTypeChange()">
                                    <option value="dinein">Dine-In</option>
                                    <option value="takeout">Takeout</option>
                                    <option value="delivery">Delivery</option>
                                </select>
                            </div>

                            <!-- Address Input (visible only for 'delivery' order type) -->
                            <div class="form-group" id="addressInput" style="display: none;">
                                <label for="address">Delivery Address:</label>
                                <input type="text" class="form-control" id="address" name="address">
                            </div>

                            <!-- Message Input -->
                            <div class="form-group">
                                <label for="message">Message:</label>
                                <textarea class="form-control" id="message" name="message"></textarea>
                            </div>

                            <!-- Hidden input for items -->
                            <input type="hidden" name="items" id="itemsInput" value="">

                            <!-- Display total price -->
                            <span>Amount Due: </span>
                            <span>₱</span><input name="total" type="text" id="modalTotalPrice" class="form-control mb-2 bg-white" readonly>
                            <!-- Checkout button -->
                            <button id="checkoutBtn" type="submit" class="btn btn-primary btn-lg btn-block">Checkout</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <script src="public/user/js/jquery-3.4.1.min.js"></script>
        <!-- popper js -->
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
        </script>
        <!-- bootstrap js -->
        <script src="public/user/js/bootstrap.js"></script>
        <!-- owl slider -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js">
        </script>
        <!-- isotope js -->
        <script src="https://unpkg.com/isotope-layout@3.0.4/dist/isotope.pkgd.min.js"></script>
        <!-- nice select -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/js/jquery.nice-select.min.js"></script>
        <!-- custom js -->
        <script src="public/user/js/custom.js"></script>
        <!-- Google Map -->
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCh39n5U-4IoWpsVGUHWdqB6puEkhRLdmI&callback=myMap">
        </script>
        <!-- End Google Map -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="../Notification.js"></script>
        <script>
            var selected = [];
            var itemCount = document.getElementById('count');
            var totalElement = document.getElementById('total-price');
            var modalTotalElement = document.getElementById('modalTotalPrice');

            function updateTotalAmount() {
                var totalPrice = 0;
                selected.forEach(function(id) {
                    var totalValueElement = document.getElementById('totalValue_' + id);
                    if (totalValueElement) {
                        var totalValueText = totalValueElement.textContent;
                        var totalValue = parseFloat(totalValueText.replace('₱', '').trim());
                        totalPrice += totalValue;
                    }
                });

                totalElement.textContent = '₱' + totalPrice.toFixed(2);

                modalTotalElement.value = totalPrice.toFixed(2);

                console.log(totalPrice);
                return totalPrice;
            }
            updateTotalAmount();


            function updateItemsInput(items) {
                document.getElementById('itemsInput').value = JSON.stringify(items);
            }

            function checkout(items) {
                var totalPrice = updateTotalAmount();
                updateItemsInput(items, totalPrice);
                document.getElementById('checkoutForm').submit();
            }
            document.addEventListener("DOMContentLoaded", function() {
                document.querySelectorAll('.item-container').forEach(item => item.addEventListener('click', function() {
                    var id = this.getAttribute('data-item-id');
                    this.classList.toggle('selected');
                    this.classList.contains('selected') ? selected.push(id) : selected.splice(selected.indexOf(id), 1);
                    itemCount.textContent = selected.length;
                    updateTotalAmount();

                }));

                var checkoutBtn = document.getElementById('checkoutBtn');
                checkoutBtn && checkoutBtn.addEventListener('click', () => {
                    var totalPrice = updateTotalAmount();
                    updateItemsInput(selected, totalPrice);
                    console.log("Total Price:", totalPrice);
                    checkout(selected);
                    console.log("Selected Items:", selected);
                });

            });


            function changeQuantity(url, amount, cartId) {
                var quantityInput = document.getElementById('quantity_' + cartId);
                var totalValueElement = document.getElementById('totalValue_' + cartId);

                var currentValue = parseInt(quantityInput.value, 10);
                var newQuantity = Math.max(0, currentValue + amount);

                quantityInput.value = newQuantity;

                var total = newQuantity * <?= $item['price']; ?>;
                totalValueElement.textContent = total.toFixed(2);

                updateTotalAmount();

                var xhr = new XMLHttpRequest();
                xhr.open('POST', url, true);
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                xhr.onreadystatechange = function() {
                    if (xhr.readyState == 4 && xhr.status == 200) {
                        console.log(xhr.responseText);
                    }
                };

                xhr.send('quantity=' + newQuantity);
            }

            function OrderTypeChange() {
                var orderType = document.getElementById('orderType').value;
                var addressInputContainer = document.getElementById('addressInput');

                if (orderType === 'delivery') {
                    addressInputContainer.style.display = 'block';
                } else {
                    addressInputContainer.style.display = 'none';
                }
            }
        </script>


        <style>
            .selected {
                background-color: #e6f7ff;
            }
        </style>
</body>

</html>