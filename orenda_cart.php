<?php
session_start();
$connect = mysqli_connect("localhost", "root", "", "orenda_cart");

if(isset($_POST["add_to_cart"]))
{
    if(isset($_SESSION["shopping_cart"]))
    {
        $item_array_id = array_column($_SESSION["shopping_cart"], "item_id");
        if(!in_array($_GET["id"], $item_array_id))
        {
            $count = count($_SESSION["shopping_cart"]);
            $item_array = array(
                'item_id' => $_GET["id"],
                'item_name' => $_POST["hidden_name"],
                'item_price' => $_POST["hidden_price"],
                'item_quantity' => $_POST["quantity"]
            );
            $_SESSION["shopping_cart"][$count] = $item_array;
        }
        else
        {
            echo '<script>alert("Вече добавено")</script>';
            echo '<script>window.location="orenda_cart.php"</script>';
        }
    }
    else
    {
        $item_array = array(
            'item_id' => $_GET["id"],
            'item_name' => $_POST["hidden_name"],
            'item_price' => $_POST["hidden_price"],
            'item_quantity' => $_POST["quantity"]
        );
        $_SESSION["shopping_cart"][0] = $item_array;
    }
}
if(isset($_GET["action"]))
{
    if($_GET["action"] == "delete")
    {
        foreach($_SESSION["shopping_cart"] as $keys => $values)
        {
            if($values["item_id"] == $_GET["id"])
            {
                unset($_SESSION["shopping_cart"][$keys]);
                echo '<script>alert("Продуктът е премахнат.")</script>';
                echo '<script>window.location="orenda_cart.php"</script>';
            }
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Потребителска кошница</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <meta charset = "UTF-8">
</head>
<body>
<br />
<div class="container" style="width:700px;" >
    <a href="index.php">Начало</a>
    <h3 align="center">Оренда Потребителска кошница</h3><br />
    <div id="items-data">
    <?php
    $query = "SELECT * FROM orenda_cart.products ORDER BY id ASC";
    $result = mysqli_query($connect, $query);
    if(mysqli_num_rows($result) > 0)
    {
        while($row = mysqli_fetch_array($result))
        {
            ?>
            <div class="col-md-4">
                <form method="post" action="orenda_cart.php?action=add&id=<?php echo $row["id"]; ?>">
                    <div style="border:1px solid #333;background-color:#f1f1f1; border-radius:5px; padding:16px;" align="center" class="item">
                        <img src="<?php echo $row["image"]; ?>" class="img-responsive" /><br />
                        <h4 class="text-info"><?php echo $row["name"]; ?></h4>
                        <h4 class="text-danger"> <?php echo $row["price"]; ?> лв/кг</h4>
                        <input type="text" name = "quantity"  value = "1" size = "1"/>
                        <input type="hidden" name = "hidden_name" class="hidden_name" value = "<?php echo $row["name"]; ?>" />
                        <input type="hidden" name = "hidden_price" value = "<?php echo $row["price"]; ?>" />
                        <input type="submit" name = "add_to_cart" style = "margin-top:30px;" class="btn btn-success" value="Добави в кошницата" />
                    </div>
                </form>
            </div>
            <?php
        }
    }
    ?>
    </div>
    <div style="clear:both"></div>
    <br />
    <h3>Детайли на поръчката:</h3>
    <div class="table-responsive">
        <table class="table table-bordered">
            <tr>
                <th width="40%">Продукт</th>
                <th width="10%">Количество</th>
                <th width="20%">Цена</th>
                <th width="15%">Общо</th>
                <th width="5%">Премахни</th>
            </tr>
            <?php
            if(!empty($_SESSION["shopping_cart"]))
            {
                $total = 0;
                foreach($_SESSION["shopping_cart"] as $keys => $values)
                {
                    ?>
                    <tr>
                        <td><?php echo $values["item_name"]; ?></td>
                        <td><?php echo $values["item_quantity"]; ?></td>
                        <td><?php echo $values["item_price"]; ?>лв</td>
                        <td><?php echo number_format($values["item_quantity"] * $values["item_price"], 2); ?>лв</td>
                        <td><a href="orenda_cart.php?action=delete&id=<?php echo $values["item_id"]; ?>"><span class="text-danger">Премахни</span></a></td>
                    </tr>
                    <?php
                    $total = $total + ($values["item_quantity"] * $values["item_price"]);
                }
                ?>
                <tr>
                    <td colspan="3" align="right">Total</td>
                    <td align="right"> <?php echo number_format($total, 2); ?>лв</td>
                    <td></td>
                </tr>
                <?php
            }
            ?>
        </table>
    </div>
</div>
<br />
</body>
</html>