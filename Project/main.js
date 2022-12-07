/**
 * This function gets called when the user clicks on a choice
 * from the UI, it passes the element that the user clicked on,
 * and will run the calculation of the conditional probability, then
 * finally show the results.
 * @param {Element} element
 */
function pickChoice(element) {
  // This saves the image link of the choice the user made, so
  // it can be an image of a rock, paper, or scissor
  var userChoice = element.firstElementChild.src;
  // We then target the element that will handle holding the image
  // of the user's choice
  var humanBox = document.getElementsByClassName("human")[0].children[1];

  // We set the image link for the element that shows the user's choice to either
  // rock, paper or scissor
  humanBox.src = userChoice;
  // Then the alternate text is extracted from the element
  var uChoice = element.firstElementChild.alt;
  // We get the CPU choice that we save into this variable
  var cChoice = CPUchoice();

  // The game choice properties get incremented based on the choice of the user
  increment(uChoice);
  // Calculating of the conditional probabilities is made here after each pick that user makes
  calcCondProbablities();

  // Finally the results are shown on the UI
  showResults(cChoice, uChoice);
}

/**
 * This is to return the CPU's choice that will be used against
 * the user's choice.
 * @returns choice {String} The choice of the CPU
 */
function CPUchoice() {
  // This is an array of options of the possible choices
  var options = ["rock", "paper", "scissor"];
  // This is to target the first child of the assigned element that holds the CPU's choice
  var CPUbox = document.getElementsByClassName("cpu")[0].children[1];
  // Initial choice of the CPU will be null
  var choice = null;
  // We fetch the most likely choice the CPU will make against the user based on previous games
  var mostLikelyChoice = options[getMostLikely()];

  // This is to print to console for checking
  console.log(mostLikelyChoice);

  // These if-else statements handling setting the choice by matching the most
  // likely choices with the options
  if (mostLikelyChoice == options[0]) {
    choice = options[1];
  } else if (mostLikelyChoice == options[1]) {
    choice = options[2];
  } else if (mostLikelyChoice == options[2]) {
    choice = options[0];
  } else {
    console.error("Most Likely Choice Error.");
  }

  // Sets the image of the CPU's choice based on the current choice
  CPUbox.src = "./imgs/" + choice + ".svg";
  return choice;
}

/**
 * This is return a random number between 0-2
 * @returns random {Number} A random number between 0-2
 */
function randomNumberGenerator() {
  var random = Math.round(Math.random() * 2);

  return random;
}

/**
 * This is handle displaying the results to the UI, and indicate
 * whether the user won, lost or the result was a draw. It also displays the
 * score on UI.
 * @param {String} CPUchoice
 * @param {String} userChoice
 */
function showResults(CPUchoice, userChoice) {
  // We target the elements we want to manipulate on the php/html
  var resultsBox =
    document.getElementsByClassName("results")[0].firstElementChild;
  var human_score = document.getElementById("human-score");
  var cpu_score = document.getElementById("cpu-score");

  // Based on the choices, these if-else statements will insert the result element
  // the paragraph tag with the appropriate message and will increment the score
  // in our game properties variable.
  if (CPUchoice == userChoice) {
    resultsBox.innerHTML = "<p>It's a draw.</p>";
    score.draw++;
  } else if (
    (CPUchoice == "rock" && userChoice == "scissor") ||
    (CPUchoice == "paper" && userChoice == "rock") ||
    (CPUchoice == "scissor" && userChoice == "paper")
  ) {
    resultsBox.innerHTML = "<p>You lost.</p>";
    score.cpu++;
  } else {
    resultsBox.innerHTML = "<p>You win!</p>";
    score.human++;
  }

  // We set the innerHTML of the human and cpu sore elements to the corresponding scores
  human_score.innerHTML = score.human;
  cpu_score.innerHTML = score.cpu;
}
