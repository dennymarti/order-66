<form class="form" method="post" action="/order/create">
    <div class="box">
        <h1 class="form-title">Order</h1>
    </div>

    <div class="box">
        <div class="form-row">
            <div class="form-field">
<!--                <button class="input select-button" name="bread" type="button" onclick="showSelectMenu(event)">-->
<!--                    <label class="select-value">Select Bread</label>-->
<!--                    <i class="bx bxs-chevron-down"></i>-->
<!--                </button>-->
<!---->
<!--                <ul class="select-menu">-->
<!--                    --><?php
//                        foreach ($breads as $bread) {
//                            echo "<li class='option' id='$bread->id' onclick='selectOption(event)'><label>$bread->name</label><i class='bx bx-check hide'></i></li>";
//                    }
//                    ?>
<!--                </ul>-->

                <select name="bread">
                    <option value="none" selected disabled hidden>Select an Option</option>
                    <?php
                        foreach ($breads as $bread) {
                            echo "<option value='$bread->id'>$bread->name</option>";
                        }
                    ?>
                </select>
            </div>
        </div>

        <div class="form-row">
            <div class="form-field">
<!--                <button class="input select-button" name="length" type="button" onclick="showSelectMenu(event)">-->
<!--                    <label class="select-value">Select Length</label>-->
<!--                    <i class="bx bxs-chevron-down"></i>-->
<!--                </button>-->
<!---->
<!--                <ul class="select-menu">-->
<!--                    --><?php
//                    foreach ($lengths as $length) {
//                        echo "<li class='option' id='$length->id' onclick='selectOption(event)'><label>$length->cm cm</label><i class='bx bx-check hide'></i></li>";
//                    }
//                    ?>
<!--                </ul>-->
                <select name="length">
                    <option value="none" selected disabled hidden>Select an Option</option>
                    <?php
                    foreach ($lengths as $length) {
                        echo "<option value='$length->id'>$length->cm cm</option>";
                    }
                    ?>
                </select>
            </div>
        </div>

        <div class="form-row">
            <div class="form-field">
                <fieldset>
                    <legend>Topping</legend>
                    <?php

                    foreach ($toppingsByCat as $toppingsAndCat => $toppings) {
                        echo "<li class='option'>$toppingsAndCat</li>";
                        foreach ($toppings as $topping){
                            echo "<li class='option'>$topping->name</li>";
                        }

                    }
                    ?>
                </fieldset>
            </div>
        </div>

        <div class="form-row">
        </div>
    </div>

    <div class="form-submit">
        <button class="submit" type="submit">Buy</button>
    </div>
</form>