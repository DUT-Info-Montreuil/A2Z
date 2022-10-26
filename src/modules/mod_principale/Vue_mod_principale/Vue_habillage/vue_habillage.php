<?php
 class VueHabillage { //fonction pour l'affichage de la nav bar
  function navbar()
    {
    ?>
      <html> 
        <head>
              <!-- CSS only -->
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
            <link rel="stylesheet" href="NavBarCSS.css">
          </head>

          <body>

            <nav class="p-3 mb-3 border-bottom">
            <div class="container">
              <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                <img class="logo" src="TabA2Z.png" width="64" height="64">
                <div class="navigation">
                  <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                    <li><a href="#" class="nav-link px-2 link-secondary">Accueil</a></li>
                    <li><a href="#" class="nav-link px-2 link-dark">Mes Fiches</a></li>
                    <li><a href="#" class="nav-link px-2 link-dark">Fiches publiques</a></li>
                  </ul>
                </div>
              
              </div>
                  <div class="photoProfil" >
                    <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                      <img src="/~aclaude/Sae/pdp.jpeg" alt="mdo" width="48" height="48" class="rounded-circle">
                    </a>
                    <ul class="dropdown-menu text-small">
                      <li><a class="dropdown-item" href="#">Profile</a></li>
                      <li><hr class="dropdown-divider"></li>
                      <li><a class="dropdown-item" href="#">Déconnexion</a></li>
                    </ul>
                  </div>
              </div>
            </div>
            </nav>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>

          </body>
      </html>
  <?php
    }
  
    //fonction pour l'affichage du Footer
  function footer() {
  ?>
    <html>
      <head>
            <link rel="stylesheet" href="footer.css">
        </head>

      <footer class="footer-distributed">

        <div class="footer-left">

          <p class="footer-links">
            <a class="link-1" href="#">Accueil</a>

            <a href="#">Mes Fiches</a>

            <a href="#">Fiches publiques</a>

            <a href="#">Profil</a>

            <a href="#">Conefetact</a>
          </p>

          <p>A2Z&copy; 2022</p>
        </div>

      </footer>
    </html>

<?php

 }
}
 ?>
