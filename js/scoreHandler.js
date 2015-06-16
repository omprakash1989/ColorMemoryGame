/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
var scoreSaved = false;
$(document).ready(function() {
  initializeGame();
});

function initializeUserdetailsBox(score) {
  console.log('new: '  + score)
  if (typeof(score) != 'undefined' && score !== '') {
    $('.close').on('click', function() {
//      $('.modalDialog').css({'opacity': 0, 'pointer-events': 'none'});
//      initializeGame();
//      $('#score-info').html('').hide();
      location.reload();
    });
    if (typeof(score) != 'undefined' && score !== '') {
      $('.modalDialog').css({'opacity': 1, 'pointer-events': 'auto'});
    }
    $('#save-score').on('click', function(){
      $('#score-form-error').text('').hide();
      if (scoreSaved == false) {
        saveScore(score);
      }
    });
  }
}

function initializeGame() {
  var evt = new EventHandler(),
  game = new MemoryGame(evt);
  scoreSaved = false;
}
function saveScore(new_score) {
  var email = $('#user-email').val();
  var name = $('#user-name').val();
  if (name == '') {
    setError('Please enter your name.');
    return false;
  }
  if (email == '' || !IsEmail(email)) {
    setError('Please enter a valid email.');
    return false;
  }
  scoreSaved = true;
  $.ajax({
    url: "score.php",
    method: 'POST',
    dataType: 'json',
    data: {
      'email': email,
      'name': name,
      'score': new_score
    }
  }).success(function(resp) {
    if (resp) {
      var html = '';
      if (resp.max_score) {
        html += '<p>Game Best Score: ' + resp.max_score + '</p>';
      }
      if (resp.score) {
        html += '<p>Your Best Score: ' + resp.score + '</p>';
      }
      if (resp.rank) {
        html += '<p>Your rank: ' + resp.rank + '</p>';
      }
      console.log(html)
      $('#score-info').html(html).show();
    }
  });
}

function IsEmail(email) {
  var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  return regex.test(email);
}

function setError(msg) {
  $('#score-form-error').text(msg).show();
}