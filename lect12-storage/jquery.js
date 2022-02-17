// ---- Selecting elements

// Vanilla JS way
// returns a simple humble HTML element
console.log(document.querySelector("h1"));

// jQuery way
// returns a jquery object
console.log( $("h1") );

// ---- Changing/Getting text
// Vanilla JS way
//document.querySelector("h1").innerHTML = "Hello!";

// jQuery way
// change (set) text by passing in an argument
//$("h1").text("<em>LALALALAL</em>");
$("h1").html("<strong>lal</strong><em>LALALALAL</em>");
// get text by not passing in any arguments
let text = $("h1").html();
//let text = $("h1").text();
console.log(text);


// ---- CSS
// Vanilla JS way
document.querySelector("h1").style.color = "blue";

// jquery way
// .css() can take two arguments
// 1st arg: name of the css property
// 2nd arg: the value 
$("h1").css("color", "red");

// can change multiple css properties with .css()
$("h1").css({
    fontSize: "44px",
    textDecoration: "underline"
});

// ---- EVENTS
// Vanilla JS way
document.querySelector("#kanye").onmouseenter = function() {
    this.src = "images/kanye-2.jpg";
}

// jQuery way
// .on() takes two arguments
// 1st arg: the name of the event
// 2nd arg: the function that runs when the event is triggered
$("#kanye").on("mouseenter", function() {
    // This code runs when the user hovers over #kanye (<img>)
    //this.src = "images/kanye-2.jpg";

    // Cannot do this. $(#kanye) is a jquery object that cant be mixed with a vanilla js thing like .src
    //$("#kanye").src = "images/kanye-2.jpg";
    // .attr() - takes two arguments
    // 1st: the name of the attribute
    // 2nd: the value of the attribute
    // $("#kanye").attr("src", "images/kanye-2.jpg");

    // can't do this
    //this.attr("src", "images/kanye-2.jpg");
    $(this).attr("src", "images/kanye-2.jpg");
});

$("#kanye").on("mouseleave", function() {
    $(this).attr("src", "images/kanye-1.jpg");
});

// ---- COLOR BOXES
// Vanilla JS way
let boxes = document.querySelectorAll(".color-box");
for(let i = 0; i<boxes.length; i++) {
    boxes[i].onclick = function() {

    }
}

// jQuery way
$(".color-box").on("click", function() {
    console.log("clicked!!");
    $("body").css("backgroundColor", $(this).data("color"));
});

// jQuery selects ALL the matches
// $(".color-box").css("borderColor", "green");

// ---- Traversal / Animation
$("#dom-section h3").on("click", function() {

    // .slideToggle() takes two arguments
    // 1st arg: the duration of the animation (ms)
    // 2nd arg: defines the function that runs AFTER the animation is finished
    $(this).next().slideToggle(500, function() {
        console.log("slide finished!");
    });
    console.log("next....")
});

// ---- FORMS
$("#form").on("submit", function(event) {
    event.preventDefault();

    // vanilla js way
    //let nameInput = document.querySelector("#name-input").value.trim();
    // jquery way
    let nameInput = $("#name-input").val().trim();
    console.log(nameInput);

    if(nameInput.length > 0) {
        //$("#name-container").append("<p>"+nameInput+"</p>");

        $("#name-container").append(`<p>${nameInput}</p>`);
    }
});

// ---- EVENT PROPAGATION aka event bubbling
$("#blue-box").on("click", function() {
    $("body").css("backgroundColor", "beige");
});

// By default, when an element's event is triggered, its parent's event ALSO gets triggered. That is why when the button is clicked, the #blue-box also "is clicked"
$("#button").on("click", function(event) {
    
    // stop event propagation. do not also trigger the click event on the parent, #blue-box
    console.log(event);
    event.stopPropagation();
    alert("Click!!!");
})