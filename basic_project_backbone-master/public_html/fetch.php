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
                                console.log(obj);
                            });
                        })
                        .catch(e => console.log(e.message));
            });
        </script>
    </body>
</html>
