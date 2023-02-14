<?php

// Define the Item class with its properties
class Item
{
    public $name;
    public $description;
    public $price;

    public function __construct($name, $description, $price)
    {
        $this->name = $name;
        $this->description = $description;
        $this->price = $price;
    }
}

// Create instances of the Item class to represent food truck items and store in an array. 
$menu = [];
$menu[] = new Item("Burger", "100% beef patty with lettuce, tomato, and cheese", 5.99);
$menu[] = new Item("Fries", "Golden brown and crispy, served with ketchup", 2.99);
$menu[] = new Item("Drink", "Refreshing soda, choose from Coke, Sprite, or Fanta", 1.99);

echo '<pre>';
echo var_dump($menu[0]);
echo '</pre>';

// echo gettype((int)$_POST['quantity']);

// Check if the form has been submitted
if (isset($_POST["submit"])) {
    // Initialize the total cost
    $total = 0;

    // get the total of each item and add it to the total bill
    foreach ($menu as $item) {
        // Check if the item was selected
        if (isset($_POST['quantity'])) {

            $total += $item->price * (float)$_POST['quantity'][$item->name];
        }

        if (isset($_POST['cheese'])) {
            $total += $_POST['cheese'];
        }
    }

    // Check if the total is greater than 0
    if ($total > 0) {
        //calculate the cost of each item by the quantity and display each of them.
        echo "<h2>Your Order:</h2>";
        foreach ($menu as $item) {
            if (isset($_POST['quantity'])) {
                $individual_totals = $item->price * (float)$_POST['quantity'][$item->name];
                // echo gettype($individual_totals);
                echo '<p> ' . $item->name . ' x ' . $_POST['quantity'][$item->name] . ': ' . number_format($individual_totals, 2) . '
                
                ';
            }
        }

        echo "<p><strong>Total: $" . number_format($total, 2) . "</strong></p>";
    } else {
        // Display an error message if no items were selected
        echo "<p class='alert'><b>Please select at least one item.</b></p>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="style.css">
    <title>Order Food</title>
</head>

<body>
    <main>
        <header>
            <h1>Food Truck Menu</h1>
        </header>


        <!-- Create the form to allow items to be chosen -->

        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <fieldset>


                <!-- Loop through the menu items -->
                <?php foreach ($menu as $item) { ?>

                    <label class="item-name"> <?php echo $item->name; ?></label>

                    <p><?php echo $item->price; ?></p>

                    <p><?php echo $item->description; ?></p>

                    <input type="number" name="quantity[<?php echo $item->name; ?>]">

                <?php } ?>

                <!-- Adds the extras section -->
                <h3>Extras</h3>
                <p>Cheese: $0.25</p>

                <label>Add Cheese:</label>
                <input type="checkbox" name="cheese" value="0.25">
                <br><br>

                <input type="submit" name="submit" value="Place Order">
            </fieldset>
        </form>


    </main>
</body>

</html>