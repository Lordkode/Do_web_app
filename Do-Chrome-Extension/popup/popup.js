// ELEMENTS

// STATUS
const running = document.getElementById("running")

// COMMENT
const commentSection = document.getElementById("commentSection")
const title = document.getElementById("commentTitle")
const description = document.getElementById("commentDescription")
const terms = document.getElementById("conditionsCheckBox")
const commentSubmit = document.getElementById("commentSubmit")

// CHROME FUNCTIONS

async function getTabUrl() {
    let queryOptions = { active: true, currentWindow: true };
    let [tab] = await chrome.tabs.query(queryOptions);
    return tab;
  }


// FUNCTIONS 


chrome.tabs.query({ active: true, lastFocusedWindow: true }, async (tabs)=>{

    currentTab = tabs[0]

    console.log(tabs)
    
    let topic ={
        title: currentTab.title,
        url: currentTab.url,
        favicon: currentTab.favIconUrl,
        tabs: tabs
    }
    console.log(topic)
    
    title.value = currentTab.title
})





commentSubmit.onclick = async () =>{


    const commentDetails = {
        // contentUrl: tab.url,
        title: title.value,
        description: description.value
    }

    const tabs ="LOOOOOOOOOOO = " +  localStorage["token"]

    chrome.runtime.sendMessage({
        Event: 'commentSubmit',
        commentDetails,
        tabs
        
    })
}




// script.js
 
// To access the stars
let stars = 
    document.getElementsByClassName("star");
let output = 
    document.getElementById("output");
 
// Funtion to update rating
function gfg(n) {
    remove();
    for (let i = 0; i < n; i++) {
        if (n == 1) cls = "one";
        else if (n == 2) cls = "two";
        else if (n == 3) cls = "three";
        else if (n == 4) cls = "four";
        else if (n == 5) cls = "five";
        stars[i].className = "star " + cls;
    }
    output.innerText = "Rating is: " + n + "/5";
}
 
// To remove the pre-applied styling
function remove() {
    let i = 0;
    while (i < 5) {
        stars[i].className = "star";
        i++;
    }
}