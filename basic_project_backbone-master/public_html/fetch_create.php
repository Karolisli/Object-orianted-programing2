<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>fetch_create</title>
        <link rel="stylesheet" href="media/css/normalize.css">
        <link rel="stylesheet" href="media/css/milligram.min.css">
        <link rel="stylesheet" href="media/css/style.css">
        <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
        <link rel="icon" href="favicon.ico" type="image/x-icon">
    </head>
    <body>
        <form id="create-form">
            <div>
                <input type="text"  name="name" placeholder="Type your drink name">
            </div>
            <div >
                <input type="number"  name="amount_ml" placeholder="Type amount">
            </div>
            <div>
                <input type="number" name="abarot" placeholder="How much %">
            </div>
            <div>
                <input type="text" name="image" placeholder="Type url your image">
            </div>
            <input type="submit">
        </form>
        <div id="drinks-container">
​
        </div>
    <script>
        const endpointUrl = "api/drinks/create.php";
        const drinksDiv = document.getElementById("drinks-container");

        document.getElementById("create-form")
                .addEventListener("submit", e => {
                    e.preventDefault();

                    // Kad PHP traktuotų requestą kaip POST
                    // ir normaliai sudėtų į _POST duomenis
                    // reikia kurti FormData.
                    let formData = new FormData(e.target);
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
                                response.json()
                                // Tada
                                        .then(obj => {
                                            // Tikriname ar iraseme/neiraseme duomenys i faila
                                            // ir jaigu isiraso tai atvaizduojam tai ka irasome  
                                            if (obj.status == 'success') {                                      
                                                displayDrink(obj.data);
                                                // ŠITAS OBJ yra javascriptinis objektas
                                                // (išdecodintas jsonas)
                                                console.log(obj);
                                            } 
                                            // Jaigu nepavyksta irasyti i faila atvaizduojam 
                                            // errora tam laukui kuris priklauso
                                            else {
                                                displayErrors(obj.errors);
                                            }

                                        });
                            })
                            .catch(e => console.log(e.message));
                });
        // Funkcija kuria iskvietus parodys
        // tam tikrus fieldu errorus          
        function displayErrors(errors) {
            // Paleidziam funkcija kuri istrina error messagus
            removeErrors();
            // Kadangi errors yra objektas arrayjuje
            // sukame cikla per objekta kad gautume erorru raktus (input name)
            Object.keys(errors).forEach(function (error_id) {
                // Sukuriam kintamaji kuris paselektina
                // tam tikra lauka, kuriame bus erroras 
                const field = document.querySelector('input[name="' + error_id + '"]');
                // Sukuriam kintamji kuris sukuria elementa span
                const span = document.createElement("span");
                // Span kintamajam duodame atributas
                span.className = 'field_error';
                // I span kintamaji pridedam jam skirta lauko errora
                span.innerHTML = errors[error_id];
                // I field pridedam span kintamaji
                field.parentNode.append(span);
            })
        }
        // Funkcija kuri istrina visus error'u laukus
        function removeErrors() {
            // Pasiselektinam visus laukus su tam priskirtu vardu 
            const errors = document.querySelectorAll('.field_error');
            // Tikrinam ar yra errorai ir jaigu yra tikrindami juos per cikla istriname  
            if (errors) {
                errors.forEach(function (node) {
                    node.parentNode.removeChild(node);
                });
            }
        }
        // Funkcija kuri atvaizduos gerima 
        function displayDrink(value) {

            const h2name = document.createElement("h2");
            const h2abarot = document.createElement("h2");
            const h2amount = document.createElement("h2");
            const img = document.createElement("img");
            img.src = value.image;
            h2name.innerHTML = value.name;
            h2abarot.innerHTML = value.abarot;
            h2amount.innerHTML = value.amount_ml;

            drinksDiv.innerHTML = "";

            drinksDiv.append(h2name, h2abarot, h2amount, img);
        }
    </script>
    </body>
</html>