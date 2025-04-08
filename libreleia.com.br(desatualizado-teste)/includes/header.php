<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Libre</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <script src="js/java.js"></script>

</head>

<style>
    .fonte1 {
        /*usados atualmente por sobre e descubra*/
        font-family: "kanit", sans-serif;
        font-size: 18px;
        font-weight: 400;
    }

    .fonte2 {
        /*logo*/
        font-family: "kalnia", serif;
        font-size: 300%;
        font-weight: 700;
    }

    .fonte3 {
        /*footer*/
        font-family: "kalnia", serif;
        font-size: 300%;
        font-weight: 700;
        color: white;
    }

    a {
        color: black;
        text-decoration: none;
    }

    body {
        border: 0px;
        margin: 0px;
        padding: 0px;

        background-color: rgb(255, 249, 240);


    }

    header {
        width: 100%;
        height: auto;

        /*border: 2px double yellowgreen;*/
        box-sizing: border-box;

        display: flex;
        flex-direction: column;

        position: fixed;

    }

    .header1 {
        z-index: 10;

        height: 85px;
        width: 100%;
        background-color: rgb(222, 195, 255);
        box-sizing: border-box;

        position: relative;


        display: flex;
        justify-content: space-between;
        align-items: center;

        padding: 0px 30px;
    }

    .logo {
        flex: 0;
        background-color: rgb(241, 241, 241);

        height: 60px;
        width: 156.50px;
    }

    .outros {
        display: flex;
        flex: 0;

        box-sizing: border-box;

        height: 60px;

        gap: 12px;

        /*background-color: lightseagreen;*/

        justify-content: space-between;
        align-items: center;

        padding: 5px 15px 5px 15px;
    }

    .outroslayout {
        display: flex;
        flex: 0 1 auto;

    }

    .outroslayout:hover {
        color: white;
        transition: .2s;
    }

    .conta {
        display: flex;
        flex: 0 1 auto;

        width: 50px;
        height: 50px;

        margin-left: 15px;

        background-color: rgb(255, 255, 255);
        border-radius: 50px;
    }

    .navbar {
        height: auto;
        width: 700px;
        z-index: 11;

        display: flex;
        flex: 0;

        transform: translateY(120px);

        flex-direction: column;

        box-sizing: border-box;
        transition: 0.5s;
    }

    .navbar form {
        display: flex;

    }

    .navbar.fixed {
        transform: translateY(-0px);
        transition: 0.5s;
        width: 700px;
    }

    .navbar.fixed .barra {
        width: 700px;
        transition: 0.5s;
    }

    .navbar.fixed .barra:focus {
        transform: translateY(105px);
        transition: .5s;
    }

    .barra {
        flex-shrink: 0;
        height: 40px;
        width: 750px;
        box-sizing: border-box;

        border: none;
        border-top-left-radius: 30px;
        border-bottom-left-radius: 30px;

        padding-left: 15px;

        font-size: 18px;

        background-color: rgb(218, 218, 218);

        position: relative;
        z-index: 2;
        transition: 0.5s;

        box-shadow: 0px 2px 5px rgb(121, 121, 121);
    }

    .barra:focus {
        background-color: rgb(236, 236, 236);
        border-style: none;
        outline: none;

        box-shadow: 0px 2px 5px rgb(121, 121, 121);
    }

    .btnPesq {
        border: none;

        display: flex;
        justify-items: center;
        justify-content: space-around;
        align-items: center;


        border-top-right-radius: 30px;
        border-bottom-right-radius: 30px;

        /*padding: 0px 40px 0px 10px;*/
        box-sizing: border-box;

        background-color: rgb(184, 184, 184);

        box-shadow: 0px 2px 5px rgb(121, 121, 121);
        flex-shrink: 0;

        width: 50px;
        height: 40px;

        transition: 0.5s;
    }

    .btnPesq:hover {
        background-color: rgb(236, 236, 236);
        transition: 0.5s;
    }

    .btnPesq img {
        width: 22px;
    }

    .opcoes {
        position: absolute;
        z-index: 1;

        display: none;
        grid-template-columns: 1fr 3fr;
        grid-template-rows: 300px;
        grid-template-areas: "barralateral pesquisa";

        /*transform: translate(197.5px, 190px);*/
        transform: translate(28.25%, 190px);

        align-self: flex-start;

        border-radius: 20px;
        box-sizing: border-box;

        box-shadow: 2px 2px 10px rgb(121, 121, 121);


        height: 300px;
        width: 800px;

        background-color: white;
    }

    .opcoes.visible {
        display: grid;

        opacity: 1;
        visibility: visible;

    }

    .barralateral {
        /*background-color: rgb(54, 137, 221);*/
        box-sizing: border-box;
        margin-top: 10px;
        margin-bottom: 10px;


        padding: 10px 0px 10px 0px;
        padding-left: 30px;

        border-right: 1px solid rgb(80, 80, 80);


    }

    .listgen {
        list-style: none;
        padding: 0px 5px;
        margin-right: 10px;


    }

    .listgen li {
        margin: 15px 0px;

    }

    .listgen li span {
        font-family: "Kanit", sans-serif;
        font-weight: 300;
    }

    .listpes {
        list-style: none;
        padding: 0px 10px 0px 10px;
    }

    .listpes span {
        font-family: "Kanit";
        font-weight: 300;
    }

    .listpes li {
        padding: 10px 0px 10px 0px;
    }

    .listpes li:hover {
        background-color: rgb(236, 236, 236);
    }


    .pesquisa {
        grid: pesquisa;
        box-sizing: border-box;

    }

    .itensopc {
        font-size: 18px;
        margin-bottom: 5px;
    }

    /*main {
        height: 900px;

    } */
