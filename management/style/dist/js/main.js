//const  BASE_URL = "http://localhost/rifaikuci.com/management";
const  BASE_URL = "https://rifaikuci.com/management";

function arrayConvertToString (array) {
    let stringArray = "";
    array.forEach(x => {
        stringArray = stringArray + x + ";";
    })

    return stringArray.slice(0, -1);
}
