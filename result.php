<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>

<body>
    <main>
        <?php

        function test_symbols($text)
        {
            $symbols = array();
            $lower_text = mb_strtolower($text, 'utf-8');
            for ($i = 0; $i < mb_strlen($lower_text, 'utf-8'); $i++) {
                $char = mb_substr($lower_text, $i, 1, 'utf-8');
                if (isset($symbols[$char])) {
                    $symbols[$char]++;
                } else {
                    $symbols[$char] = 1;
                }
            }
            ksort($symbols);
            return $symbols;
        }

        function test_it($text)
        {
            $eng_alph = 'abcdefghijklmnopqrstuvwxyz';
            $rus_alph = 'абвгдеёжзийклмнопрстуфхцчшщъыьэюя';
            $punct_marks = ".,?!-_:;'[]()“”«»";
            $digits = "0123456789";
            $digits_amount = 0;
            $letters_amount = 0;
            $punct_marks_amount = 0;
            $upper_letters = 0;
            $lower_letters = 0;
            $current_word = '';
            $words = array();
            for ($i = 0; $i < mb_strlen($text, 'utf-8'); $i++) {
                $char = mb_substr($text, $i, 1, 'utf-8');
                if (str_contains($digits, $char)) {
                    $digits_amount++;
                }

                if (str_contains($rus_alph . $eng_alph, $char)) {
                    $letters_amount++;
                    $lower_letters++;
                }

                if (str_contains(mb_strtoupper($rus_alph, 'utf-8') . mb_strtoupper($eng_alph, 'utf-8'), $char)) {
                    $letters_amount++;
                    $upper_letters++;
                }

                if (str_contains($punct_marks, $char)) {
                    $punct_marks_amount++;
                }

                if ($char == ' ' || str_contains($punct_marks, $char) || $i == mb_strlen($text, 'utf-8') - 1) {
                    if ($current_word) {
                        if (isset($words[$current_word])) {
                            $words[$current_word]++;
                        } else {
                            $words[$current_word] = 1;
                        }
                    }
                    $current_word = '';
                } else {
                    $current_word .= $char;
                }
            }
            echo '1. количество символов в тексте (включая пробелы): ' . mb_strlen($text, 'utf-8') . '<br>';
            echo '2. количество букв: ' . $letters_amount . '<br>';
            echo "3. количество строчных и заглавных букв по отдельности<br>";
            echo '- строчных: ' . $lower_letters . '<br>';
            echo '- заглавных: ' . $upper_letters . '<br>';
            echo '4. количество знаков препинания: ' . $punct_marks_amount . '<br>';
            echo '5. количество цифр: ' . $digits_amount . '<br>';
            echo '6. количество слов: ' . count($words) . '<br>';
            echo '7. количество вхождений каждого символа текста:<br>';
            $symbols = test_symbols($text);
            foreach ($symbols as $key => $value) {
                echo "Символ '" . $key . "': " . $value . " шт.<br>";
            }
            echo '8. Список всех слов в тексте и количество их вхождений, отсортированный по алфавиту:<br>';
            ksort($words);
            foreach ($words as $word => $count) {
                echo "   Слово '" . htmlspecialchars($word) . "': " . $count . " шт.<br>";
            }
        }

        $text = $_POST["data"];
        if (isset($_POST["data"]) && strlen(trim($_POST['data']))) {
            echo '<div class="src_text">' . $text . "</div>";
            test_it($_POST["data"]);
        } else {
            echo '<div class="src_error">Нет текста для анализа</div>';
        }
        ?>
        <a href="/index.html">Другой анализ</a>
    </main>
</body>

</html>