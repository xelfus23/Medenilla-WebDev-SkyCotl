<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sky kids</title>
</head>
<body>
    <header>Welcome to the sky kingdom</header>

    <section>PHP basics</section>
    <p>Let's dive into some PHP fundamentals</p>
    <ul>
        <li>Syntax: PHP code is embedded within HTML using &lt;?php .... ?&gt; tags. </li>
        <li>Comments: Use // for single-line comments and /* ... */ for multi-line comments.</li>
        <li>Case Sensitivity: PHP is case-sensitive; variable names are case-sensitive.</li>
        <li>Variables: Declare variables using the $ symbol (e.g., $beeCount).</li>
        <li>Echo/Print: Use echo or print to display content on the page.</li>
        <li>Data Types: PHP supports various data types, including strings, numbers, and arrays.</li>
        <li>String Concatenation: Combine strings with the . operator (e.g., $greeting . ' from PHP!').</li>

    </ul>
    <section>
        <h2>Sky Children of the Light</h2>
        <p>Moths are how we call a new player, they collect candles to buy a new cosmetics from the spirits. Hold hands and take flight in an unforgettable social adventure together with loved ones.<br> Explore the seven realms of this beautifully-animated kingdom with other players where compassion, community and wonder greet you at each turn.<br> Create enriching memories as you solve mysteries, make friends, and help others along the way.</p>

        <?php
            $mothCount = 50000;
            $SkyKid = "Moths";
            $greeting = "Hello Sky kid";

            $kidSize = "chibi, normal and tall";
            $candles = 20.5;

            $averageCandleCollection = 15;

            $isLazy = true;

            $SkyKidDescription = "Sky kids are cute figure they have sizes like " . $kidSize . ".";
            $lifespanInfo = "On average, sky kids can collect up to $averageCandleCollection candles per day.";
            $lazyInfo = $isLazy ? "They are considered lazy." : "They are not considered lazy.";

            echo "<p>$greeting from PHP 🌎!</p>";
            print "<p>There are approximately $mothCount $SkyKid in the kingdom of sky.</p>";
            echo "<p>$SkyKidDescription</p>";
            echo "<p>$lifespanInfo</p>";
            echo "<p>$lazyInfo</p>";
        ?>

        <p>There are various kinds of sky kids there the candle runner, sleeper, the musician, the veteran, and the killer moth.</p>
    </section>
    <footer>
        <p>&copy; 2023 the sky kingdom</p>
    </footer>
</body>
</html>