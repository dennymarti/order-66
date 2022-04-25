<form class="form" method="post" action="/order/update?id=<?=$order->id?>">
    <div class="box">
        <h1 class="form-title"><?= $heading; ?></h1>
    </div>

    <div class="box">
        <div class="form-row">
            <select name="bread">
                <?php
                foreach ($breads as $bread) {
                    if ($order->breadId == $bread->id) {
                        echo "<option value='$bread->id' selected>$bread->name</option>";
                    } else {
                        echo "<option value='$bread->id'>$bread->name</option>";
                    }
                }
                ?>
            </select>
        </div>


        <div class="form-row">
            <select name="length">
                <option value="none" selected disabled hidden>Select an Option</option>
                <?php
                foreach ($lengths as $length) {
                    if ($order->lengthId == $length->id) {
                        echo "<option value='$length->id' selected>$length->cm cm</option>";
                    } else {
                        echo "<option value='$length->id'>$length->cm cm</option>";
                    }
                }
                ?>
            </select>
        </div>

        <div class="form-row">
            <fieldset>
                <legend>Topping</legend>
                <?php
                foreach ($toppings as $topping) {
                    $isInSandwich = false;
                    foreach ($toppingList as $chosedTopping) {
                        if($chosedTopping->id == $topping->id) {
                            $isInSandwich = true;
                            break;
                        }
                    }

                    if ($isInSandwich) {
                        echo "<input checked name='$topping->id' type=checkbox class='option' onclick='selectCheckbox(event)'>$topping->name</input>";
                    } else {
                        echo "<input name='$topping->id' type=checkbox class='option' onclick='selectCheckbox(event)'>$topping->name</input>";
                    }
                }
                ?>
            </fieldset>
        </div>
    </div>

    <div class="form-submit">
        <button class="submit" type="submit">Update</button>
    </div>
</form>