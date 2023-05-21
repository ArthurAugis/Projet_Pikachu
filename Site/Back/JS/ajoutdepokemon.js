function ajouterChamp(containerId) {
    let container = document.getElementById(containerId);
    let champ = document.createElement("input");
    champ.type = "text";
    champ.name = containerId.slice(0, -10) + "[]";
    champ.required = true;
    container.appendChild(champ);
    container.appendChild(document.createElement("br"));
}