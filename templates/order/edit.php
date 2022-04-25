<form class="form" method="post" action="/order/update?id=<?=$order->id?>">
    <div class="box">
        <h1 class="form-title"><?= $heading; ?></h1>
    </div>

    <div class="box">
        <div class="form-row">
            <select class="input" name="bread">
                <?php
                foreach ($breads as $bread) {
                    if ($order->breadId == $bread->id) {
                        echo "<option class='option' value='$bread->id' selected>$bread->name</option>";
                    } else {
                        echo "<option class='option' value='$bread->id'>$bread->name</option>";
                    }
                }
                ?>
            </select>
        </div>


        <div class="form-row">
            <select class="input" name="length">
                <?php
                foreach ($lengths as $length) {
                    if ($order->lengthId == $length->id) {
                        echo "<option class='option' value='$length->id' selected>$length->cm cm</option>";
                    } else {
                        echo "<option class='option' value='$length->id'>$length->cm cm</option>";
                    }
                }
                ?>
            </select>
        </div>

        <div class="form-row">
            <fieldset class="input">
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
                        echo "<label class='option'><input class='checkbox' name='$topping->id' type='checkbox' checked>$topping->name</input><i class='bx bx-check show'></i></label>";
                    } else {
                        echo "<label class='option'><input class='checkbox' name='$topping->id' type=checkbox>$topping->name</input><i class='bx bx-check'></i></label>";
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