<?php
/**
 * ============================================================
 * Name:        [Ethan Marxen]
 * Date:        February 2, 2026
 * Description: Part 2a – PHP Form Demo
 *              A "Book Club Sign-Up" form that demonstrates:
 *                • Handling GET and POST data with $_POST
 *                • Basic server-side input validation
 *                • Conditional output based on form submission
 *                • Commented thought process throughout
 *              Topic chosen: Book Club registration — a
 *              school-appropriate, original scenario.
 * Course:      [Your Course Name / Section]
 * ============================================================
 */

// ============================================================
// THOUGHT PROCESS – PLANNING THE FORM
// I wanted a form topic that is school-appropriate and
// different from common examples (calculator, login, quiz).
// A "Book Club Sign-Up" lets me collect multiple data types:
//   - Text input  (name, favorite book)
//   - A select dropdown (preferred genre)
//   - Checkboxes  (days available to meet)
//   - A textarea  (short bio / reading goals)
// This variety shows proficiency with different form elements
// and gives me several $_POST values to validate and display.
// ============================================================

// ============================================================
// FORM SUBMISSION HANDLER
// This block runs only after the form has been submitted
// (i.e., when the page receives a POST request).
// I use isset() to check whether $_POST data exists before
// trying to read it, which avoids "undefined index" errors.
// ============================================================
$submitted = false;          // Flag: tracks whether form was submitted
$errors    = [];             // Array to collect any validation messages

// Variables to hold user input so we can re-fill the form
// if validation fails (improves user experience).
$name          = '';
$favoriteBook  = '';
$genre         = '';
$meetingDays   = [];
$bio           = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // --------------------------------------------------------
    // STEP 1 – COLLECT INPUT
    // trim() removes leading/trailing whitespace from text
    // fields so that a user typing only spaces does not pass
    // validation.  htmlspecialchars() converts characters like
    // < > & into their HTML entities to prevent XSS attacks
    // (a basic but important security habit).
    // --------------------------------------------------------
    $name         = htmlspecialchars(trim($_POST['name']        ?? ''));
    $favoriteBook = htmlspecialchars(trim($_POST['favoriteBook'] ?? ''));
    $genre        = htmlspecialchars(trim($_POST['genre']        ?? ''));
    $bio          = htmlspecialchars(trim($_POST['bio']          ?? ''));

    // Checkboxes: if none are checked, $_POST['meetingDays']
    // will not exist at all, so we default to an empty array.
    $meetingDays  = $_POST['meetingDays'] ?? [];

    // --------------------------------------------------------
    // STEP 2 – VALIDATE INPUT
    // Each required field is checked. If it is empty, a
    // human-readable error message is added to $errors.
    // At least one meeting day must be selected as well.
    // --------------------------------------------------------
    if (empty($name)) {
        $errors[] = "Please enter your full name.";
    }
    if (empty($favoriteBook)) {
        $errors[] = "Please enter your favorite book title.";
    }
    if (empty($genre) || $genre === '--') {
        $errors[] = "Please select a preferred genre.";
    }
    if (empty($meetingDays)) {
        $errors[] = "Please select at least one day you can meet.";
    }
    if (empty($bio)) {
        $errors[] = "Please write a short bio or reading goal (min. 10 characters).";
    } elseif (strlen($bio) < 10) {
        // strlen() returns the number of characters in a string.
        // We require at least 10 characters for a meaningful bio.
        $errors[] = "Your bio should be at least 10 characters long.";
    }

    // --------------------------------------------------------
    // STEP 3 – DECIDE OUTCOME
    // If $errors is still empty after all checks, the
    // submission is valid and we set $submitted to true.
    // --------------------------------------------------------
    if (empty($errors)) {
        $submitted = true;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Club Sign-Up – PHP Form Demo</title>
    <style>
        /* ============================================================
           STYLES – same dark theme as index.php for visual consistency.
           ============================================================ */
        *, *::before, *::after {
            margin: 0; padding: 0; box-sizing: border-box;
        }
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
            --red:          #f87171;
        }
        body {
            font-family: 'Segoe UI', system-ui, sans-serif;
            background: var(--bg-dark);
            color: var(--text-primary);
            line-height: 1.7;
            min-height: 100vh;
            padding: 40px 20px 60px;
        }
        .container { max-width: 680px; margin: 0 auto; }

        /* Hero */
        .hero { text-align: center; margin-bottom: 36px; }
        .hero .badge {
            display: inline-block; background: var(--accent); color: #fff;
            font-size: 0.72rem; font-weight: 700; letter-spacing: 1.8px;
            text-transform: uppercase; padding: 5px 14px; border-radius: 20px;
            margin-bottom: 14px;
        }
        .hero h1 { font-size: 2rem; margin-bottom: 8px; }
        .hero h1 span { color: var(--accent-light); }
        .hero p { color: var(--text-muted); font-size: 0.97rem; }

        /* Card wrapper */
        .card {
            background: var(--bg-card); border: 1px solid var(--border);
            border-radius: 14px; padding: 34px 30px; border-top: 4px solid var(--accent);
        }

        /* Form elements */
        .form-group { margin-bottom: 22px; }
        .form-group label {
            display: block; color: var(--text-primary); font-weight: 600;
            font-size: 0.92rem; margin-bottom: 7px;
        }
        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%; padding: 11px 14px; border-radius: 8px;
            border: 1px solid var(--border); background: var(--bg-card-alt);
            color: var(--text-primary); font-size: 0.94rem;
            font-family: inherit; transition: border-color 0.2s;
        }
        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            outline: none; border-color: var(--accent);
        }
        .form-group textarea { resize: vertical; min-height: 100px; }
        .form-group select { appearance: none; cursor: pointer; }

        /* Checkbox group */
        .checkbox-group { display: flex; flex-wrap: wrap; gap: 10px 22px; }
        .checkbox-group label {
            display: flex; align-items: center; gap: 8px;
            font-weight: 400; color: var(--text-muted); cursor: pointer;
        }
        .checkbox-group input[type="checkbox"] { accent-color: var(--accent); width: 16px; height: 16px; }

        /* Hint text under fields */
        .hint { font-size: 0.79rem; color: var(--text-muted); margin-top: 4px; }

        /* Validation error list */
        .errors {
            background: rgba(248, 113, 113, 0.1); border: 1px solid rgba(248,113,113,0.3);
            border-radius: 8px; padding: 14px 18px; margin-bottom: 22px;
        }
        .errors p { color: var(--red); font-weight: 600; margin-bottom: 6px; font-size: 0.88rem; }
        .errors ul { list-style: none; padding: 0; }
        .errors ul li { color: var(--red); font-size: 0.86rem; padding: 2px 0; }
        .errors ul li::before { content: "⚠ "; }

        /* Submit button */
        .btn-submit {
            width: 100%; padding: 13px; background: var(--accent); color: #fff;
            border: none; border-radius: 8px; font-size: 1rem; font-weight: 600;
            cursor: pointer; transition: background 0.2s, transform 0.15s;
            font-family: inherit;
        }
        .btn-submit:hover { background: var(--accent-light); transform: translateY(-2px); }

        /* Success box */
        .success-box {
            background: rgba(74, 222, 128, 0.1); border: 1px solid rgba(74,222,128,0.35);
            border-radius: 10px; padding: 28px 26px; margin-bottom: 28px;
        }
        .success-box h3 { color: var(--green); font-size: 1.2rem; margin-bottom: 14px; }
        .success-box .detail { display: flex; justify-content: space-between; padding: 8px 0; border-bottom: 1px solid rgba(74,222,128,0.15); }
        .success-box .detail:last-child { border-bottom: none; }
        .success-box .detail span:first-child { color: var(--text-muted); font-size: 0.88rem; }
        .success-box .detail span:last-child  { color: var(--text-primary); font-weight: 600; font-size: 0.92rem; text-align: right; max-width: 60%; }

        /* Back link */
        .back-link { display: inline-block; margin-top: 24px; color: var(--accent-light); text-decoration: none; font-size: 0.9rem; }
        .back-link:hover { text-decoration: underline; }

        .footer { text-align: center; margin-top: 50px; color: var(--text-muted); font-size: 0.82rem; }

        @media (max-width: 500px) {
            .card { padding: 22px 18px; }
            .hero h1 { font-size: 1.5rem; }
        }
    </style>
