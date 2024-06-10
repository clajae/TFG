async function loadCountryCodes() {
    try {
        let response = await fetch('codesCountryPhone.json');
        let countryPhoneCode = await response.json();

        let select = document.getElementById('country-code');
        countryPhoneCode.forEach(country => {
            let option = document.createElement('option');
            option.value = country.phoneCode;
            option.textContent = `${country.nameES} (+${country.phoneCode})`;
            select.appendChild(option);
        });
    } catch (error) {
        console.error('Error al cargar los prefijos:', error);
    }
}

async function loadCountries() {
    try {
        let response = await fetch('countries.json');
        let countryNames = await response.json();

        let select = document.getElementById('country-afiliado');
        countryNames.countries.forEach(country => {
            let option = document.createElement('option');
            option.value = country.name;
            option.textContent = country.es_name;
            select.appendChild(option);
        });
    } catch (error) {
        console.error('Error al cargar los nombres de los países:', error);
    }
}

window.onload = function() {
    loadCountryCodes();
    loadCountries();
};