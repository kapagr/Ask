window.onload = initPage;

function initPage() {  // find the heads of answer on the page  thumbs = document.getElementById("answer").getElementsByTagName("p");  // set the handler for each answer  for (var i = 0; i < thumbs.length; i++) {
    ans = thumbs[i];

    // create the onclick function
    ans.onclick = function() {
      // find the image name
      getDetails(this.title);
    }  }}

function createRequest() {
  try {
    request = new XMLHttpRequest();
  } catch (tryMS) {
    try {
      request = new ActiveXObject("Msxml2.XMLHTTP");
    } catch (otherMS) {
      try {
        request = new ActiveXObject("Microsoft.XMLHTTP");
      } catch (failed) {
        request = null;
      }
    }
  }
  return request;
}function getDetails(itemName) {  request = createRequest();  if (request == null) {    alert("Unable to create request");    return;  }  var url= "getans.php?AID=" + escape(itemName);  request.open("GET", url, true);  request.onreadystatechange = displayDetails;  request.send(null);}
function displayDetails() {  if (request.readyState == 4) {    if (request.status == 200) {      detailDiv = document.getElementById("answer");      detailDiv.innerHTML = request.responseText;    }  }}