var slider = document.getElementById("myRange");
var output = document.getElementById("demo");
output.innerHTML = slider.value;

function filter() {
    var x = document.getElementById("sidebar");
    if (x.style.left === "-100%") {
      x.style.left = "0%";
    } else {
      x.style.left = "-100%";
    }
  }

  slider.oninput = function() {
    output.innerHTML = this.value;
  }

  