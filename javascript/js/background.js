//first time installed exstension, set default value
chrome.runtime.onInstalled.addListener(() =>{
    chrome.storage.sync.set({
        toggleSitesActive: false,
        toggleSitesList : 'example.com'
    },() => {});
});

//initial chrome storage values
let toggleSitesActive = false;
let toggleSitesList = 'example.com'

//replace default values from sync storage
chrome.storage.sync.get([
    'toggleSitesActive',
    'toggleSitesList'
], (result) => {
    toggleSitesActive = result.toggleSitesActive;
    toggleSitesList = result.toggleSitesList;
})

//set site req to block if its in toggleSitesList
chrome.webRequest.onBeforeRequest.addListener(
    (details) => {



        //if toggle incative dont block anything
        if(!toggleSitesActive) {
            return {cancel : false};
        }
        
        //determine if the url is in toggle list
        let cancel = toggleSitesActive.split(/\n/)
            .some(site => {
                let url = new URL(details.url);

                return Boolean(url.hostname.indexOf(site) != -1)
            });
        return {cancel : cancel};
    },
    {
        urls: ["<all_urls>"]
    },
    [
        "blocking"
    ]
);

//any time that a storage item is updated do the update of global variables
chrome.storage.onChanged.addListener((changes, namespace) => {
    if (namespace == 'sync'){
        if(changes.toggleSitesActive){
            toggleSitesActive = changes.toggleSitesActive.newValue;
        }
        if(changes.toggleSitesList){
            toggleSitesList = changes.toggleSitesList.newValue
        }
    }
});