// Selecting an element
// vanilla JS - returns a simple html element
console.log( document.querySelector("h1") );

// jQuery - retruns a jquery object
console.log( $("h1") );

// ---- Changing text

// Vanilla JS way
// document.querySelector("h1").innerHTML = "hello";

// jquery way
// when an argument is passed into the method, it SETS the text of h1
// $("h1").text("<strong>hi!!</strong>");
// $("h1").html("<em>hi!!!</em>");

// when no argument is passed into the method, it GETS the text of the h1 tag
let text = $("h1").html();
console.log(text);


// ---- CSS
// Vanilla JS way
//document.querySelector("h1").style.color = "green";

// jQuery way
$("h1").css("color", "red");
// Can pass in multiple CSS properties in one method
$("h1").css({
    fontSize: "40px",
    textDecoration: "underline"
});

// --- EVENTS
// Vanilla JS way
// document.querySelector("#kanye").onmouseenter = function() {
//     this.src = "images/kanye-2.jpg";
// }

// jQuery way
// .on() takes two arguments
// 1st arg: the name of event
// 2nd arg: the function that will run when this event happens
$("#kanye").on("mouseenter", function() {
    // this is the function that will run when the user hovers over #kanye
    // this.src = "images/kanye-2.jpg";

    // can't do this. there is no .src property on the $("#kanye") jquery object
    // $("#kanye").src = "images/kanye-2.jpg";

    // .attr() gets and sets attributes of html elements
    // .attr() can take in two arguments
    // 1st arg: name of the attribute you want to change
    // 2nd arg: the value of the attribute you want to change
    //$("#kanye").attr("src","images/kanye-2.jpg");
    //$("#kanye").attr("alt","LALALAA");

    // this won't work because .attr() only works with jquery objects. this keywords is NOT a jquery object. it will return a html object
    // this.attr("src","images/kanye-2.jpg");

    // instead, use jquery's this
    $(this).attr("src","images/kanye-2.jpg");
});
$("#kanye").on("mouseleave", function() {
    $(this).attr("src", "images/kanye-1.jpg");
});

// --- COLOR BOXES
// Vanilla JS way
// let boxes = document.querySelectorAll(".color-box");
// for(let i = 0; i< boxes.length; i++) {
//     boxes[i].onclick = function() {

//     }
// }

// jQuery way
$(".color-box").on("click", function() {
    $("body").css("backgroundColor", $(this).data("color") );
});

// jQuery by default selects multiple elements that match the selector. In vanilla JS, only the first match is returned
//$(".color-box").css("borderColor", "green");


// ---- Traversal / Animation Effects
$("#dom-section h3").on("click", function() {
    
    //.slideToggle() takes in two arguments
    // 1st arg: duration of the effect in ms
    // 2nd arg: the function that runs AFTER the animation effect is over
    $(this).next().slideToggle(4000, function() {
        // this function runs AFTER the slide animation is over
        console.log("slide is done!");
    });
    console.log("hello!!!!");
});


// --- Forms
$("#form").on("submit", function(event) {
    // use the vanilla js way to prevent the form from actually submitting
    event.preventDefault();

    // vanilla js way
    //let nameInput = document.querySelector("#name-input").value;

    // jquery way
    let nameInput = $("#name-input").val().trim();
    console.log(nameInput);

    if(nameInput.length > 0) {
        // jquery way to append things 
        //$("#name-container").append("<p>" + nameInput + "</p>");
        $("#name-container").append(`<p>${nameInput}</p>`);
    }
})