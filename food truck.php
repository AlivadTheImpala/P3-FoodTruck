
<?php

// Define the Item class with its properties
class Item {
    public $name;
    public $description;
    public $price;

    public function __construct($name, $description, $price) {
        $this->name = $name;
        $this->description = $description;
        $this->price = $price;
    }
}

// Create instances of the Item class to represent food truck items
$burger = new Item("Burger", "100% beef patty with lettuce, tomato, and cheese", 5.99);
$fries = new Item("Fries", "Golden brown and crispy, served with ketchup", 2.99);
$drink = new Item("Drink", "Refreshing soda, choose from Coke, Sprite, or Fanta", 1.99);

// Store the food truck items in an array
$menu = [$burger, $fries, $drink];

// Check if the form has been submitted
if (isset($_POST["submit"])) {
    // Initialize the total cost
    $total = 0;

    // Loop through the menu items
    foreach ($menu as $item) {
        // Check if the item was selected
        if (isset($_POST[$item->name])) {
            // Add the item price to the total
            $total += $item->price * $_POST[$item->name];
        }
    }

    // Check if the total is greater than 0
    if ($total > 0) {
        // Display the items and the total cost
        echo "<h2>Your Order:</h2>";
        foreach ($menu as $item) {
            if (isset($_POST[$item->name])) {
                echo "<p>" . $item->name . " x " . $_POST[$item->name] . ": $" . $item->price * $_POST[$item->name] . "</p>";
            }
        }
        echo "<p><strong>Total: $" . $total . "</strong></p>";
    } else {
        // Display an error message if no items were selected
        echo "<p>Please select at least one item.</p>";
    }
}

?>

<!-- Create the form to allow items to be chosen -->

<form action="<?php echo $_SERVER[ 'PHP_SELF']; ?>" method="post">
    <h2>Food Truck Menu</h2>
    <!-- Loop through the menu items -->
    <?php foreach ($menu as $item) { ?>
    <h3>
        <?php echo $item->name; ?>
    </h3>
    <p>
        <?php echo $item->description; ?>
    </p>
    <p>Price: $
        <?php echo $item->price; ?>
    </p>
    <label for="<?php echo $item->name; ?>">Quantity:</label>
    <input type="number" name="<?php echo $item->name; ?>" value="0" min="0">
    <br><br>
    <?php } ?>

    <!-- Add the extras section -->
    <h3>Extras</h3>
    <p>Cheese: $0.25</p>
    <label for="cheese">Add Cheese:</label>
    <input type="checkbox" name="cheese">
    <br><br>

    <input type="submit" name="submit" value="Place Order">
</form>
