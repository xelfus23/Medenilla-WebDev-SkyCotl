<?php include("../php/database/database.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="../css/gen.css">
</head>
<body>
    <div class="backgroundd">

    </div>
    <div class="section-1">
       <div class="top">
            <h1>Unleash Your Inner Maestro, Explore the Harmony of Color and Sound!</h1>
            <p>Introducing<span style="font-weight: bolder;"> Sky cape and Instrument shop</span>, where vibrant capes and enchanting musical instruments collide to ignite your artistic spirit.</p>
       </div>

       <div class="bot">
                <p id="backbtn" class="left">Previous</p>

            <div class="text-container">

                <div id="text" class="texts">
                    <div class="text-1">
                        <h1>Express Yourself with Colorful Capes</h1>
                        <p>Wrap yourself in a kaleidoscope of hues with our exclusive line of capes. <br>From bold neons to soothing pastels, each cape is a canvas for your creativity. Be a visual symphony as you dance through life, turning heads and spreading joy wherever you go.</p>
                        <p></p>
                    </div>
                    <div class="text-2">
                        <h1>Crafted for Excellence</h1>
                        <p>Immerse yourself in the unparalleled craftsmanship of our Artisan Series guitars.<br> Each instrument is meticulously handcrafted by skilled artisans who are passionate about bringing music to life.</p>
                    </div>
                    <div class="text-3">
                        <H1>Symphony of Sound, Splash of Color</H1>
                        <p>Elevate your musical journey with our handcrafted instruments that resonate with both melody and style.<br> Our guitars, ukuleles, and percussion instruments are not just tools; they're expressions of your unique rhythm. Discover the joy of making music in vivid technicolor.</p>
                    </div>
                    <div class="text-4">
                        <H1>Craftsmanship Meets Whimsy</H1>
                        <p>Immerse yourself in the world of imagination and craftsmanship. Our capes are made with care, ensuring a soft touch and vibrant longevity.<br> Meanwhile, our instruments blend precision engineering with a burst of creativity, providing a visual and auditory feast for the senses.</p>
                    </div>
                    <div class="text-5">
                        <H1>Bundle and Save</H1>
                        <p>Indulge in the ultimate creative experience with our exclusive bundles! Purchase a colorful cape and a musical instrument together to save [X%].<br> Unleash the artist in you with a duo that's as harmonious as your favorite melody.</p>
                    </div>
                    <div class="text-6">
                        <H1>Limited Edition Releases</H1>
                        <p>Stay tuned for our limited edition releases, where we push the boundaries of creativity even further.<br> Be the first to own these exclusive, artistic collaborations that redefine the intersection of color and sound.</p>
                    </div>
                    <div class="text-7">
                        <h2>Ready to embark on a journey where music meets fashion, and every note is a brushstroke of color?<br> Dive into the world of <span style="font-size: 40px; color: rgb(166, 243, 253);">Sky</span> and let your imagination run wild!</h2>
                    </div>
                </div>

            </div>
            <p id="nextbtn" class="right">Next</p>
       </div>
       
       <div class="buttons">
            <a href="login.php"><button class="btn-1">Shop Now!</button></a>
        </div>
    </div>
</body>
</html>
<script>

    let scrollContainer = document.getElementById('text');
    let backBtn = document.getElementById("backbtn");
    let nextBtn = document.getElementById("nextbtn");

    scrollContainer.addEventListener("wheel", (evt) => {
        evt.preventDefault();
        scrollContainer.scrollLeft += evt.deltaX;
    })

    nextBtn.addEventListener("click", ()=>{
        scrollContainer.scrollLeft += 900;
    });

    backBtn.addEventListener("click", ()=>{
        scrollContainer.scrollLeft -= 900;
    });

</script>