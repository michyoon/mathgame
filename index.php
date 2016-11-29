<?php
    session_start();
    if (!isset($_SESSION["authenticated"])) {
        header("Location: login.php");
    }

    include("include/header.php");
    if (!isset($total)) {
        $total = 0;
    }
    if (!isset($score)) {
        $score = 0;
    }
    extract($_POST);
    if ( isset($firstnum)
        && isset($op)
        && isset($secondnum)
        && isset($answer)
    ) {
        $ans = "";
        if ( !is_numeric($answer) ) {
            $ans = "<span style='color: red; font-weight: bold;'>Please enter a valid number.</span>";
        } else
        switch ($op) {
            case "+":
                $result = $firstnum + $secondnum;
                if ($result == $answer) {
                    $ans = "<span style='color: green; font-weight: bold;'>This is correct!</span>";
                    $score++;
                } else {
                    $ans = "<span style='color: red; font-weight: bold;'>This is incorrect! $firstnum + $secondnum is $result.</span>";
                }
                $total++;
                break;
            case "-":
                $result = $firstnum - $secondnum;
                if ($result == $answer) {
                    $ans = "<span style='color: green; font-weight: bold;'>This is correct!</span>";
                    $score++;
                } else {
                    $ans = "<span style='color: red; font-weight: bold;'>This is incorrect! $firstnum - $secondnum is $result.</span>";
                }
                $total++;
                break;
        }
    }
    $num1 = rand(0,20);
    $num2 = rand(0,20);
    $op_int = rand(1,2);
    $op_str = "";

    switch ($op_int) {
        case 1:
            $op_str = "+";
            break;
        case 2:
            $op_str = "-";
            break;
    }

?>
<form action="index.php" method="post" role="form" class="form-horizontal">
    <div class="row">
        <div class="col-sm-4 col-sm-offset-4"><h1>Math Game</h1></div>
        <div class="col-sm-4"><a href="logout.php" class="btn btn-default btn-sm">Logout</a></div>
    </div>
    <div class="row">
        <label class="col-sm-2 col-sm-offset-3"><?php echo $num1; ?></label>
        <label class="col-sm-2"><?php echo $op_str; ?></label>
        <label class="col-sm-2"><?php echo $num2; ?></label>
        <div class="col-sm-3"></div>
    </div>

    <input type="hidden" name="firstnum" value="<?php echo $num1; ?>" />
    <input type="hidden" name="op" value="<?php echo $op_str; ?>" />
    <input type="hidden" name="secondnum" value="<?php echo $num2; ?>" />
    <input type="hidden" name="total" value="<?php echo $total; ?>" />
    <input type="hidden" name="score" value="<?php echo $score; ?>" />

    <div class="form-group">
        <div class="col-sm-3 col-sm-offset-4">
            <input type="text" class="form-control" id="answer" name="answer" placeholder="Enter answer" size="6">
        </div>
        <div class="col-sm-5"></div>
    </div>
    <div class="row">
        <div class="col-sm-3 col-sm-offset-4">
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <button type="submit" class="btn btn-primary btn-sm">
            Submit</button>
        </div>
        <div class="col-sm-3"></div>
    </div>
</form>
<hr />
<div class="row">
    <div class="col-sm-4 col-sm-offset-4">
        <?php echo $ans; ?>
    </div>
    <div class="col-sm-4"></div>
</div>
<div class="row">
    <div class="col-sm-4 col-sm-offset-4">Score: <?php echo "$score / $total" ?></div>
    <div class="col-sm-4"></div>
</div>
<?php include("include/footer.php"); ?>
