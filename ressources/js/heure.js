// JavaScript Document
function runClock() {
  today   = new Date();
  hours   = today.getHours();
  minutes = today.getMinutes();
  seconds = today.getSeconds();
  timeValue = hours;
  // Les deux prochaines conditions ne servent que pour l'affichage.
  // Si le nombre de minute est inf?rieur ? 10, alors on rajoute un 0 devant...
  timeValue += ((minutes < 10) ? ":0" : ":") + minutes;
  timeValue += ((seconds < 10) ? ":0" : ":") + seconds;
  document.getElementById("time").innerHTML = timeValue;
  
  timerID = setTimeout("runClock()",1000);
  timerRunning = true;
}