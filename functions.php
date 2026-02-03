<?php
/**
 * ============================================================
 * Name:        [Ethan Marxen]
 * Date:        February 2, 2026
 * Description: Part 2b – String Manipulation & Math Functions
 *              This page demonstrates proficiency with PHP's
 *              built-in string and math functions through live,
 *              interactive examples.  Each function is explained
 *              with comments and its output is shown on the page.
 *
 *  String Functions Used:
 *        • strtoupper()   – converts a string to uppercase
 *        • strtolower()   – converts a string to lowercase
 *        • str_word_count() – counts the number of words
 *        • str_replace()  – replaces occurrences of a substring
 *        • strlen()       – returns the character length
 *        • strrev()       – reverses a string
 *        • ucfirst()      – capitalises the first character
 *        • substr()       – extracts a portion of a string
 *
 *  Math Functions Used:
 *        • round()        – rounds a number
 *        • pow()          – raises a number to a power
 *        • sqrt()         – calculates the square root
 *        • abs()          – returns the absolute value
 *        • max() / min()  – largest / smallest in a list
 *        • pi()           – returns the value of pi
 *        • ceil() / floor() – rounds up / rounds down
 *
 * Course:      [Web Development with PHP and SQL]
 * ============================================================
 */

// ============================================================
// SAMPLE DATA FOR STRING DEMONSTRATIONS
// These variables are defined once and reused across multiple
// function calls below.  Using variables keeps the code DRY
// (Don't Repeat Yourself).
// ============================================================
$sampleSentence = "The quick brown fox jumps over the lazy dog";
$sampleWord     = "Programming";

// ============================================================
// STRING FUNCTION RESULTS
// Each result is stored in a variable so it can be inserted
// cleanly into the HTML later using short echo tags (<?= ?>).
// ============================================================

// strtoupper() – every character becomes uppercase
$upper = strtoupper($sampleSentence);

// strtolower() – every character becomes lowercase
$lower = strtolower($sampleSentence);

// str_word_count() – returns how many words are in a string
$wordCount = str_word_count($sampleSentence);

// str_replace() – swaps "lazy" with "energetic" in the sentence
$replaced = str_replace("lazy", "energetic", $sampleSentence);

// strlen() – number of characters (including spaces)
$charLength = strlen($sampleSentence);

// strrev() – reverses the characters in the sample word
$reversed = strrev($sampleWord);

// ucfirst() – capitalises only the first letter of a string
$ucFirst = ucfirst("hello world from php");

// substr() – pulls characters 4 through 8 (5 characters) from
//            the sample word.  The second argument is the start
//            index (0-based) and the third is the length.
$subStr = substr($sampleWord, 0, 7);   // "Program"

// ============================================================
// SAMPLE DATA FOR MATH DEMONSTRATIONS
// ============================================================
$numberA = 17.6834;
$numberB = -42;
$base    = 3;
$exp     = 4;        // 3 raised to the 4th power
$sqrtVal = 144;
$numbers = [8, 23, 4, 16, 42, 11];   // array used for max/min

// ============================================================
// MATH FUNCTION RESULTS
// ============================================================

// round() – rounds to 2 decimal places
$rounded = round($numberA, 2);

// pow() – base raised to the power of exp  (3^4 = 81)
$power = pow($base, $exp);

// sqrt() – square root of 144 = 12
$squareRoot = sqrt($sqrtVal);

// abs() – turns -42 into 42 (absolute value)
$absolute = abs($numberB);

// max() – largest value in the $numbers array
$maximum = max($numbers);

// min() – smallest value in the $numbers array
$minimum = min($numbers);

// pi() – returns 3.14159265358979…
$piValue = round(pi(), 6);

// ceil() – rounds 4.1 up to 5
$ceiling = ceil(4.1);

