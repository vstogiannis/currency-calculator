function currencyCalculation(){
  var base = document.querySelector(".base").value;
  var amount = document.querySelector(".amount").value;
  var exchange = document.querySelector(".exchange").value;
  var request = new XMLHttpRequest();
  // get API for the currencies
  request.open("GET", "https://api.exchangeratesapi.io/latest?base=" + base);
  request.onload = function(){
    var data = JSON.parse(request.responseText);
    var keyNames = Object.keys(data.rates);
    var values = Object.values(data.rates);
    console.log(keyNames);
    if (amount === ""){
      alert("Please fill the 'Amount' box!");
      location.reload();
    }
    if (base === exchange){
      var result = amount;
    } else {
        for (var i = 0; i < keyNames.length; i++){
          if (keyNames[i] === exchange){
          var result = (amount) * (values[i]);
            break;
          }
        }
      }

    document.querySelector(".show-result").innerHTML = "Today, " + data.date + ", " + amount + " " + base + " are equal to " + result + " " + exchange + "!"
  };
  request.send();
}
// callback function for deleting currency
var currencies = document.querySelectorAll(".admin-currencies");
for (var i = 0; i < currencies.length; i++){
  currencies[i].addEventListener("click", function(e){
    if (e.target.className === "btn btn-danger btn-sm"){
      var id = e.target.getAttribute("id");
      var route = `/currency-calculator/public/delete/${id}`;

      var newReq = new XMLHttpRequest();
      newReq.open("DELETE", route);
      newReq.onload = function(){
        location.reload();
      };
      newReq.send();
    }
  });
}
