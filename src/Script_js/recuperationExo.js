/**
 * Fonction pour enlver les double quotes au début et à la fin
 * @param {string} s
 * @returns la chaine en enlevant uniquement les doubles quotes au début et fin
 */
function trimDoubleQuotes(s) {
  //viré les doubles quotes au début et à la fin
  if (s === null || s === undefined || !s) {
    return s;
  }
  let caractereActuelle = '"'; //pour qu'il rentre dans le while
  while (caractereActuelle === '"' && s.length > 0) {
    // verification que la chaine n'est pas vide
    caractereActuelle = s[0];
    if (caractereActuelle === '"') {
      s = s.substring(1, s.length); //on coupe la premiere double quote
    }
  }
  caractereActuelle = '"';
  while (caractereActuelle === '"' && s.length > 0) {
    caractereActuelle = s[s.length - 1];
    if (caractereActuelle === '"') {
      s = s.substring(0, s.length - 1); //on coupe la dernière double quote
    }
  }
  return s;
}

/**
 * Insert l'exercice en question dans la page d'édition
 * @param {string} htmlExercice
 */
function insertionExercies(htmlExercice) {
  let page = document.getElementById("page");
  $(page).append(trimDoubleQuotes(htmlExercice));
}

/*
Version 1.0 - 2022/11/30
GNU GPL  Copyleft (C inversé) 2023-2033
Initiated by Hamidi.Yassine,Chouchane.Rayan,Claude.Aldric
Web Site = http://localhost/A2Z/src/index.php?module=connexion&action=connexion 
*/