<form class="form">
    <div class="box">
        <h1 class="form-title">Order</h1>
    </div>

    <div class="box">
        <div class="form-row">
            <div class="form-field">
                <button class="input select-button" type="button" onclick="showSelectMenu(event)">
                    <label id="select-value">Select Bread</label>
                    <i class="bx bxs-chevron-down"></i>
                </button>

                <ul class="select-menu">
                    <?php
                        foreach ($breads as $bread) {
                            echo "<li class='option'>$bread->name</li>";
                    }
                    ?>
                </ul>
            </div>
        </div>

        <div class="form-row">
            <div class="form-field">
                <button class="input select-button" type="button" onclick="showSelectMenu(event)">
                    <label id="select-value">Select Length</label>
                    <i class="bx bxs-chevron-down"></i>
                </button>

                <ul class="select-menu">
                    <?php
                    foreach ($lengths as $length) {
                        echo "<li class='option'>$length->cm cm</li>";
                    }
                    ?>
                </ul>
            </div>
        </div>

        <div class="form-row">
            <div class="form-field">
                <p>Topping</p>

                <ul class="select-menu show">
                    <?php
                    foreach ($toppingsByCat as $toppingsAndCat => $toppings) {
                        echo "<li class='option'>$toppingsAndCat</li>";
                        foreach ($toppings as $topping){
                            echo "<li class='option'>$topping->name</li>";
                        }

                    }
                    ?>
                </ul>
            </div>
        </div>

        <div class="form-row">
        </div>
    </div>

    <div class="form-submit">
        <button class="submit" type="button" disabled>Buy</button>
    </div>
</form>