<!DOCTYPE html>
<html>
<head>
    <title>My App</title>
    <link rel="stylesheet" href="css/page1.css">
</head>
<body>
    <div class="banner">
        <div class="overlay"></div>  <!-- Overlay pour assombrir l'image -->
        <div class="content">
            <div>
                <button type="button" onclick="window.location.href='/Dashboard'">OPEN</button>
                <br>
            </div>
        </div>
    </div>
</body>
<style>
    * {
        margin: 0;
        padding: 0;
        font-family: 'Arial', sans-serif;
    }

    /* Bannière avec image de fond */
    .banner {
        width: 100%;
        height: 100vh;
        background-image: url("images/open.png");
        background-size: cover;
        background-position: center;
        position: relative;
        display: flex;
        justify-content: center;
        align-items: center;
        overflow: hidden;
    }

    /* Overlay sombre pour l'image de fond */
    

    /* Contenu centré sur la bannière */
    .content {
        text-align: center;
        color: #fff;
        z-index: 10; /* Assurer que le texte est au-dessus de l'overlay */
        position: relative;
        top: 10%; /* Légèrement baissé */
    }

    /* Style du bouton avec un fond sombre */
    button {
        width: 250px;
        padding: 15px 0;
        text-align: center;
        margin: 20px 10px;
        border-radius: 50px;  /* Bordure arrondie pour un effet moderne */
        font-weight: bold;
        border: 2px solid transparent;
        background:rgb(34, 185, 255);  /* Couleur du fond */
        color: #fff;
        cursor: pointer;
        font-size: 16px;
        position: relative;
        overflow: hidden;
        transition: all 0.3s ease-in-out;
    }

    /* Effet au survol du bouton */
    button:hover {
        background-color:rgb(25, 114, 230);  /* Couleur plus foncée au survol */
        border-color:rgb(25, 107, 230);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3); /* Ombre au survol */
    }

    /* Effet de l'élément span sous le bouton */
    button span {
        background: #1e88e5;
        height: 100%;
        width: 0;
        position: absolute;
        left: 0;
        bottom: 0;
        z-index: -1;
        border-radius: 10px;
        transition: 0.3s;
    }

    button:hover span {
        width: 100%;
    }

    /* Ajustement du bouton sur mobile */
    @media (max-width: 768px) {
        button {
            width: 200px;
            padding: 12px 0;
        }
    }

</style>
</html>
