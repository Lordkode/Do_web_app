chrome.runtime.onMessage.addListener(async data => {
    switch(data.Event){
        case 'login':
            console.log("Loging in...")
            console.log(data.credentials)
            break;
        case 'commentSubmit':

        chrome.storage.sync.set({'foo': 'hello', 'bar': 'hi'}, function() {
            console.log('Settings saved');
          });

        chrome.storage.local.get(["token"]).then((result) => {
            console.log("Value is " + result.token);
          });

        async function getTopics() {
            chrome.storage.local.get(["token"]).then((result) => {
                console.log("Value is " + result.token);
              });

            const response = await fetch('http://62.72.5.95:1999/notes', {method: "GET"})
            .then((response)=>response.json())
            console.log( await response.notes)
            return response
          }
          
          getTopics()

            let currentTab;
            console.log(data.commentDetails)
            console.log(data.tabs)
            console.log("Submiting comment...")

            chrome.tabs.query({ active: true, lastFocusedWindow: true }, async (tabs)=>{

                console.log(tabs)

                currentTab = tabs[0]
                
                let topic = {
                    title: currentTab.title,
                    url: currentTab.url,
                    favicon: currentTab.favIconUrl
                }
                console.log(topic)

                // window.localStorage.setItem("item", "EEEEEEEEEE")

            async function post() {
                 
                const post = {
                    title: data.commentDetails.title,
                    description: "Essaies",
                    url: currentTab.url,
                    user_id: 12
                };
                
                const requestOptions = {
                    method: 'POST',
                    headers: { 
                        'Content-Type': 'application/json', 
                        'Authorization': 'Bearer 2|do_app7r1G2gnAoAmfAQj3Dkq7zt3jPvUNz12JllQAApU1742bb8fc' },
                    body: JSON.stringify(post)
                  }
                  
                  await fetch('http://127.0.0.1:8000/api/topics', requestOptions)
                    .then(
                      (response) => response.json()
                    )
                    .then((data) => data)
            
                    
                console.log('Post added')
            }

            await post()
               
            })



            break;

        case 'seeComments':
            chrome.tabs.query({ active: true, lastFocusedWindow: true },  async (tabs)=>{

                currentTab = tabs[0]

                let topic ={
                    title: currentTab.title,
                    url: currentTab.url,
                    favicon: currentTab.favIconUrl
                }
                
                console.log(topic)

            })

        default:
            break;
    }
})

// chrome.runtime.onInstalled.addListener(()=>{


// chrome.tabs.query({ active: true, lastFocusedWindow: true }, (tabs)=>{
//     console.log(tabs[0].url)
// })


// })