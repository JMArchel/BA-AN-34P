// ROCK, PAPER, SCISSOR ENUM
// ROCK = 0, PAPER = 1, SCISSOR = 2
//choices and properties
// This holds the current state of the games and the data needed for our statistical
// calculations. As well as properties of the game.
const game_choices = {
  ROCK: 0,
  PAPER: 1,
  SCISSOR: 2,
  properties: {
    count: [0, 0, 0],
    cond_probablity: [0, 0, 0],
    cond_count: [
      [0, 0, 0],
      [0, 0, 0],
      [0, 0, 0],
    ],
  },
};

//number of plays
var score = {
  human: 0,
  cpu: 0,
  draw: 0,
};

// Variable to hold user's last choice
var last_choice = null;

/**
 * This handles incrementing the count of our game_choices variable based
 * on the user's choice
 * @param {String} uChoice
 */
function increment(uChoice) {
  if (uChoice == "rock") {
    uChoice = game_choices.ROCK;
  } else if (uChoice == "paper") {
    uChoice = game_choices.PAPER;
  } else if (uChoice == "scissor") {
    uChoice = game_choices.SCISSOR;
  } else {
    console.error("User choice error");
  }

  // This is where we increment the count of the user's choice for each possible option
  game_choices.properties.count[uChoice]++;
  last_choice != null
    ? game_choices.properties.cond_count[uChoice][last_choice]++
    : null;
  last_choice = uChoice;
}

/**
 * This function handles calculating the conditional probabilities and is called after every
 * match to update the data.
 */
function calcCondProbablities() {
  // P (ROCK | X)
  game_choices.properties.cond_probablity[game_choices.ROCK] =
    game_choices.properties.cond_count[game_choices.ROCK][last_choice] /
    (game_choices.properties.count[last_choice] - 1);

  // P (PAPER | X)
  game_choices.properties.cond_probablity[game_choices.PAPER] =
    game_choices.properties.cond_count[game_choices.PAPER][last_choice] /
    (game_choices.properties.count[last_choice] - 1);

  // P (SCISSOR | X)
  game_choices.properties.cond_probablity[game_choices.SCISSOR] =
    game_choices.properties.cond_count[game_choices.SCISSOR][last_choice] /
    (game_choices.properties.count[last_choice] - 1);
}

/**
 * This is to help the CPU get te most likely choice needed to beat
 * the user based on past matches and calculating the conditional probabilities.
 * @returns mostLikely {String} The most likely choice of the CPU
 */
function getMostLikely() {
  let mostLikely = game_choices.ROCK;

  if (
    game_choices.properties.cond_probablity[game_choices.PAPER] >
    game_choices.properties.cond_probablity[mostLikely]
  )
    mostLikely = game_choices.PAPER;

  if (
    game_choices.properties.cond_probablity[game_choices.SCISSOR] >
    game_choices.properties.cond_probablity[mostLikely]
  )
    mostLikely = game_choices.SCISSOR;

  return mostLikely;
}
