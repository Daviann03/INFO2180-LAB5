window.onload = function () {

    let lookupButton = document.getElementById("lookup");
    let resultDiv = document.getElementById("result");
    let countryInput = document.getElementById("country");

    lookupButton.addEventListener("click", function (e) {
        e.preventDefault();

        let country = countryInput.value;
        let url = "world.php?country=" + encodeURIComponent(country);

        fetch(url)
            .then(response => response.text())
            .then(data => {
                resultDiv.innerHTML = data;
            })
            .catch(error => {
                resultDiv.innerHTML = "Error: " + error;
            });
    });

};
