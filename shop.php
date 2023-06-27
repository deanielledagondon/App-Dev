<?php
include 'config.php';

session_start();

if (!isset($_SESSION['user_id'])) {
    // If not, log them in using the guest user account
    $guest_user_id = 0; // Set the guest user ID
    $_SESSION['user_id'] = $guest_user_id; // Set the session user ID
}

$user_id = $_SESSION['user_id'];

if (isset($_POST['add_to_cart'])) {
    if ($user_id == 0) {
        // Guest user attempting to add a product to cart
        echo "<script>alert('Please login first to add the product to cart!');</script>";
    } else {
        $product_name = $_POST['product_name'];
        $product_price = $_POST['product_price'];
        $product_image = $_POST['product_image'];
        $product_quantity = $_POST['product_quantity'];

        $check_cart_numbers = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');
        if (mysqli_num_rows($check_cart_numbers) > 0) {
            $message[] = 'Already added to cart!';
        } else {
            mysqli_query($conn, "INSERT INTO `cart`(user_id, name, price, quantity, image) VALUES('$user_id', '$product_name', '$product_price', '$product_quantity', '$product_image')") or die('query failed');
            $message[] = 'Product added to cart!';
        }
    }
}

$search = isset($_GET['search']) ? $_GET['search'] : '';
// diri nako gi kwan ang initialization sa filtering
$category_filters = isset($_GET['products_category']) ? $_GET['products_category'] : array();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop</title>
    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <?php include 'header.php'; ?>

    <div class="sidebar">
        <h3>Filters</h3>
        <br>
        <h4>Categories</h4>
        <form method="GET">
            <label><input type="checkbox" name="products_category[]" value="Computer Package" <?php if (in_array("Computer Package", $category_filters)) echo "checked"; ?>> Computer Package</label><br>
            <label><input type="checkbox" name="products_category[]" value="Monitor" <?php if (in_array("Monitor", $category_filters)) echo "checked"; ?>> Monitor</label><br>
            <label><input type="checkbox" name="products_category[]" value="Keyboard" <?php if (in_array("Keyboard", $category_filters)) echo "checked"; ?>> Keyboard</label><br>
            <label><input type="checkbox" name="products_category[]" value="Motherboard" <?php if (in_array("Motherboard", $category_filters)) echo "checked"; ?>> Motherboard</label><br>
            <label><input type="checkbox" name="products_category[]" value="Graphics Card" <?php if (in_array("Graphics Card", $category_filters)) echo "checked"; ?>> Graphics Card</label><br>
            <label><input type="checkbox" name="products_category[]" value="RAM" <?php if (in_array("RAM", $category_filters)) echo "checked"; ?>> RAM</label><br>
            <button type="submit" class="btn btn-primary">Apply Filters</button>
        </form>
    </div>
    

    <div class="main-content">
        <div class="heading">
            <h3>Featured Products</h3>
            <p><a href="home.php">Home</a> / Shop</p>

            <!-- diri ang ui sa search product-->
            <form method="GET" class="input-group-mb3">
                <input type="text" name="search" value="<?php echo $search; ?>" placeholder="Search Products">
                <button type="submit" class="btn btn-primary">Find</button>
            </form>
        </div>

        <section class="show-products">
            <section class="products">
                <div class="box-container">

                    <?php
                    // diri ang query sa filtering
                    $where_clause = "";
                    if (!empty($category_filters)) {
                        $categories = implode($category_filters);
                        $where_clause = "WHERE products_category IN ('$categories')";
                    }
                    if (!empty($search)) {
                        if (!empty($where_clause)) {
                            $where_clause .= " AND name LIKE '%$search%'";
                        } else {
                            $where_clause = "WHERE name LIKE '%$search%'";
                        }
                    }

                    $select_products = mysqli_query($conn, "SELECT * FROM `products` $where_clause") or die('query failed');
                    if (mysqli_num_rows($select_products) > 0) {
                        while ($fetch_products = mysqli_fetch_assoc($select_products)) {
                            ?>
                            <form action="" method="post" class="box">
                                <a href="viewshop.php?id=<?php echo $fetch_products['id']; ?>">
                                    <img class="image" src="uploaded_img/<?php echo $fetch_products['image']; ?>" alt="" height="100" width="260">
                                    <div class="name"><?php echo $fetch_products['name']; ?></div>
                                    <div class="price">₱<?php echo $fetch_products['price']; ?></div>
                                    <input type="number" min="1" name="product_quantity" value="1" class="qty">
                                    <input type="hidden" name="product_name" value="<?php echo $fetch_products['name']; ?>">
                                    <input type="hidden" name="product_price" value="<?php echo $fetch_products['price']; ?>">
                                    <input type="hidden" name="product_image" value="<?php echo $fetch_products['image']; ?>">
                                    <input type="submit" value="add to cart" name="add_to_cart" class="btn">
                                </a>
                            </form>
                            <?php
                        }
                    } else {
                        echo '<p class="empty">No products added yet!</p>';
                    }
                    ?>
                </div>
            </section>
        </section>
    </div>

    <!-- custom js file link  -->
    <script src="js/script.js"></script>
</body>

</html>
