window.onload = initPage;

function initPage() {
    ans = thumbs[i];

    // create the onclick function
    ans.onclick = function() {
      // find the image name
      getDetails(this.title);
    }

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
}
