<form class="form" method="post" action="/order/create">
    <div class="box">
        <h1 class="form-title">Order</h1>
    </div>

    <div class="box">
        <div class="form-row">
            <select class="input select" name="bread">
                <option value="none" selected disabled hidden>Select bread</option>
                <?php
                foreach ($breads as $bread) {
                    echo "<option class='option' value='$bread->id'>$bread->name</option>";
                }
                ?>
            </select>
        </div>

        <div class="form-row">
            <select class="input" name="length">
                <option value="none" selected disabled hidden>Select length</option>
                <?php
                foreach ($lengths as $length) {
                    echo "<option class='option' value='$length->id'>$length->cm cm</option>";
                }
                ?>
            </select>
        </div>

        <div class="form-row">
            <fieldset class="input">
                <?php

                foreach ($toppingsByCat as $toppingsAndCat => $toppings) {
                    echo "<label class='option categorie'>$toppingsAndCat</label>";
                    foreach ($toppings as $topping){
                        echo "<label class='option' onclick='selectCheckBox(event)'><input class='checkbox' name='$topping->id' type='checkbox'>$topping->name</input><i class='bx bx-check'></i></label>";
                    }
                }
                ?>
            </fieldset>
        </div>

        <div class="form-row">
        </div>
    </div>

    <div class="form-submit">
        <button class="submit" type="submit">Buy</button>
    </div>
</form>