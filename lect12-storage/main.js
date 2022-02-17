



// When this page loads, check the local storage to see if name/colors are stored

//.getItem() to get the value of a key in local storage
// .getItem() will return false if the key does not exist
let storedName = localStorage.getItem("name");
let storedBgColor = localStorage.getItem("bgcolor");

if(storedName) {
    // this means name exists in localstorage
    document.querySelector("#name-display").innerHTML = storedName;
    // pre-populate the name input
    document.querySelector("#name").value = storedName;
}
if(storedBgColor) {
    // this means bgcolor exists in localstorage
    document.querySelector("body").style.backgroundColor = storedBgColor;
    document.querySelector("#bgcolor").value = storedBgColor;

}

document.querySelector("#form").onsubmit = function(event) {
    event.preventDefault();

    // Grab user input
    let nameInput = document.querySelector("#name").value;
    let bgColorInput = document.querySelector("#bgcolor").value;

    // Save the user input into local storage as Key/Value pairs
    // .setItem()
    // 1st arg: the name of the key - you can pick whatever you want it to be
    // 2nd arg: the value
    localStorage.setItem("name", nameInput);
    localStorage.setItem("bgcolor", bgColorInput);

    // Change the name and style the page with what the user input
    document.querySelector("#name-display").innerHTML = nameInput;
    document.querySelector("body").style.backgroundColor = bgColorInput;

}

// Let's save some "arrays" into local storage
// Local storage can only save strings. No arrays or objects.
// However, we can convert arrays/objects into JSON formatted strings!
let fruitArray = [];

// Check if fruits already exist in local storage
let fruitsInStorage = localStorage.getItem("fruits");

if(fruitsInStorage) {
    // returns a string
    console.log(fruitsInStorage);

    // convert this string back to an actual array
    let fruits = JSON.parse(fruitsInStorage);

    // Set the fruitArray to the previous array
    fruitArray = fruits;

    console.log(fruitArray);
}

document.querySelector("#fruit-form").onsubmit = function(event) {
    event.preventDefault();

    // Grab the user input
    let fruitInput = document.querySelector("#fruit").value.trim();
    fruitArray.push(fruitInput);

    console.log(fruitArray);

    // Local storage can only save strings.
    // However, we can convert an array into a JSON string!
    let fruitString = JSON.stringify(fruitArray);

    console.log(fruitString);

    // Save this string!
    localStorage.setItem("fruits", fruitString);

    // Clear the input
    document.querySelector("#fruit").value = "";

    // Rest display first
    document.querySelector("#fruitsDisplay").innerHTML = "";

    // Display the fruits on the browser
    for(let i = 0; i<fruitArray.length; i++) {
        document.querySelector("#fruitsDisplay").innerHTML += fruitArray[i] + ", ";
    }
}