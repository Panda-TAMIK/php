<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="css/style.css">
    <title>lab4</title>
</head>

<body>


    <header class="header">
        <img src='http://localhost//phpsecondsem/lab_calc/icon.png'>
        <h1>calculator</h1>

    </header>
    <section class="bg">
        <div class="calculator">

            <label class="label">
                <input class="screen input" type="" name="equation" value="">
            </label>
            <div class="screen result">Результат:
                </label>
                <?php
                function isNum($x)
                        {
                            if ((!$x) or (!is_numeric($x))) {
                                return false;
                            }
                            return true;
                        }
                        function calculate($val)
                        {
                            if (!$val) {
                                return 'Выражение не задано!';
                            }
                            if (isNum($val)) {
                                return $val;
                            }

                            $args = explode('+', $val);
                            if (count($args) > 1) {
                                $sum = 0;

                                for ($i = 0; $i < count($args); $i++) {
                                    $arg = $args[$i];

                                    if (!isNum($arg)) {
                                        $arg = calculate($arg);
                                    }

                                    $sum += $arg;
                                }
                                return $sum;
                            }

                            $args = explode("-", $val);
                            if (count($args) > 1) {
                                if (!is_numeric($args[0])) {
                                    $args[0] = calculate($args[0]);
                                }

                                $minusRez = $args[0];

                                for ($i = 1; $i < count($args); $i++) {
                                    if (!is_numeric($args[$i])) {
                                        $args[$i] = calculate($args[$i]);
                                    }
                                    $minusRez -= $args[$i];
                                }
                                return $minusRez;
                            }

                            $args = explode('*', $val);
                            if (count($args) > 1) {
                                $sup = 1;

                                for ($i = 0; $i < count($args); $i++) {
                                    $arg = $args[$i];
                                    if (!isNum($arg)) {
                                        $arg = calculate($args[$i]);
                                    }
                                    $sup *= $arg;
                                }
                                return $sup;
                            }

                            $args = explode("÷", $val);
                            if (count($args) > 1) {
                                if (!is_numeric($args[0])) {
                                    $args[0] = calculate($args[0]);
                                }
                                $del = $args[0];
                                for ($i = 1; $i < count($args); $i++) {
                                    if (!is_numeric($args[$i])) {
                                        $args[$i] = calculate($args[$i]);
                                    }
                                    if ($args[$i] == 0) {
                                        return "Делить на 0 нельзя";
                                    } else {
                                        $del /= $args[$i];
                                    }
                                }
                                return $del;
                            }
                            return 'Недопустимые символы в выражении';
                        }

                        function SqValidator($val)
                        {
                            $open = 0;
                            for ($i = 0; $i < strlen($val); $i++) {
                                if ($val[$i] == '(') $open++;
                                else {
                                    if ($val[$i] == ')') {
                                        $open--;
                                        if ($open < 0) return false;
                                    }
                                }
                            }
                            if ($open !== 0) return false;
                            return true;
                        }

                        function calculateSq($val)
                        { //1+(2+3)
                            if (!SqValidator($val)) return 'Неправильная расстановка скобок';
                            $start = strpos($val, '('); //start = 2
                            if ($start === false) return calculate($val);
                            $end = $start + 1; //end = 3
                            $open = 1;
                            while ($open && $end < strlen($val)) {
                                if ($val[$end] == '(') $open++;
                                if ($val[$end] == ')') $open--; //open = 0 end = 6
                                $end++; //3 4 5 
                            }
                            $new_val = substr($val, 0, $start);
                            $new_val .= calculateSq(substr($val, $start + 1, $end - $start - 2));
                            $new_val .= substr($val, $end);

                            return calculateSq($new_val);
                        }
                        if (isset($_POST['equation'])) {
                            $res = calculateSq($_POST['equation']);
                            if ($res === false) {
                                echo 'Некорректное выражение';
                            } else {
                                echo $res;
                            }
                        };
                ?>
            </div>

            <div class="switchs">
                <button class="operator number">C</button>
                <button class="operator number">(</button>
                <button class="operator number">)</button>
                <button class="operator number">%</button>
                <button class="operator number">÷</button>
                <button class="number">7</button>
                <button class="number">8</button>
                <button class="number">9</button>
                <button class="operator number">x</button>
                <button class="number">4</button>
                <button class="number">5</button>
                <button class="number">6</button>
                <button class="operator number">-</button>
                <button class="number">1</button>
                <button class="number">2</button>
                <button class="number">3</button>
                <button class="operator number">+</button>
                <button class="number">0</button>
                <button class="operator number">,</button>
                <button class="result">=</button>
            </div>
        </div>
    </section>
</body>
<script src="calculator.js"></script>

</html>