</style>

<body>
    <header>
        <div class="header1"> <!--div header-->
            <div class="logo fonte2">LIBRE</div>

            <div class="navbar"> <!--local da barra de pesquisa-->
                <form action="#" method="POST">
                    <input type="text" class="barra"> <!--Será que é Search??-->
                    <button class='btnPesq' type="submit">
                        <img src="img/loupe.png" alt="">
                    </button>
                </form>
            </div>

            <div class="outros">
                <div class="outroslayout fonte1">Descubra</div>
                <div class="outroslayout fonte1">Sobre</div>
                <div class="conta"></div>

            </div>

            <div class="opcoes" name="opcoes" id="opcoes">
                <div class="barralateral">
                    <span class="fonte1">GENEROS</span>
                    <ul class="listgen">
                        <li>
                            <a href="#">
                                <span>
                                    genero
                                </span>
                            </a>
                        </li>

                        <li>
                            <a href="#">
                                <span>
                                    genero
                                </span>
                            </a>
                        </li>

                        <li>
                            <a href="#">
                                <span>
                                    genero
                                </span>
                            </a>
                        </li>

                        <li>
                            <a href="#">
                                <span>
                                    genero
                                </span>
                            </a>
                        </li>

                        <li>
                            <a href="#">
                                <span>
                                    genero
                                </span>
                            </a>
                        </li>

                        <li>
                            <a href="#">
                                <span>
                                    genero
                                </span>
                            </a>
                        </li>

                    </ul>

                </div>
                <div class="pesquisa">
                    <ul class="listpes">

                        <a href="#">
                            <li>
                                <span>
                                    Autopreenchimento
                                </span>
                            </li>
                        </a>
                        <a href="#">
                            <li>
                                <span>
                                    Autopreenchimento
                                </span>
                            </li>
                        </a>
                        <a href="#">
                            <li>
                                <span>
                                    Autopreenchimento
                                </span>
                            </li>
                        </a>
                        <a href="#">
                            <li>
                                <span>
                                    Autopreenchimento
                                </span>
                            </li>
                        </a>
                        <a href="#">
                            <li>
                                <span>
                                    Autopreenchimento
                                </span>
                            </li>
                        </a>
                        <a href="#">
                            <li>
                                <span>
                                    Autopreenchimento
                                </span>
                            </li>
                        </a>

                    </ul>
                </div>

            </div>

        </div> <!--div header-->
    </header>