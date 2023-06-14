<script type="text/javascript">
    let zipcodeElement = document.getElementById('{{ $postcodeserviceFields['postcodeservice_zipcode'] ?? '' }}');
    let houseNumberElement = document.getElementById('{{ $postcodeserviceFields['postcodeservice_house_number'] ?? '' }}');
    let houseNumberAdditionElement = document.getElementById('{{ $postcodeserviceFields['postcodeservice_house_number_addition'] ?? '' }}');
    let streetElement = document.getElementById('{{ $postcodeserviceFields['postcodeservice_street'] ?? '' }}');
    let cityElement = document.getElementById('{{ $postcodeserviceFields['postcodeservice_city'] ?? '' }}');

    zipcodeElement.addEventListener('change', () => {
        window.getAddressFromPostcodeservice(zipcodeElement.value, houseNumberElement.value + (houseNumberAdditionElement.value ?? ''));
    });

    houseNumberElement.addEventListener('change', () => {
        window.getAddressFromPostcodeservice(zipcodeElement.value, houseNumberElement.value + (houseNumberAdditionElement.value ?? ''));
    });

    houseNumberAdditionElement.addEventListener('change', () => {
        window.getAddressFromPostcodeservice(zipcodeElement.value, houseNumberElement.value + (houseNumberAdditionElement.value ?? ''));
    });

    if (!window.getAddressFromPostcodeservice) {
        window.getAddressFromPostcodeservice = async function(zipcode, houseNumber) {
            if (!zipcode || !houseNumber || streetElement.length === 0 || cityElement.length === 0) {
                return;
            }

            let xhr = new XMLHttpRequest();
            let data = {
                postcode: zipcode,
                house_number: houseNumber,
            };

            xhr.open('POST', '/api/postcodeservice');
            xhr.setRequestHeader('Content-Type', 'application/json;charset=UTF-8');
            xhr.send(JSON.stringify(data));
            xhr.onload = function () {
                if (xhr.readyState !== xhr.DONE) {
                    return;
                }

                let responseData = JSON.parse(xhr.response);

                if (!responseData?.city || !responseData?.street) {
                    return;
                }

                streetElement.value = responseData.city
                cityElement.value = responseData.street
            };
        }
    }
</script>