// floor() – rounds 4.9 down to 4
$floor = floor(4.9);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>String &amp; Math Functions – PHP Demo</title>
    <style>
        /* ============================================================
           Global theme — consistent with the rest of the assignment.
           ============================================================ */
        *, *::before, *::after { margin:0; padding:0; box-sizing:border-box; }
        :root {
            --bg-dark:      #0f1117;
            --bg-card:      #1a1d27;
            --bg-card-alt:  #222636;
            --accent:       #6c63ff;
            --accent-light: #8b83ff;
            --text-primary: #eef0f4;
            --text-muted:   #9aa0b0;
            --border:       #2e3245;
            --green:        #4ade80;
            --orange:       #fb923c;
            --pink:         #f472b6;
        }
        body {
            font-family: 'Segoe UI', system-ui, sans-serif;
            background: var(--bg-dark); color: var(--text-primary);
            line-height: 1.7; min-height: 100vh;
            padding: 40px 20px 60px;
        }
        .container { max-width: 860px; margin: 0 auto; }

        /* Hero */
        .hero { text-align:center; margin-bottom:40px; }
        .hero .badge {
            display:inline-block; background:var(--accent); color:#fff;
            font-size:.72rem; font-weight:700; letter-spacing:1.8px;
            text-transform:uppercase; padding:5px 14px; border-radius:20px; margin-bottom:14px;
        }
        .hero h1 { font-size:2rem; margin-bottom:8px; }
        .hero h1 span { color:var(--accent-light); }
        .hero p { color:var(--text-muted); font-size:.97rem; max-width:580px; margin:0 auto; }

        /* Section header */
        .section-header {
            display:flex; align-items:center; gap:12px; margin: 38px 0 18px;
        }
        .section-header .icon { font-size:1.6rem; }
        .section-header h2 { font-size:1.3rem; color:var(--text-primary); }
        .section-header .line { flex:1; height:1px; background:var(--border); }

        /* Function card grid */
        .fn-grid {
            display:grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
        }
        @media (max-width:620px) { .fn-grid { grid-template-columns:1fr; } }

        /* Individual function card */
        .fn-card {
            background:var(--bg-card); border:1px solid var(--border);
            border-radius:12px; padding:20px 18px;
            transition: border-color 0.2s;
        }
        .fn-card:hover { border-color:var(--accent); }

        .fn-card .fn-name {
            font-size:.78rem; font-weight:700; letter-spacing:1px;
            text-transform:uppercase; margin-bottom:8px; display:flex;
            align-items:center; gap:8px;
        }
        /* Color dots for string vs math */
        .dot-str { width:10px; height:10px; border-radius:50%; background:var(--green); display:inline-block; }
        .dot-math { width:10px; height:10px; border-radius:50%; background:var(--orange); display:inline-block; }

        .fn-card .fn-name span { color:var(--text-muted); font-weight:400; text-transform:none; letter-spacing:0; font-size:.85rem; }

        .fn-card .fn-code {
            background:var(--bg-card-alt); border-radius:6px;
            padding:8px 12px; font-family:'Courier New', monospace;
            font-size:.82rem; color:var(--accent-light); margin-bottom:8px;
            word-break:break-all;
        }

        .fn-card .fn-result {
            font-size:.92rem; color:var(--text-primary); font-weight:600;
            border-top:1px solid var(--border); padding-top:8px; margin-top:4px;
        }
        .fn-card .fn-result .label { color:var(--text-muted); font-weight:400; font-size:.82rem; display:block; margin-bottom:2px; }

        /* Legend */
        .legend {
            display:flex; gap:20px; margin-bottom:24px; font-size:.82rem; color:var(--text-muted);
        }
        .legend .legend-item { display:flex; align-items:center; gap:6px; }

        /* Back link & footer */
        .back-link { display:inline-block; margin-top:32px; color:var(--accent-light); text-decoration:none; font-size:.9rem; }
        .back-link:hover { text-decoration:underline; }
        .footer { text-align:center; margin-top:50px; color:var(--text-muted); font-size:.82rem; }
    </style>
