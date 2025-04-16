import React from "react";
import "../assets/css/footer.css";

import instagram from "/img/instagram.svg";
import linkedin from "/img/linkedin.svg";
import youtube from "/img/youtube.svg";
import x from "/img/x.svg";
import googlePlay from "/img/GooglePlay.svg";
import appStore from "/img/ApStore.svg";

const Footer = () => {
  return (
    <footer>
      <div className="footer">
        <label className="fonte2" id="titulofooter">LIBRE</label>

        <div className="footer1">
          <div className="links">
            <section className="sectfoot">
              <span>Links</span>
              <ul>
                <li><a href="#">Sobre</a></li>
                <li><a href="#">Descubra</a></li>
              </ul>
            </section>

            <section className="sectfoot">
              <span>Suporte ao Usuário</span>
              <ul>
                <li><a href="#">Suporte</a></li>
                <li><a href="#">Contato</a></li>
                <li><a href="#">Fale conosco (Feedback)</a></li>
              </ul>
            </section>

            <section className="sectfoot">
              <span>Outros recursos</span>
              <ul>
                <li><a href="#">Termos de uso</a></li>
                <li><a href="#">Política de privacidade</a></li>
              </ul>
            </section>
          </div>

          <div className="redessociais">
            <span>Redes Sociais</span>
            <div className="linksRedSoc">
              <a href="#"><img src={instagram} alt="Instagram" /></a>
              <a href="#"><img src={linkedin} alt="LinkedIn" /></a>
              <a href="#"><img src={youtube} alt="YouTube" /></a>
              <a href="#"><img src={x} alt="Twitter/X" /></a>
            </div>
          </div>

          <div className="instalar">
            <span>Baixe o app</span>
            <div className="linksInst">
              <a href="#"><img src={googlePlay} alt="Google Play" /></a>
              <a href="#"><img src={appStore} alt="App Store" /></a>
            </div>
          </div>
        </div>
      </div>
    </footer>
  );
};

export default Footer;
