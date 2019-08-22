<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Fetch</title>
    </head>
    <body>
        <form id="drinks-form">
            <input type="text" name="condition">
            <input type="submit">
        </form>
        <div id="drinks-container">
            
        </div>
        <script>
            const endpointUrl = "api/drinks/get.php";
            document.getElementById("drinks-form")
                    .addEventListener("submit", e => {
                e.preventDefault();
                
                // Kad PHP traktuotų requestą kaip POSG
                // ir normaliai sudėtų į _POST duomenis
                // reikia kurti FormData bl.
                let formData = new FormData();
                const conditions = {
                    // laukelio e.target.condition.value vertė
                    name: e.target.condition.value,
                };
                
                // Kadangi mes negalim appendinti į formData
                // array'jaus arba objekto, mums ir vėl pisliava
                // Reikia už-JSON encodinti conditionų objektą
                const jsonCond = JSON.stringify(conditions);
                
                // Dabar jau jsonCond yra stringas, todėl galima
                // appendinti į formData
                formData.append('conditions', jsonCond);
                
                // Kreipiamės į savo API'jų
                fetch(endpointUrl, {
                    method: "POST",
                    // Tai yra POST'o duomenys. Atsiminkime brangieji
                    body: formData
                })
                        // Serverio atsakymas (jau JSONinis)
                        .then(response => {
                            // Kadangi responsas pas mus get.php
                            // yra json encodintas, tai mes naudojam
                            // nebe .text() o .json().
                            response.json().then(obj => {
                                // ŠITAS OBJ yra javascriptinis objektas
                                // (išdecodintas jsonas)
                                console.log(obj.data.forEach(v => {
                                    DisplayBeer(v);
                                }));
                            });
                        })
                        .catch(e => console.log(e.message));
            });

            function DisplayBeer(value) {
                const drinksDiv = document.getElementById("drinks-container");
                drinksDiv.innerHTML = "";

                const h3_name = document.createElement("h3");
                const h3_amount= document.createElement("h3");
                const h3_abarot = document.createElement("h3");
                const image = document.createElement("img");

                image.src = value.image;
                h3_name.innerHTML = value.name;
                h3_abarot.innerHTML = value.abarot;
                h3_amount.innerHTML = value.amount_ml;
                drinksDiv.append(h3_name, h3_abarot, h3_amount, image);
            }
        </script>
    </body>
</html>
