window.sa = (function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0],
    t = window.sa || {};
  if (d.getElementById(id)) return t;
  js = d.createElement(s);
  js.id = id;
  js.src = "https://cdn.sophware.com/survey/sa.js";
  fjs.parentNode.insertBefore(js, fjs);
  return t;
}(document, "script", "sa-wjs"));
