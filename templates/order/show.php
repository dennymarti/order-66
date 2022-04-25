<div class="order-wrapper">
    <?php
if (empty($orders)) {
    echo "<h1>There are no orders.</h1>";
    echo "<p class='form-text'><a class='link' href='/order'>Order here</a></p>";
} else {
    foreach ($orders as $order) {
        echo "
<div class='box'>
    <h1>Order $order->id</h1>
    <div class='form-row'>
        <h4>Bread: $order->bread</h4>
        <h4>Length: $order->length cm</h4>
        <h4>Toppings: ";

        foreach ($toppingList[$order->id] as $topping) {
            echo $topping . ", ";
        }

        echo "</h4>
        <a class='link' href='/order/edit?id=$order->id'>Edit</a>
        <a class='link' href='/order/delete?id=$order->id'>Delete</a>
    </div>
</div>";
    }
}
?>
</div>