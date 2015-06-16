/**
 * "Color Memory Game"
 * @author Om Prakash <oppradhan2011@gmail.com>
 */
Array.prototype.shuffle = function() {
  var temp, j, i;
  for (temp, j, i = this.length; i; ) {
    j = parseInt(Math.random() * i);
    temp = this[--i];
    this[i] = this[j];
    this[j] = temp;
  }
};

Array.prototype.in_array = function(value) {
  var i, result = false;
  for (i = 0; i < this.length; i = i + 1) {
    if (this[i] === value) {
      result = true;
    }
  }
  return result;
};

var calculateScore = function(score, match) {
  if (match) {
    score = score + 1;
  } else {
    score = score - 1;
  }
  return score;
};
var updateScore = function(score) {
  var info = document.getElementById('game-score');
  info.innerHTML = score;
};
var prepareGame = function(evt, rows, cols, matches) {
  "use strict";
  var gameScore = 0;
  var cardsList = ['yellow', 'red', 'green', 'skyblue', 'lightblue', 'blue', 'pink', 'orange'],
  gameWrapper = document.getElementById('playfield-wrapper'),
  playfield = document.createElement('table'),
  cards = [],
  mouseHndl = null,
  clickHandle = null,
  self = this,
  matchCount = 0,
  openCards = [],
  Card = function(text, pair) {
    this.state = 0;
    this.freezed = 0;
    this.text = text;
    this.pair = pair;

    var flipper = null,
    front = null,
    back = null;

    this.setBoard = function(idx, container) {
      var card = document.createElement('div');
      flipper = card.cloneNode(false);
      front = card.cloneNode(false);
      back = card.cloneNode(false);

      card.className = 'card';
      flipper.className = 'flipper';
      front.className = 'front face icon ' + this.text;
      back.className = 'back face';
      flipper.appendChild(back);
      flipper.appendChild(front);
      flipper.setAttribute('idx', idx);
      flipper.setAttribute('id', idx);
      card.appendChild(flipper);
      container.appendChild(card);
    };

    this.flip = function(state) {
      if (state === 0) {
        flipper.className = 'flipper flipfront';
        front.style.opacity = 1;
        back.style.opacity = 0;
        this.state = 1;
      } else if (state === 1) {
        flipper.className = 'flipper';
        front.style.opacity = 0;
        back.style.opacity = 1;
        this.state = 0;
      }
    };
    this.pulse = function(card) {
      var pulseTimer = null;
      flipper.className = 'flipper flipfront pulse';
      pulseTimer = window.setTimeout(function() {
        flipper.parentNode.style.opacity = '0.3';
      }, 1000);
      pulseTimer = null;
      setTimeout(function() {
        removeCards(card);
      }, 1000);
    };
  },
  prepare = function() {
    var i = 0, j = 0;
    for (i = 0; i < (rows * cols) / matches; i = i + 1) {
      for (j = 0; j < matches; j = j + 1) {
        cards.push(new Card(cardsList[i], i));
      }
    }
    cards.shuffle();
  },
  setBoard = function() {
    var tbody = document.createElement('tbody'),
    row = document.createElement('tr'),
    cell = document.createElement('td'),
    rowFrag = document.createDocumentFragment(),
    cellFrag = document.createDocumentFragment(),
    i = 0,
    j = 0,
    k = 0;
    prepare();
    for (i = 0; i < rows; i = i + 1) {
      row = row.cloneNode(false);
      for (j = 0; j < cols; j = j + 1) {
        cell = cell.cloneNode(false);
        cards[k].setBoard(k, cell);
        cellFrag.appendChild(cell);
        k = k + 1;
      }
      row.appendChild(cellFrag);
      rowFrag.appendChild(row);
    }
    tbody.appendChild(rowFrag);
    playfield.appendChild(tbody);
    gameWrapper.replaceChild(playfield, gameWrapper.childNodes[0]);
  },
  play = function(e, src) {
    var isFace = (src.className.indexOf('face') !== -1),
    isFlipper = (src.className === 'flipper'),
    card = null,
    i = 0,
    backFlipTimer = null;
    
    if (isFace || isFlipper) {
      if (isFace) {
        src = src.parentNode;
      }
      card = cards[src.getAttribute('idx')];
      card.fetchId = src.getAttribute('idx');
      if (card.freezed === 1) {
        return;
      }
      if (openCards.length === 0) {
        openCards.push(card);
      } else if (!openCards.in_array(card) && openCards.length < matches) {
        if (openCards[openCards.length - 1].pair === card.pair) {
          openCards.push(card);
          if (openCards.length === matches) {
            card.flip(0);
            for (i = 0; i < openCards.length; i = i + 1) {
              openCards[i].freezed = 1;
              openCards[i].pulse(openCards[i]);
            }
            matchCount = matchCount + 1;
            openCards = [];
          }
          gameScore = calculateScore(gameScore, true);
          updateScore(gameScore);
        } else {
          evt.detach('mousedown', playfield, mouseHndl);
          backFlipTimer = window.setTimeout(function() {
            card.flip(1);
            for (i = 0; i < openCards.length; i = i + 1) {
              openCards[i].flip(1);
            }
            openCards = [];
            mouseHndl = evt.attach('mousedown', playfield, play);
          }, 300);
          backFlipTimer = null;
          gameScore = calculateScore(gameScore, false);
          updateScore(gameScore);
        }
      }
      if (card.state === 0) {
        card.flip(0);
      }
      if (matchCount === (rows * cols) / matches) {
        gameWrapper.className = 'win';
        window.setTimeout(function() {
          playfield.className = 'play-field win';
          gameWrapper.className = '';
        }, 1500);
        initializeUserdetailsBox(gameScore);
      }
    }
  };
  var removeCards = function(card) {
    if (card.fetchId) {
      var elem = document.getElementById(card.fetchId);
      elem.remove(3000);
    }
  }
  gameWrapper.className = '';
  playfield.className = 'play-field';
  cardsList.shuffle();
  setBoard();
  mouseHndl = evt.attach('mousedown', playfield, play);
  var currentRow = 0;
  var currentCell = 0;
  var tableCell;
  function ChangeCurrentCell() {
    var tableRow = document.getElementsByTagName("tr")[currentRow];
    tableCell = tableRow.childNodes[currentCell];
    tableCell.focus();
    tableCell.style.border = "1px dashed white";
  }
  ChangeCurrentCell();

  $(document).keydown(function(e) {
    if (e.keyCode == 37) {
      if (currentCell != 0) {
        currentCell--;
      } else {
        return false;
      }
      tableCell.style.border = "none";
      ChangeCurrentCell();
      return false;
    }
    if (e.keyCode == 38) {
      if (currentRow != 0) {
        currentRow--;
      } else {
        return false;
      }
      tableCell.style.border = "none";
      ChangeCurrentCell();
      return false;
    }
    if (e.keyCode == 39) {
      if (currentCell != 3) {
        currentCell++;
      } else {
        return false;
      }
      tableCell.style.border = "none";
      ChangeCurrentCell();
      return false;
    }
    if (e.keyCode == 40) {
      if (currentRow != 3) {
        currentRow++;
      } else {
        return false;
      }
      tableCell.style.border = "none";
      ChangeCurrentCell();
      return false;
    }
    if (e.keyCode == 13) {
      e.stopPropagation();
      if (tableCell.children.length > 0 && tableCell.children[0].children.length > 0) {
        play(e, tableCell.children[0].children[0]);
      }
    }
  });
};

var MemoryGame = function(evt) {
  "use strict";
  var gameDimension = {'rows': 4, 'cols': 4, 'matches': 2};
  var info = document.getElementById('game-info');
  var game = null,
  start = function() {
    game = new prepareGame(evt, gameDimension.rows, gameDimension.cols, gameDimension.matches);
  };
  start();
};