<?php
    session_start();
    if(!isset($_SESSION['user']))
    {
        header("Location: ../index.html");
        exit();
    }
?>


<!DOCTYPE html>
<html>
    <head>
        <title>Type Speed Test</title>
        <link rel="stylesheet" href="../css/index.css"/>
    </head>
    <body>
        <div>
            <center>
                <div class="header-buttons">
                    <a href="../index.html"><button class="login-btn">Log in</button></a>
                    <a href="../api/leaderboard.php"><button class="leaderboard-btn">Leader Board</button></a>
                </div>
            </center>
            
            <div class="test">
                <h6>TYPING SPEED TEST</h6>
                <h1>Test your typing skills</h1>
            </div>
            <div class="typing-metrics">
                <div class="timer">
                    <div class="circle">
                        <span class="time">60</span>
                    </div>
                    <p>seconds</p>
                </div>
                <div class="metric-box">
                    <span class="metric-value">0</span>
                    <p>words/min</p>
                </div>
                <div class="metric-box">
                    <span class="metric-value">0</span>
                    <p>chars/min</p>
                </div>
                <div class="metric-box">
                    <span class="metric-value">0</span>
                    <p>% accuracy</p>
                </div>
            </div>

            <div id="quote" class="quote-box" style="display: none;"></div> 
            <div id="highlighted-quote" class="highlight-box"></div>
            <center>
            <label for="inputBox" style="font-family: Arial, Helvetica, sans-serif;font-weight: lighter;">Type the paragraph here</label><br/>
            <textarea id="inputBox" placeholder="Start typing here..." ></textarea>
            </center>
        </div>

        <script src="../text.js"></script>
    </body>
</html>