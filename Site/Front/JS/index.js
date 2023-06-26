document.addEventListener("DOMContentLoaded", function () {
    const pokemonButtons = document.querySelectorAll(".pokemon");
    const pokemonImg = document.querySelector("#pokemon-img");
    let selectedPokemonImage = null;

    pokemonButtons.forEach(function (button, index) {
        button.addEventListener("mouseover", function () {
            const newSelectedPokemonImage = button.getAttribute("data-image");
            if (selectedPokemonImage !== newSelectedPokemonImage) {
                selectedPokemonImage = newSelectedPokemonImage;
                pokemonImg.src = selectedPokemonImage;

                pokemonButtons.forEach(function (otherButton) {
                    if (otherButton !== button) {
                        otherButton.classList.remove("selected");
                    }
                });

                button.classList.add("selected");
            }
        });
    });

    function updatePokemonImage() {
        pokemonImg.src = pokemonImages[selectedPokemonIndex];
    }

    window.addEventListener("load", function () {
        updatePokemonImage();
    });
});