<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <main>
        <?php

        function test_symbols($text)
        {
            $symbols = array();
            $lower_text = strtolower($text);
            for ($i = 0; $i < strlen($lower_text); $i++) {
                if (isset($symbols[$lower_text[$i]])) {
                    $symbols[$lower_text[$i]]++;
                } else {
                    $symbols[$lower_text[$i]] = 1;
                }
            }
            return $symbols;
        }

        function test_it($text)
        {
            echo 'Количество символов: ' . strlen($text) . '<br>';
            $digits = array(
                '0' => true,
                '1' => true,
                '2' => true,
                '3' => true,
                '4' => true,
                '5' => true,
                '6' => true,
                '7' => true,
                '8' => true,
                '9' => true
            );
            $digits_amount = 0;
            $words_amount = 0;
            $current_word = '';
            $words = array();
            for ($i = 0; $i < strlen($text); $i++) {
                if (array_key_exists($text[$i], $digits)) {
                    $digits_amount++;
                }

                if ($text[$i] == ' ' || $i == strlen($text) - 1) {
                    if ($current_word) {
                        if (isset($words[$current_word])) {
                            $words[$current_word]++;
                        } else {
                            $words[$current_word] = 1;
                        }
                    }
                    $current_word = '';
                } else {
                    $current_word .= $text[$i];
                }
            }
            echo 'Количество цифр: ' . $digits_amount . '<br>';
            echo 'Количество слов: ' . count($words) . '<br>';
        }

        if (isset($_POST["data"]) && $_POST["data"]) {
            echo '<div class="src_text">' . $_POST["data"] . "</div>";
            test_it($_POST["data"]);
        } else {
            echo '<div class="src_error">Нет текста для анализа</div>';
        }
        ?>
    </main>
</body>

</html>