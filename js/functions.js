function closeObject(id) {
  document.getElementById(id).style.display = 'none';
}

function openObject(id) {
  document.getElementById(id).style.display = 'block';
}


function cleanString(aString){
	return String(aString).replace(/(\r\n|\n|\r)/gm, "");
}

function rad2deg(angle) {
  //  discuss at: http://phpjs.org/functions/rad2deg/
  // original by: Enrique Gonzalez
  // improved by: Brett Zamir (http://brett-zamir.me)
  //   example 1: rad2deg(3.141592653589793);
  //   returns 1: 180

  return angle * 57.29577951308232; // angle / Math.PI * 180
}