</head>
<body>
<div class="container">

    <header class="hero">
        <div class="badge">Part 2a – PHP Form</div>
        <h1>📚 Book Club <span>Sign-Up</span></h1>
        <p>Fill out the form below to register for the school book club.</p>
    </header>

    <div class="card">

        <?php
        // ============================================================
        // CONDITIONAL OUTPUT – SUCCESS MESSAGE
        // If $submitted is true, we display a summary of what
        // the user entered instead of showing the form again.
        // This proves the PHP code correctly received and
        // processed the POST data.
        // ============================================================
        if ($submitted) {
            // implode() joins the array of meeting days into a
            // single comma-separated string for easy display.
            $daysString = implode(', ', $meetingDays);
        ?>
            <div class="success-box">
                <h3>✅ You have been signed up!</h3>
                <div class="detail">
                    <span>Name</span>
                    <span><?= $name ?></span>
                </div>
                <div class="detail">
                    <span>Favorite Book</span>
                    <span><?= $favoriteBook ?></span>
                </div>
                <div class="detail">
                    <span>Preferred Genre</span>
                    <span><?= $genre ?></span>
                </div>
                <div class="detail">
                    <span>Available Days</span>
                    <span><?= $daysString ?></span>
                </div>
                <div class="detail">
                    <span>About You / Reading Goals</span>
                    <span><?= $bio ?></span>
                </div>
            </div>

            <!-- Link to reset and show the form again -->
            <a href="form.php" class="back-link">← Submit Another Entry</a>

        <?php
        // ============================================================
        // CONDITIONAL OUTPUT – FORM (with possible errors)
        // If $submitted is false the form is displayed.  If
        // $errors is not empty, the error list is shown above
        // the form fields.  Previously entered values are kept
        // so the user does not have to retype everything.
        // ============================================================
        } else {
        ?>

            <!-- Display validation errors if any exist -->
            <?php if (!empty($errors)): ?>
            <div class="errors">
                <p>Please fix the following:</p>
                <ul>
                    <?php foreach ($errors as $err): ?>
                        <li><?= $err ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <?php endif; ?>

            <!--
                THOUGHT PROCESS – FORM STRUCTURE
                • method="POST" is used because we are submitting
                  user data that should NOT appear in the URL.
                • action="form.php" points back to this same file
                  so PHP can process the data at the top of the page.
                • Each input has a 'name' attribute that becomes the
                  key in the $_POST superglobal array.
            -->
            <form method="POST" action="form.php">

                <!-- NAME – simple text input -->
                <div class="form-group">
                    <label for="name">Full Name</label>
                    <input type="text" id="name" name="name" placeholder="Jane Doe" value="<?= $name ?>">
                </div>

                <!-- FAVORITE BOOK – text input -->
                <div class="form-group">
                    <label for="favoriteBook">Favorite Book Title</label>
                    <input type="text" id="favoriteBook" name="favoriteBook" placeholder="The Great Gatsby" value="<?= $favoriteBook ?>">
                </div>

                <!--
                    GENRE – select dropdown
                    THOUGHT PROCESS: A dropdown is better than radio
                    buttons here because the genre list could grow
                    long.  The first <option> has an empty value so
                    the user is forced to make an active choice.
                -->
                <div class="form-group">
                    <label for="genre">Preferred Genre</label>
                    <select id="genre" name="genre">
                        <option value="--"<?= ($genre === '--' || $genre === '') ? ' selected' : '' ?>>-- Select a Genre --</option>
                        <option value="Fiction"<?= ($genre === 'Fiction') ? ' selected' : '' ?>>Fiction</option>
                        <option value="Non-Fiction"<?= ($genre === 'Non-Fiction') ? ' selected' : '' ?>>Non-Fiction</option>
                        <option value="Mystery"<?= ($genre === 'Mystery') ? ' selected' : '' ?>>Mystery</option>
                        <option value="Science Fiction"<?= ($genre === 'Science Fiction') ? ' selected' : '' ?>>Science Fiction</option>
                        <option value="Fantasy"<?= ($genre === 'Fantasy') ? ' selected' : '' ?>>Fantasy</option>
                        <option value="Historical"<?= ($genre === 'Historical') ? ' selected' : '' ?>>Historical</option>
                        <option value="Biography"<?= ($genre === 'Biography') ? ' selected' : '' ?>>Biography</option>
                    </select>
                </div>

                <!--
                    MEETING DAYS – checkboxes
                    THOUGHT PROCESS: Checkboxes allow multiple
                    selections, which makes sense for availability.
                    All checkboxes share the same 'name' so PHP
                    collects them into a single array.  The [] in
                    the name attribute tells PHP to treat it as an
                    array automatically.
                -->
                <div class="form-group">
                    <label>Days You Can Meet</label>
                    <div class="checkbox-group">
                        <?php
                        // Loop through each day so we do not have to
                        // write repetitive HTML for every checkbox.
                        $days = ['Monday','Tuesday','Wednesday','Thursday','Friday'];
                        foreach ($days as $day):
                            // 'checked' attribute is added if the user
                            // previously selected this day (preserves
                            // state after a failed validation).
                            $checked = in_array($day, $meetingDays) ? ' checked' : '';
                        ?>
                            <label>
                                <input type="checkbox" name="meetingDays[]" value="<?= $day ?>"<?= $checked ?>>
                                <?= $day ?>
                            </label>
                        <?php endforeach; ?>
                    </div>
                    <p class="hint">Select at least one day.</p>
                </div>

                <!--
                    BIO / READING GOALS – textarea
                    THOUGHT PROCESS: A textarea is appropriate here
                    because the response could be several sentences.
                    It also allows the user to see and edit multiple
                    lines easily.
                -->
                <div class="form-group">
                    <label for="bio">About You / Reading Goals</label>
                    <textarea id="bio" name="bio" placeholder="Tell us a little about yourself and what you hope to get out of the book club..."><?= $bio ?></textarea>
                    <p class="hint">Minimum 10 characters.</p>
                </div>

                <!-- Submit button -->
                <button type="submit" class="btn-submit">Sign Me Up!</button>
            </form>

        <?php } // end of else (form display) ?>
    </div>

    <a href="index.php" class="back-link">← Back to Main Page</a>

    <div class="footer">
        <p>[Your Name] &bull; PHP Assignment &bull; February 2026</p>
    </div>
</div>
</body>
</html>
