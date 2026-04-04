window.onload = function () {
    const lookupBtn = document.getElementById("lookup");
    const lookupCitiesBtn = document.getElementById("lookup-cities");
    const resultDiv = document.getElementById("result");

    // Lookup countries
    lookupBtn.addEventListener("click", function () {
        let country = document.getElementById("country").value;

        fetch(`world.php?country=${country}`)
            .then(response => response.text())
            .then(data => {
                resultDiv.innerHTML = data;
            });
    });

    // Lookup cities
    lookupCitiesBtn.addEventListener("click", function () {
        let country = document.getElementById("country").value;

        fetch(`world.php?country=${country}&lookup=cities`)
            .then(response => response.text())
            .then(data => {
                resultDiv.innerHTML = data;
            });
    });
};
