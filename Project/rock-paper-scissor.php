<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="./style.css">
    <script src="./ml.js"></script>
    <script src="./stats.js"></script>
    <script src="./main.js"></script>
    <title>PROJECT #1</title>
    <link rel = "icon" href ="imgs/scissors.svg">
</head>
<?php include("header.php"); ?>
<body>
    <a href="https://github.com/JMArchel/BA-AN-34P" class="btn float">< ></a> 
    <section class="container game">
        <div class="section">
            <h1 style="padding: 7.5rem 0 1.5rem 0;">Rock, Paper, Scissors<br> Machine Learning</h1>
        </div>
        <div class="battle-area section">
            <div class="human">
                <h3 style="padding-bottom: 3px;">You</h3>
                <img src="">
                <p class="ml" id="human-score" style="padding-top: 3px;">0</p>
            </div>
            <div>
                <h3>VS</h3>
            </div>
            <div class="cpu">
                <h3>CPU</h3>
                <img src="">
                <p class="ml" id="cpu-score" style="padding-top: 3px;">0</p>
            </div>
        </div>
        <div class="results" style="padding: 1rem 0 1rem 0;">
            <h2>Pick a choice.</h2>
        </div>
        <div class="section options">
            <span class="options">
                <div class="rock" onclick="pickChoice(this)">
                    <img src="./imgs/rock.svg" alt="rock">
                </div>
                <div class="paper" onclick="pickChoice(this)">
                    <img src="./imgs/paper.svg" alt="paper">
                </div>
                <div class="scissor" onclick="pickChoice(this)">
                    <img src="./imgs/scissor.svg" alt="scissor">
                </div>
            </span>
        </div>
        <div class="stats-btn" style="padding-top: 1.5rem">
            <button type="button" class="btn press" onclick="showStats()">Statistics</button>
        </div>
    </section>
    <section class="container stats hide flex-container">
        <div class="row">
            <h1 style="padding: 7.5rem 0 0 0;">Statistics</h1>
            <a href="./rock-paper-scissor.php" class="btn press">Go Back</a>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-4" id="r-r">
                    <img src="./imgs/r-r.svg">
                    <p></p>
                </div>
                <div class="col-4" id="r-p">
                    <img src="./imgs/r-p.svg">
                    <p></p>
                </div>
                <div class="col-4" id="r-s">
                    <img src="./imgs/r-s.svg">
                    <p></p>
                </div>
            </div>
            <div class="row">
                <div class="col-4" id="p-r">
                    <img src="./imgs/p-r.svg">
                    <p></p>
                </div>
                <div class="col-4" id="p-p">
                    <img src="./imgs/p-p.svg">
                    <p></p>
                </div>
                <div class="col-4" id="p-s">
                    <img src="./imgs/p-s.svg">
                    <p></p>
                </div>
            </div>
            <div class="row">
                <div class="col-4" id="s-r">
                    <img src="./imgs/s-r.svg">
                    <p></p>
                </div>
                <div class="col-4" id="s-p">
                    <img src="./imgs/s-p.svg">
                    <p></p>
                </div>
                <div class="col-4" id="s-s">
                    <img src="./imgs/s-s.svg">
                    <p></p>
                </div>
            </div>
        </div>
    </section>
</body>
</html>