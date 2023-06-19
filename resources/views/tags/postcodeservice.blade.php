<script type="text/javascript">
    let zipcodeElement = document.getElementById('{{ $postcodeserviceFields['postcodeservice_zipcode'] ?? '' }}');
    let houseNumberElement = document.getElementById('{{ $postcodeserviceFields['postcodeservice_house_number'] ?? '' }}');
    let houseNumberAdditionElement = document.getElementById('{{ $postcodeserviceFields['postcodeservice_house_number_addition'] ?? '' }}');
    let streetElement = document.getElementById('{{ $postcodeserviceFields['postcodeservice_street'] ?? '' }}');
    let cityElement = document.getElementById('{{ $postcodeserviceFields['postcodeservice_city'] ?? '' }}');

    if(zipcodeElement && zipcodeElement.length !== 0) {
        zipcodeElement.addEventListener('change', () => {
            window.getAddressFromPostcodeservice(zipcodeElement.value, houseNumberElement.value);
        });
    }

    if(houseNumberElement && houseNumberElement.length !== 0) {
        houseNumberElement.addEventListener('change', () => {
            window.getAddressFromPostcodeservice(zipcodeElement.value, houseNumberElement.value);
        });
    }

    if(houseNumberAdditionElement && houseNumberAdditionElement.length !== 0) {
        houseNumberAdditionElement.addEventListener('change', () => {
            window.getAddressFromPostcodeservice(zipcodeElement.value, houseNumberElement.value);
        });
    }

    if (!window.getAddressFromPostcodeservice) {
        window.getAddressFromPostcodeservice = async function(zipcode, houseNumber) {
            if (!zipcode || !houseNumber || streetElement.length === 0 || cityElement.length === 0) {
                return;
            }

            streetElement.disabled = true;
            cityElement.disabled = true;

            let xhr = new XMLHttpRequest();
            let data = {
                postcode: zipcode,
                house_number: houseNumber,
            };

            xhr.open('POST', '/api/postcodeservice');
            xhr.setRequestHeader('Content-Type', 'application/json;charset=UTF-8');
            xhr.send(JSON.stringify(data));
            xhr.onload = function () {
                streetElement.disabled = false;
                cityElement.disabled = false;

                if (xhr.readyState !== xhr.DONE) {
                    streetElement.value = '';
                    cityElement.value = '';
                    return;
                }

                let responseData = JSON.parse(xhr.response);

                if (!responseData?.city || !responseData?.street) {
                    streetElement.value = '';
                    cityElement.value = '';
                    return;
                }

                streetElement.value = responseData.street;
                cityElement.value = responseData.city;
            };
        }
    }
</script>
