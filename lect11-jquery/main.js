document.querySelector("#search-form").onsubmit = function(event) {
    event.preventDefault();

    // Get the user's input
    let searchInput = document.querySelector("#search-id").value.trim();
    let limitInput = document.querySelector("#limit-id").value;

    // Convert spaces and special characters 
    let convertedSearchInput = encodeURIComponent(searchInput);

    // Prepare the endpoint
    let endpoint = "https://itunes.apple.com/search?term=" + convertedSearchInput + "&limit=" + limitInput;
    console.log(endpoint);

    // // Make HTTP request via AJAX
    // let httpRequest = new XMLHttpRequest();
    // // .open() Create a request
    // // 1st arg: the method
    // // 2nd arg: the endpoint url
    // httpRequest.open("GET", endpoint);
    // httpRequest.send();
    // // Don't wait around for response, set up an event handler.
    // // the below function will run when iTunes eventually sends back a response
    // httpRequest.onreadystatechange = function() {   
    //     console.log(httpRequest.readyState);
    //     console.log("we got a response!");
        
    //     // When the response is fully ready
    //     if(httpRequest.readyState == 4) {
    //         if(httpRequest.status == 200) {
    //             // Log out the response from iTunes - it's a JSON string!
    //             console.log(httpRequest.responseText);
    //             displayResults(httpRequest.responseText);
    //         }
    //         else {
    //             alert("AJAX error!!!");
    //             console.log(httpRequest.status);
    //         }
    //     }
    // }
    //console.log("moving on...");

    // AJAX request using jQUERY
    // .ajax() 
    // 1st arg: an object with the API information
    $.ajax({
        method: "GET",
        url: "https://itunes.apple.com/search",
        // the parameters are sent separately
        data: {
            term: convertedSearchInput,
            limit: limitInput
        }
    })
    .done(function(results){
        // this function will run when we get a result from itunes
        console.log(results);
        displayResults(results);
    })
    .fail(function(results) {
        console.log("ERRORRRR");
    });

}


function displayResults(resultsString) {
    // Convert the JSON string to JS objects
    let resultsJS = JSON.parse(resultsString);
    console.log(resultsJS);

    document.querySelector("#num-results").innerHTML = resultsJS.resultCount;

    // Clear the previous search result
    document.querySelector("tbody").replaceChildren();

    for(let i = 0; i < resultsJS.results.length; i++) {
        let htmlString = `
        <tr>
            <td>
                <img src="${resultsJS.results[i].artworkUrl100}">
            </td>
            <td>
                ${resultsJS.results[i].artistName}
            </td>
            <td>
                ${resultsJS.results[i].trackName}
            </td>
            <td>
                ${resultsJS.results[i].collectionName}
            </td>
            <td>
                <audio src="${resultsJS.results[i].previewUrl}" controls></audio>
            </td>
        </tr>
        `;

        document.querySelector("tbody").innerHTML += htmlString;

    }
}