</head>
<body>
<div class="container">

    <!-- Hero -->
    <header class="hero">
        <div class="badge">Part 2b – Functions Demo</div>
        <h1>⚙️ String &amp; <span>Math Functions</span></h1>
        <p>Live examples of PHP's built-in string manipulation and math functions, with explanations and output.</p>
    </header>

    <!-- Legend -->
    <div class="legend">
        <div class="legend-item"><span class="dot-str"></span> String Function</div>
        <div class="legend-item"><span class="dot-math"></span> Math Function</div>
    </div>

    <!-- ============================================================
         STRING FUNCTIONS SECTION
         Each card shows: the function name, the actual PHP code
         that was called, and the resulting output.
         ============================================================ -->
    <div class="section-header">
        <span class="icon">🔤</span>
        <h2>String Functions</h2>
        <div class="line"></div>
    </div>

    <div class="fn-grid">

        <!-- strtoupper -->
        <div class="fn-card">
            <div class="fn-name"><span class="dot-str"></span> strtoupper() <span>– to uppercase</span></div>
            <div class="fn-code">strtoupper("<?= $sampleSentence ?>")</div>
            <div class="fn-result">
                <span class="label">Result</span>
                <?= $upper ?>
            </div>
        </div>

        <!-- strtolower -->
        <div class="fn-card">
            <div class="fn-name"><span class="dot-str"></span> strtolower() <span>– to lowercase</span></div>
            <div class="fn-code">strtolower("<?= $sampleSentence ?>")</div>
            <div class="fn-result">
                <span class="label">Result</span>
                <?= $lower ?>
            </div>
        </div>

        <!-- str_word_count -->
        <div class="fn-card">
            <div class="fn-name"><span class="dot-str"></span> str_word_count() <span>– count words</span></div>
            <div class="fn-code">str_word_count("<?= $sampleSentence ?>")</div>
            <div class="fn-result">
                <span class="label">Word Count</span>
                <?= $wordCount ?> words
            </div>
        </div>

        <!-- str_replace -->
        <div class="fn-card">
            <div class="fn-name"><span class="dot-str"></span> str_replace() <span>– find &amp; replace</span></div>
            <div class="fn-code">str_replace("lazy", "energetic", $sentence)</div>
            <div class="fn-result">
                <span class="label">Result</span>
                <?= $replaced ?>
            </div>
        </div>

        <!-- strlen -->
        <div class="fn-card">
            <div class="fn-name"><span class="dot-str"></span> strlen() <span>– character count</span></div>
            <div class="fn-code">strlen("<?= $sampleSentence ?>")</div>
            <div class="fn-result">
                <span class="label">Character Length</span>
                <?= $charLength ?> characters
            </div>
        </div>

        <!-- strrev -->
        <div class="fn-card">
            <div class="fn-name"><span class="dot-str"></span> strrev() <span>– reverse string</span></div>
            <div class="fn-code">strrev("<?= $sampleWord ?>")</div>
            <div class="fn-result">
                <span class="label">Reversed</span>
                <?= $reversed ?>
            </div>
        </div>

        <!-- ucfirst -->
        <div class="fn-card">
            <div class="fn-name"><span class="dot-str"></span> ucfirst() <span>– capitalise first</span></div>
            <div class="fn-code">ucfirst("hello world from php")</div>
            <div class="fn-result">
                <span class="label">Result</span>
                <?= $ucFirst ?>
            </div>
        </div>

        <!-- substr -->
        <div class="fn-card">
            <div class="fn-name"><span class="dot-str"></span> substr() <span>– extract substring</span></div>
            <div class="fn-code">substr("<?= $sampleWord ?>", 0, 7)</div>
            <div class="fn-result">
                <span class="label">First 7 Characters</span>
                <?= $subStr ?>
            </div>
        </div>

    </div><!-- end fn-grid (strings) -->

    <!-- ============================================================
         MATH FUNCTIONS SECTION
         ============================================================ -->
    <div class="section-header">
        <span class="icon">🔢</span>
        <h2>Math Functions</h2>
        <div class="line"></div>
    </div>

    <div class="fn-grid">

        <!-- round -->
        <div class="fn-card">
            <div class="fn-name"><span class="dot-math"></span> round() <span>– round number</span></div>
            <div class="fn-code">round(<?= $numberA ?>, 2)</div>
            <div class="fn-result">
                <span class="label">Rounded to 2 Decimals</span>
                <?= $rounded ?>
            </div>
        </div>

        <!-- pow -->
        <div class="fn-card">
            <div class="fn-name"><span class="dot-math"></span> pow() <span>– exponentiation</span></div>
            <div class="fn-code">pow(<?= $base ?>, <?= $exp ?>) &nbsp;→ 3⁴</div>
            <div class="fn-result">
                <span class="label">3 to the Power of 4</span>
                <?= $power ?>
            </div>
        </div>

        <!-- sqrt -->
        <div class="fn-card">
            <div class="fn-name"><span class="dot-math"></span> sqrt() <span>– square root</span></div>
            <div class="fn-code">sqrt(<?= $sqrtVal ?>)</div>
            <div class="fn-result">
                <span class="label">Square Root of 144</span>
                <?= $squareRoot ?>
            </div>
        </div>

        <!-- abs -->
        <div class="fn-card">
            <div class="fn-name"><span class="dot-math"></span> abs() <span>– absolute value</span></div>
            <div class="fn-code">abs(<?= $numberB ?>)</div>
            <div class="fn-result">
                <span class="label">Absolute Value of –42</span>
                <?= $absolute ?>
            </div>
        </div>

        <!-- max -->
        <div class="fn-card">
            <div class="fn-name"><span class="dot-math"></span> max() <span>– largest value</span></div>
            <div class="fn-code">max([<?= implode(', ', $numbers) ?>])</div>
            <div class="fn-result">
                <span class="label">Maximum</span>
                <?= $maximum ?>
            </div>
        </div>

        <!-- min -->
        <div class="fn-card">
            <div class="fn-name"><span class="dot-math"></span> min() <span>– smallest value</span></div>
            <div class="fn-code">min([<?= implode(', ', $numbers) ?>])</div>
            <div class="fn-result">
                <span class="label">Minimum</span>
                <?= $minimum ?>
            </div>
        </div>

        <!-- pi -->
        <div class="fn-card">
            <div class="fn-name"><span class="dot-math"></span> pi() <span>– value of π</span></div>
            <div class="fn-code">round(pi(), 6)</div>
            <div class="fn-result">
                <span class="label">Pi (6 Decimals)</span>
                <?= $piValue ?>
            </div>
        </div>

        <!-- ceil & floor -->
        <div class="fn-card">
            <div class="fn-name"><span class="dot-math"></span> ceil() &amp; floor() <span>– round up / down</span></div>
            <div class="fn-code">ceil(4.1) = <?= $ceiling ?> &nbsp;|&nbsp; floor(4.9) = <?= $floor ?></div>
            <div class="fn-result">
                <span class="label">Ceiling of 4.1 / Floor of 4.9</span>
                <?= $ceiling ?> &nbsp;/&nbsp; <?= $floor ?>
            </div>
        </div>

    </div><!-- end fn-grid (math) -->

    <!-- Navigation back -->
    <a href="index.php" class="back-link">← Back to Main Page</a>

    <div class="footer">
        <p>[Your Name] &bull; PHP Assignment &bull; February 2026</p>
    </div>
</div>
</body>
</html>
